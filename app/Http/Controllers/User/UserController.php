<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Country;
use Auth;
use Session;

class UserController extends Controller
{
    public function userLoginRegister()
    {
        return view('user.auth.login_register');
    }

    public function register(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $checkUser = User::where('email', $data['email'])->count();

        if($checkUser > 0){
            return redirect()->back()->with('message_error', 'Bạn đã đăng ký tài khoản với email này!');
        }else{
            $user = new User;
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->password = bcrypt($data['password']);
            $user->save();

            if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']])){
                Session::put('userSession', $data['email']);
                return redirect('/cart');
            }
        }
    }

    public function login(Request $request)
    {
        $data = $request->all();
        // dd($data);
        if(Auth::attempt(['email' => $data['email'], 'password' => $data['password']]))
        {
            Session::put('userSession', $data['email']);
            return redirect('/cart');
        }else{
            return redirect()->back()->with('message_error', 'Email hoăc mật khẩu không hợp lệ!');
        }
    }

    public function logout(){
        Auth::logout();
        Session::forget('userSession');
        return redirect( route('home'));
    }

    public function account(Request $request)
    {
        $user_id = Auth::user()->id;
        $userDetail = User::find($user_id);
        $countries = Country::get();

        if($request->isMethod('post')){
            $data = $request->all();

            $user = User::find($user_id);
            $user->name = $data['name'];
            $user->address = $data['address'];
            $user->city = $data['city'];
            $user->state = $data['state'];
            $user->country = $data['country'];
            $user->phone_number = $data['phone_number'];
            $user->save();

            return redirect()->back()->with('message_success', 'Cập nhật tài khoản thành công!');
        }
        return view('user.auth.account', compact('countries', 'userDetail'));
    }

    public function checkEmail(Request $request){
        $data = $request->all();
        // dd($data);
        $checkUser = User::where('email', $data['email'])->count();
        if($checkUser > 0){
            echo "false";
        }else{
            echo "true"; die;
        }
    }
}
