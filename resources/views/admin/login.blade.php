<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{ asset('css/admin/bootstrap.min.css')}}" />
		<link rel="stylesheet" href="{{ asset('css/admin/bootstrap-responsive.min.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/admin/matrix-login.css')}}" />
        <link href="{{ asset('fonts/backend/css/font-awesome.css')}}" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>

    </head>
    <body>
        <div id="loginbox">
            @if(Session::has('message_error'))
                <div class="alert alert-error alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('message_error') !!}</strong>
                </div>
            @endif

            @if(Session::has('message_success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button> 
                    <strong>{!! session('message_success') !!}</strong>
                </div>
            @endif

            <form id="loginform" class="form-vertical" method="POST" action="{{ route('admin.login')}}"> {{ csrf_field() }}
				 <div class="control-group normal_text"> <h3><img src="{{ asset('images/admin/logo.png')}}" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input id="email" type="email" name="email" placeholder="Youremail" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input id="password" name="password" type="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-info" id="to-recover">Lost password?</a></span>
                    <span class="pull-right"><input type="submit" class="btn btn-success" value="Login" /></span>
                </div>
            </form>
        </div>
        
        <script src="{{ asset('js/admin/matrix.login.js')}}"></script> 
        <script src="{{ asset('js/admin/jquery.min.js')}}"></script>  
        <script src="{{ asset('js/admin/bootstrap.min.js') }} "></script> 
    </body>

</html>
