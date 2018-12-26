@extends('user.app')

@section('content')
    <section id="form" style="margin-top: 50px;"><!--form-->
        <div class="container">
            @if(Session::has('message_error'))
            <div class="alert alert-error alert-block" style="background-color:#f4d2d2">
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('message_error') !!}</strong>
            </div>
            @endif

            @if(Session::has('message_success'))
            <div class="alert alert-success alert-block" >
                <button type="button" class="close" data-dismiss="alert">×</button> 
                <strong>{!! session('message_success') !!}</strong>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-4 col-sm-offset-1">
                    <div class="login-form"><!--login form-->
                        <h2>Đăng nhập khi bạn đã có tài khoản</h2>
                        <form id="LoginForm" name="LoginForm" method="post" action="{{ route('UserLogin') }}">{{ csrf_field() }}
                            <input id="email" name="email" type="email" placeholder="Địa chỉ Email của bạn"/>
                            <input id="LogPassword" name="password" type="password" placeholder="Mật khẩu"/>
                            {{-- <span>
                                <input type="checkbox" class="checkbox"> 
                                Keep me signed in
                            </span> --}}
                            <button type="submit" class="btn btn-default">Đăng nhập</button>
                        </form>
                    </div><!--/login form-->
                </div>
                <div class="col-sm-1">
                    <h2 class="or">Hoặc</h2>
                </div>
                <div class="col-sm-4">
                    <div class="signup-form"><!--sign up form-->
                        <h2>Đăng ký khi bạn chưa có tài khoản!</h2>
                        <form id="registerForm" name="registerForm" method="post" action="{{ route('UserRegister') }}">{{ csrf_field() }}
                            <input id="name" name="name" type="text" placeholder="Tên của bạn"/>
                            <input id="email" name="email" type="email" placeholder="Địa chỉ Email của bạn"/>
                            <input id="RegPassword" name="password" type="password" placeholder="Mật khẩu"/>
                            <button type="submit" class="btn btn-default">Đăng ký</button>
                        </form>
                    </div><!--/sign up form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection 