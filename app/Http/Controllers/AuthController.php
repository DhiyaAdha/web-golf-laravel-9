<?php

namespace App\Http\Controllers;

use Session;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
// use App\Models\Invoice;
use App\Models\Visitor;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\LogTransaction;
use Illuminate\Support\Facades\Auth;
use App\Jobs\SendEmailResetJob;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AuthController extends Controller {

    //ini untuk route get pada web.php
    public function index(){
            return view('/Login');
        }

    public function forgot_password(){
            return view('/Lupa-pasword');

        }

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
            //ini untuk menangkap error login
            $user = User::where('email', $request->email)->first();
            if(!Hash::check($request->password, $user->password, [])){
                throw new Exception('Error in login');
            }
            //ini untuk function ketika dinyatakan data valid dan di redirect menuju dashboard
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
            return redirect()->intended('/analisis-tamu');
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

    

    //ini untuk function logout
    public function logout (Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
    //ini untuk function reset password, email yang di input akan dicek
    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|confirmed',
            'password_confirmation'=>'required',
        ]);
        //ini untuk function mengecek token dari database untuk mereset password
        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
            ])->first();
            //ini untuk function jika token yang dicek tidak ada
            if(!$check_token){
                return back()->withInput()->with('fail', 'Invalid token');
            }else{
                //ini untuk function jika token yang dicek ada
                User::where('email', $request->email)->update([
                    'password'=> Hash::make($request->password)
            ]);
            
            DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();
            //ini untuk function jika semua proses selesai dan akan di redirect ke menu login 
            return redirect()->intended('login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }
    //ini untuk route get di web.php memasukkan password baru
    public function showResetForm(Request $request, $token = null){
        // dd($token);
        return view('Reset-pasword')->with(['token'=>$token,'email'=>$request->email]);
    }
    //ini untuk route get di web.php memasukkan email yang akan dirubah passwordnya
    // public function sendresetlink(Request $request){
    //     $request->validate([
    //         'email'=>'required|email|exists:users,email'
    //     ]);
        
    //     $token = Str::random(64);
    //     DB::table('password_resets')->insert([
    //         'email'=>$request->email,
    //         'token'=>$token,
    //         'created_at'=>Carbon::now(),
    //     ]);
    //     //ini untuk isi pesan yang dikirim ke email reset password
    //     $data['action_link'] = route('Reset-pasword',['token'=>$token,'email'=>$request->email]);
    //     $data['body'] = "Kami telah menerima permintaan untuk mengatur ulang kata sandi akun yang terkait dengan ".$request->email." pada <b>Tritih Golf & Country Club</b>. Anda dapat mengatur ulang kata sandi dengan mengklik tautan di bawah ini";
        
    //     Mail::send('email-forgot',['action_link'=>$data['action_link'],'body'=>$data['body']], function($message) use ($request){
    //         $message->from('imasnurdianto.stu@pnc.ac.id','Imas Nurdianto');
    //         $message->to($request->email, '')->subject('Reset Password');
    //     });
        
    //     return back()->with('resetSuccess', 'Reset Password sudah dikirim ke email anda! silahkan cek email');
    // }

    public function email_test(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);

        $data['action_link'] = route('Reset-pasword',['token'=>$token,'email'=>$request->email]);
        $data['body'] = "Kami telah menerima permintaan untuk mengatur ulang kata sandi akun yang terkait dengan ".$request->email." pada <b>Tritih Golf & Country Club</b>. Anda dapat mengatur ulang kata sandi dengan mengklik tautan di bawah ini";

            // Mail::send('email-test',['action_link'=>$data['action_link'],'body'=>$data['body']], function($message) use ($request){
            // $message->from('imasnurdianto.stu@pnc.ac.id','Imas Nurdianto');
            // $message->to($request->email, '')->subject('Reset Password');
        // });
        

        $data['email'] = $request->email;
  
        dispatch(new SendEmailResetJob($data));
        // dd(session()->all());
    
        return back()->with('resetSuccess', 'Reset Password sudah dikirim ke email anda! silahkan cek email');
    }
}
