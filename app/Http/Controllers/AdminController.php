<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        // if(Session::has('adminSession')){
        //     //perform all dashboard

        // }else{
        //     return redirect( route('admin.login'))->with('message_error', 'đăng nhập đã chứ vội thế=))');
        // }
        return view('admin.dashboard');
    }

    public function setting(){
        return view('admin.setting_acc');
    }

    public function chkPassword(Request $request){
        $data = $request->all();
        //echo "<pre>"; print_r($data); die;
        $current_password = $data['current_pwd'];
        $check_password = User::where(['id'=>'1'])->first();

        if (Hash::check($current_password, $check_password->password)) {
            //echo '{"valid":true}';die;
            echo "true"; die;
        } else {
            //echo '{"valid":false}';die;
            echo "false"; die;
        }
            
    }
}
