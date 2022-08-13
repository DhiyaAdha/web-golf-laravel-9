<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use App\Models\Visitor;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class AuthController extends Controller {


    public function index(){
            return view('/Login');
        }

    public function forgot_password(){
            return view('/Lupa-pasword');
        }

        public function dashboard(){

            // memanggil data visitor
            $data['visitor'] = Visitor::all()->sortBy('id');
            $data['visitor_today'] = Visitor::whereDate('created_at', now()->format('Y-m-d'))->count();
           
            $data['visitor_week'] = Visitor::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->get()->count();
            $data['visitor_month'] = Visitor::whereMonth('created_at', now()->month)->count(); //bulan ini
            $data['visitor_year'] = Visitor::whereYear('created_at', now()->format('Y'))->count();


            // $visitorTraffic = PageView::where('created_at', '>=', \Carbon\Carbon::now->subMonth())
            //             ->groupBy(DB::raw('Date(created_at)'))
            //             ->orderBy('created_at', 'DESC')->get();

            
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

            // $data['january'] = Visitor::whereMonth('created_at', '01')->whereYear('created_at', now()->format('M'))->count();
            // $data['january'] = Visitor::whereMonth('created_at', '01')->whereYear('created_at', now()->format('Y'))->count();
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

            



            

            return view('/Analisis-tamu', $data);
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
}
