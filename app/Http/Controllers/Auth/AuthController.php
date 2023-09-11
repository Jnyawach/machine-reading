<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\VerifyUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use App\Enums\RoleEnum;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Notifications\EmailVerificationNotification;
use App\Notifications\PasswordResetNotification;
use App\Providers\RouteServiceProvider;


class AuthController extends Controller
{
    //
    public function register(){
        return inertia::render('auth/register');
    }

    public function creatUser(Request $request){
     $validated=$request->validate([
         'name'=>['required', 'string', 'max:255'],
         'email'=>['required', 'string', 'email', 'max:255', 'unique:users'],
         'password' => ['required', 'string', 'min:8','confirmed'],
         'password_confirmation'=>['required']
     ]);
     $role=Role::findByName(RoleEnum::Admin->value);
        $user=User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password']),
            'first_login'=>0
        ]);
        $user->assignRole($role);

        //create email verification token
        $token=rand(111111,999999);
        VerifyUser::create([
            'user_id'=>$user->id,
            'otp_code'=>$token
        ]);
        //event for email verification
      // $user->notify(new EmailVerificationNotification($token));
       Auth::login($user);
       return redirect()->route('verify');
    }

    public function authenticate(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        //confirm this user has at least one role
        $auth_user=User::where('email',$request->email)->first();
        if(count($auth_user->getRoleNames())<1){
            request()->session()->flash('status','Access Denied. Contact Management.');
            return back();
        }

        //LOG IN
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $request->session()->regenerate();
            $role = $auth_user->getRoleNames();

            return $this->auth_redirect($role[0]);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    //password resetting methods
    public function reset(){
        return inertia::render('auth/password-reset');
    }

    public function resetPassword(Request $request){

        $validated=$request->validate([
            'email'=>'required|email|string|exists:users'
        ],[
            'exists'=>'We could not find the provided email in our database'
        ]);


        $user=User::where('email',$validated['email'])->firstOrFail();


        $otp=$user->verifiable()->create([
            'otp_code'=>rand(111111,999999),
            'email'=>$user->email
        ]);

        $user->notify(new PasswordResetNotification($otp->otp_code));

        return redirect()->route('create.password');
    }

    //update password page
    public function newPassword(){
        return inertia::render('auth/reset-password');
    }

    public function update(Request $request){

        $validate=$request->validate([
            'email'=>'required|email|string|max:255|exists:users',
            'otp_code'=>'required|digits:6|integer|exists:verify_users',
            'password'=>'required|string|min:8|confirmed'
        ]);

        $user=User::where('email',$validate['email'])->firstOrFail();

        if ($user){
            $verify=VerifyUser::where('user_id',$user->id)->where('otp_code',$validate['otp_code'])->latest()->first();

            if (!$verify->status){
                return redirect()->back()
                    ->withErrors([
                        'otp_code'=>'The OTP code provided is expired'
                    ])->onlyInput('otp_code');
            }
            $user->update(['password'=>Hash::make($validate['password'])]);
            $verify->update(['status'=>0]);
            return redirect()->route('login')->with('status','Password updated successfully');
        }

        return redirect()->back()
            ->with('status','User not found please try again');
    }

    public static function auth_redirect($role=null){

        if(!Auth::check()){ return redirect('/'); }

        switch ($role) {
            case($role==RoleEnum::Admin->value):
                return redirect(RouteServiceProvider::ADMIN);
                break;
            case($role==RoleEnum::Supervisor->value):
                return redirect(RouteServiceProvider::SUPERVISOR);
                break;
            case($role==RoleEnum::MachineOperator->value):
                return redirect(RouteServiceProvider::MACHINEOPERATOR);
                break;
            default:
                return redirect('/');
        }
    }
}
