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
use App\Models\PasswordReset;
use App\Models\LogTransaction;
use App\Jobs\SendEmailResetJob;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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
            if($user->role_id == 2){
                return redirect()->intended('/analisis-tamu')->with('success', 'Selamat Datang Admin '.$user->name.'');
            }else {
                return redirect()->intended('/scan-tamu')->with('success', 'Selamat Datang Admin '.$user->name.''); 
            }
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
        return redirect('/')->with('success','Anda Berhasil Logout');
    }
    //ini untuk function reset password, email yang di input akan dicek
    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email',
            'password'=>'required|confirmed|min:8',
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
                if (Carbon::now()->lte($check_token->created_at)){
                    //ini untuk function jika token tidak expired setelah link diklik
                    User::where('email', $request->email)->update([
                        'password'=> Hash::make($request->password)
                    ]);

                    //ini function untuk menghapus token jika user sudah mengganti password
                    PasswordReset::where([
                        'email'=> $request->email,
                    ])->delete();
                }else{
                    return redirect()->route('login')->with('error', 'Link reset password telah expired');
                }
            
            //ini untuk function jika semua proses selesai dan akan di redirect ke menu login 
            return redirect()->intended('login')->with('success', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);
        }
    }
    //ini untuk route get di web.php memasukkan password baru
    public function showResetForm(Request $request, $token = null){
        
        $check_expired = PasswordReset::where([
            'email' => $request->input('email'),
            'token'=>$request->token,
            ])->first();
        $check_token = PasswordReset::where([
            'email'=>$request->email,
            'token'=>$request->token,
            ])->first();

        if(!$check_token){
            //jika token yang dicek tidak ada
            return redirect()->route('login')->with('error', 'Link reset password telah digunakan');
        }else{
            //jika token yang dicek ada
            if (Carbon::now()->lte($check_expired->created_at)) {
                return view('Reset-pasword')->with(['token' => $token, 'email' => $request->email]);
            }else {
                return redirect()->route('login')->with('error', 'Link reset password telah expired');
            }
        }
    }
    public function email_test(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $token = Str::random(64);
        //ini function untuk membuat token dan mengatur expired dari created at
        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now()->addMinutes(5), //batas waktu expired
            'is_verified' => 0,
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
    
        // return back()->with('success', 'Reset Password sudah dikirim ke email anda! silahkan cek email');
        return redirect()->route('login')->with('success', 'Reset Password sudah dikirim ke email anda! silahkan cek email');
    }
}
