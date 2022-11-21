<?php

namespace App\Http\Controllers;

use Session;
use Exception;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
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
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Validator;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Database\Eloquent\SoftDeletes;
use Symfony\Component\HttpKernel\Profiler\Profile;

class AuthController extends Controller {
    public function index() {
            return view('/login');
    }

    public function forgot_password() {
            return view('forgot-password');
    }

    public function password_baru() {
            return view('reset-password');
    }

    public function login(Request $request) {
        $validate = Validator::make($request->all(), [
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        if($validate->fails()){
            return back()->with('error', 'Email yang anda masukkan tidak valid!');
        } else {
            $credentials = request(['email', 'password']);
            if(!Auth::attempt($credentials)){
                return back()->with('error', 'Email atau Password yang anda masukkan salah!');
            }
            $user = User::where('email', $request->email)->first();
            if($user->role_id == 2){
                return redirect()->intended('/analisis-tamu')->with('success', 'Selamat Datang Admin '.$user->name.'');
            }else {
                return redirect()->intended('/scan-tamu')->with('success', 'Selamat Datang Admin '.$user->name.''); 
            }
        }
    }

    public function logout (Request $request) {
        Cache::flush();
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success','Anda Berhasil Logout');
    }
    public function resetPassword(Request $request){
            $validate = Validator::make($request->all(), [
                'email'=>'required|email|exists:users,email',
                'password'=>'required|confirmed|min:8',
                'password_confirmation'=>'required',
            ]);
            if($validate->fails()){
                return back()->with('error', 'ada yang salah, pastikan password yang anda masukkan sama dan berisi minimal 8 karakter');
            }
        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
            ])->first();
            if(!$check_token){
                return back()->withInput()->with('fail', 'Invalid token');
            }else{
                if (Carbon::now()->lte($check_token->created_at)){
                    User::where('email', $request->email)->update([
                        'password'=> Hash::make($request->password)
                    ]);

                    PasswordReset::where([
                        'email'=> $request->email,
                    ])->delete();
                }else{
                    return redirect()->route('login')->with('error', 'Masa habis token sudah tidak berlaku');
                }
            return redirect()->intended('login')->with('success', 'Password berhasil diubah')->with('verifiedEmail', $request->email);
        }
    }

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
            return redirect()->route('login')->with('error', 'Token sudah tidak berlaku');
        }else{
            if (Carbon::now()->lte($check_expired->created_at)) {
                return view('reset-password')->with(['token' => $token, 'email' => $request->email]);
            }else {
                return redirect()->route('login')->with('error', 'Masa habis token sudah tidak berlaku');
            }
        }
    }
    public function email_test(Request $request){
        $request->validate([
            'email'=>'required|email|exists:users,email'
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now()->addMinutes(5),
            'is_verified' => 0,
        ]);

        $data['action_link'] = route('reset-password',['token'=>$token,'email'=>$request->email]);
        $data['body'] = "Kami telah menerima permintaan untuk mengatur ulang kata sandi akun yang terkait dengan ".$request->email." pada <b>Tritih Golf & Country Club</b>. Anda dapat mengatur ulang kata sandi dengan mengklik tautan di bawah ini";
        $data['email'] = $request->email;
        dispatch(new SendEmailResetJob($data));
        return redirect()->route('login')->with('success', 'Reset Password sudah dikirim ke email anda! silahkan cek email');
    }
}
