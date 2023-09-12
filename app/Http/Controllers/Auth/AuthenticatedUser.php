<?php

namespace App\Http\Controllers\Auth;


use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Models\VerifyUser;
use App\Notifications\EmailVerificationNotification;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Illuminate\Validation\Rules;
use App\Enums\RoleEnum;
use App\Rules\MatchOldPassword;

class AuthenticatedUser extends Controller
{
    //logout user
    public function destroy(Request $request){
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function verify(){
        if (Auth::user()->email_verified){
            return  redirect('/');
        }
        return inertia::render('auth/verify');
    }

    public function resendVerification()
    {
        $verifyUser = VerifyUser::where('user_id', Auth::id())->first();
        $otp = rand(111111,999999);
        $verifyUser = VerifyUser::create([
            'user_id' => Auth::id(),
            'otp_code' => $otp
        ]);
        //event for email verification
        $user=Auth::user();
        $token=$verifyUser->otp_code;
        $user->notify(new EmailVerificationNotification($token));

        return redirect()->back()
            ->with('status', 'OTP Sent Successfully');
    }

    //verify email
    public function checkVerification(Request $request){

        $validated=$request->validate([
            'otp_code'=>'required|integer|digits:6'
        ]);
        $verifyUser=VerifyUser::where('otp_code', $validated['otp_code'])->firstOrFail();
        if(!is_null($verifyUser) ){
            if ($verifyUser->status){
                $user=$verifyUser->user;
                if(!$user->email_verified) {
                    $verifyUser->user->email_verified = 1;
                    $verifyUser->user->save();
                    $verifyUser->update([
                        'status'=>0
                    ]);
                    $role=Auth::user()->getRoleNames()->first();
                    // return  redirect()->route('manager.index');
                    switch ($role) {
                        case($role==RoleEnum::Admin->value):
                            return redirect(RouteServiceProvider::ADMIN);
                            break;
                        case($role!=RoleEnum::Admin->value):
                            return redirect(RouteServiceProvider::USER);
                            break;
                        default:
                            return redirect('/');
                    }
                }else{
                    return redirect('/');
                }
            }else{
                return  redirect('/auth/verify')
                    ->with('status', 'The OTP code entered is expired');
            }
        }else{
            return  redirect('/auth/verify')
                ->with('status', 'We could not find the OTP provided in our database');
        }
    }

    public function firstLogin(){
        return inertia::render('auth/password-update');
    }

    public function newPassword(Request $request){
        $validated=$request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);
        $user=User::findOrFail(Auth::id());
        $user->update([
            'password'=>Hash::make($validated['password']),
            'first_login'=>0
        ]);

        Auth::logout();

        return redirect()->route('login');
    }

    public function getAuthUser(Request $request){
        if(Auth::user()){
            $user=User::find(Auth::id());
            $sub_user=session('auth_sub_user');
            $sub_user_type=$sub_user['user_type'];

            $auth=[
                'role'=>$sub_user_type['name'],
                'role_id'=>$sub_user_type['id'],
                'name'=>$user->full_name,
                'email'=>$user->email,
                'id'=>$user->id,
                'sub_user_id'=>$sub_user['id'],
                'company'=>$user->company(),
            ];
        }else{
            $auth=null;
        }

        return $auth;
    }

    public function switchRole($role_id){
        $res=AuthController::update_custom_auth($role_id);
        if($res['status']=='error'){
            request()->session()->flash('status',$res['res']);
            return back();
        }

        request()->session()->flash('success','Success');
        return AuthController::auth_redirect($role_id);
    }

    public function refreshAuthSession(){
        AuthController::custom_auth_session();
    }

    public function editProfile(){
        $user = Auth::user();
        return inertia::render('auth/profile',compact('user'));
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'email' => ['required'],
        ]);

        User::whereId(auth()->user()->id)->update([
            'email' => $request->email,
            'name' => $request->name,
        ]);

        return back()->with("status", "Details changed successfully!");
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_password' => ['required',new MatchOldPassword],
            'new_password' => ['required','same:password_confirmation'],
            'password_confirmation' => ['required']
        ]);

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
