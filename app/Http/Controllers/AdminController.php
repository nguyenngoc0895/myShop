<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $data = $request->input();
            if(Auth::attempt(['email'=>$data['email'], 'password'=>$data['password'], 'admin'=>'1'])){
                //echo 'susscess'; die;
                //Session::put('adminSession', $data['email']);
                return redirect( route('admin.dashboard'));
            }else{
                //echo 'fail'; die;
                return redirect( route('admin.login'))->with('message_error', 'éo cho vào =)))');
            }
        }
        return view('admin.login');
    }

    public function logout(){
        Session::flush();
        return redirect( route('admin.login'))->with('message_success', 'mày vừa thoát =)))');
    }

    public function dashboard(){
        return view('admin.dashboard');
    }
    ///update password
    public function setting(){

        return view('admin.setting_acc');
    }

    ///ajax check password
    public function chkPassword(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $current_password = $data['current_pwd'];
        $check_password = User::where(['password'=>Auth::user()->password])->first();
            if (Hash::check($current_password, $check_password->password)) {
                //echo '{"valid":true}';die;
                echo "true"; die;
            } else {
                //echo '{"valid":false}';die;
                echo "false"; die;
            }

    }

    public function updatePassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //echo "<pre>"; print_r($data); die;
            $check_password = User::where(['email'=>Auth::user()->email])->first();
            $current_password = $data['current_pwd'];

            if (Hash::check($current_password, $check_password->password)) {
                // here you know data is valid
                $password = bcrypt($data['new_pwd']);
                User::where('id',$check_password->id  )->update(['password'=>$password]);
                return redirect('/admin/setting')->with('message_success', 'Password updated successfully.');
            }else{
                return redirect('/admin/setting')->with('message_error', 'Current Password entered is incorrect.');
            }
        }

        ///this is test

        // $user = User::find(Auth::user()->id);
        // if(Hash::check(Input::get('current_pwd'), $user['password']) && Input::get('password') == Input::get('confirm_pwd')){

        //     $user->password = bcrypt(Input::get('password'));
        //     $user->save();
        //     return redirect('/admin/setting')->with('message_success', 'Password updated successfully.');
        // }else{
        //     return redirect('/admin/setting')->with('message_error', 'Current Password entered is incorrect.');
        // }

        

}
}