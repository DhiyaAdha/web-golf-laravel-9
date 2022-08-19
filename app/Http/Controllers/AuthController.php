<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Exception;
use Session;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;
use App\Models\Invoice;
use App\Models\Order;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AuthController extends Controller {


    public function index(){
            return view('/Login');
        }

    public function forgot_password(){
            return view('/Lupa-pasword');
        }


        public function dashboard(){
            // memanggil data visitor
            $data['visitor'] = Visitor::all()->sortByDesc('created_at');
            $data['visitor_today'] = Visitor::whereDate('created_at', now()->format('Y-m-d'))->count();
            $data['visitor_week'] = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY), Carbon::now()->endOfWeek(Carbon::SATURDAY)])->get()->count();
            $data['visitor_month'] = Visitor::whereMonth('created_at', now()->month)->count(); //bulan ini  
            $data['visitor_year'] = Visitor::whereYear('created_at', now()->format('Y'))->count();
            $data['visitor_vip'] = Visitor::where('tipe_member', 'VIP')->count();
            $data['visitor_vvip'] = Visitor::where('tipe_member', 'VVIP')->count();
            $data['visitor_vvip_female'] = Visitor::where([
                                                ['tipe_member', 'VVIP'],
                                                ['gender', 'perempuan'],
                                            ])->count();
            $data['visitor_vvip_male'] = Visitor::where([
                                                ['tipe_member', 'VVIP'],
                                                ['gender', 'laki-laki'],
                                            ])->count();
            
            //VIP 
            $data['visitor_vip_female'] = Visitor::where([
                                                ['tipe_member', 'VIP'],
                                                ['gender', 'perempuan'],
                                            ])->count();
            $data['visitor_vip_male'] = Visitor::where([
                                                ['tipe_member', 'VIP'],
                                                ['gender', 'laki-laki'],
                                            ])->count();
            $data['Jan_vvip'] = Visitor::whereMonth('created_at', '01')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Jan_vip'] = Visitor::whereMonth('created_at', '01')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Feb_vvip'] = Visitor::whereMonth('created_at', '02')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Feb_vip'] = Visitor::whereMonth('created_at', '02')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Mar_vvip'] = Visitor::whereMonth('created_at', '03')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Mar_vip'] = Visitor::whereMonth('created_at', '03')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Apr_vvip'] = Visitor::whereMonth('created_at', '04')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Apr_vip'] = Visitor::whereMonth('created_at', '04')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Mei_vvip'] = Visitor::whereMonth('created_at', '05')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Mei_vip'] = Visitor::whereMonth('created_at', '05')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Jun_vvip'] = Visitor::whereMonth('created_at', '06')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Jun_vip'] = Visitor::whereMonth('created_at', '06')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Jul_vvip'] = Visitor::whereMonth('created_at', '07')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Jul_vip'] = Visitor::whereMonth('created_at', '07')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Aug_vvip'] = Visitor::whereMonth('created_at', '08')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Aug_vip'] = Visitor::whereMonth('created_at', '08')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Sep_vvip'] = Visitor::whereMonth('created_at', '09')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Sep_vip'] = Visitor::whereMonth('created_at', '09')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Oct_vvip'] = Visitor::whereMonth('created_at', '10')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Oct_vip'] = Visitor::whereMonth('created_at', '10')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Nov_vvip'] = Visitor::whereMonth('created_at', '11')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Nov_vip'] = Visitor::whereMonth('created_at', '11')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            $data['Dec_vvip'] = Visitor::whereMonth('created_at', '12')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VVIP')->count();
            $data['Dec_vip'] = Visitor::whereMonth('created_at', '12')->whereYear('created_at', now()->format('Y'))->where('tipe_member', 'VIP')->count();
            
            // rEKAP hARIAN
            // $data['vvip_sen'] = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(Carbon::MONDAY)->addDays(1), Carbon::now()->endOfWeek(Carbon::SUNDAY)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
            $data['vvip_min'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(0)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
            $data['vip_min'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(0)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
            $data['vvip_sen'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(1)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
            $data['vip_sen'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(1)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
            $data['vvip_sel'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(2)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
            $data['vip_sel'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(2)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
            $data['vvip_rab'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(3)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
            $data['vip_rab'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(3)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
            $data['vvip_kam'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(4)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
            $data['vip_kam'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(4)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
            $data['vvip_jum'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(5)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
            $data['vip_jum'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(5)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
            $data['vvip_sab'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(6)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VVIP')->count();
            $data['vip_sab'] = Visitor::whereDate('created_at', [Carbon::now()->startOfWeek(Carbon::SUNDAY)->addDays(6)])->whereMonth('created_at', now()->month)->get()->where('tipe_member', 'VIP')->count();
            return view('/Analisis-tamu', $data);
        }

    public function daftartamu(){
        $data['visitor'] = Visitor::all()->sortByDesc('created_at');

        
        return view('/Daftar-tamu', $data);
    }

    public function riwayatinvoice(){
        $data['visitor'] = Visitor::all()->sortByDesc('created_at');

        
        return view('/riwayat-invoice', $data);
    }
    
    public function tambahtamu(){
        
        return view('/Tambah-tamu');
    }
        // public function edittamu(){
        //     // $data['visitor'] = Visitor::all()->sortByDesc('created_at');
        //     return view('Edit-tamu');
        // }


    public function password_baru(){
        return view('/Reset-pasword');
    }

    //ini untuk function login
    public function login(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);


        //berfungsi jika format email salah
        if($validate->fails()){
            // return response(['message'=> $validate->errors()], 200);
            return back()->with('loginError', 'The email must be a valid email address!');
        } else {
            //berfungsi jika password salah/tidak sama
            $credentials = request(['email', 'password']);
            // $credentials = Arr::add($credentials, 'status', 'active');
            if(!Auth::attempt($credentials)){
                $respon = [
                    'status' => 'error',
                    'msg' => 'Unauthorized',
                    'errors' => null,
                    'content' => null,
                ];
                return back()->with('loginError', 'Invalid! Email atau Password yang anda masukkan Salah!');
                // return response(['message'=>'Invalid Credential'], 401);
                // return response(['message'=>'Login Failed! Email atau Password yang anda masukkan Salah!'], 401);
            }

            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new Exception('Error in login');
            }

            $tokenResult = $user->createToken('token-auth')->plainTextToken;
            $respon = [
                'status' => 'success',
                'msg' => 'Login successfully',
                'content' => [
                    'status_code' => 200,
                    'access_code' => $tokenResult,
                    'token_type' => 'Bearer',
                ],
            ];
            //  return response()->json($respon, 200);
            return redirect()->intended('/dashboard');
            // dd(session()->all());
        }
    }


    // public function logout(Request $request){
    //     $user = $request->user();
    //     $user->currentAccessToken()->delete();
    //     $respon = [
    //             'status' => 'error',
    //             'msg' => 'Logout Successfully',
    //             'errors' => null,
    //             'content' => null,
    //     ];
    //     // return response()->json($respon, 200);
    //     return redirect()->intended('/login');
    // }

    

    public function logout (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    
    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid token');
        }else{

            User::where('email', $request->email)->update([
                'password'=> Hash::make($request->password)
            ]);

            DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->intended('login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }

    public function showResetForm(Request $request, $token = null){
        return view('Reset-pasword')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function sendresetlink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);
        
        $action_link = route('Reset-pasword',['token'=>$token,'email'=>$request->email]);
        $body = "We are received a request to reset the password for <b>Golf Card </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

        Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
            $message->from('imasnurdianto.stu@pnc.ac.id','Imas Nurdianto');
            $message->to($request->email, '')->subject('Reset Password');
        });

        return back()->with('resetSuccess', 'Reset Password sudah dikirim ke email anda! silahkan cek email');
    }
    

    //fungsi untuk INVOICE
    public function invoice(){
        $data['invoice'] = Invoice::all();
        return view('/invoice', $data);
    }

    public function scantamu(){
        return view('/scan-tamu');
    }
    public function scantamuberhasil(){
        return view('/scan-tamu-berhasil');
    }

    public function order(){
        return view('/order');
    }

    public function daftar_admin(){
<<<<<<< HEAD

        return ('Welcome To Daftar Admin');
=======
        return view('/daftar-admin');
    }
    public function tambah_admin(){
        return view('/tambah-admin');
>>>>>>> 8929619fe8ef86ec9956b8a3bf5046469a6be05e
    }
}
