
@extends('admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}" />
<link href="font-awesome/css/font-awesome.css" rel="stylesheet" />
@endsection

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="index.html" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
                    Home</a> <a href="#">Form elements</a> <a href="#" class="current">Validation</a> </div>
            <h1>Form validation</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Update password your acc</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="" name="password_validate" id="password_validate" novalidate="novalidate">
                                <div class="control-group">
                                    <label class="control-label">Current password</label>
                                    <div class="controls">
                                        <input type="password" name="current_pwd" id="current_pwd" />
                                        <span id="chkPwd"></span>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">New password</label>
                                    <div class="controls">
                                        <input type="password" name="new_pwd" id="new_pwd" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Confirm password</label>
                                    <div class="controls">
                                        <input type="password" name="confirm_pwd" id="confirm_pwd" />
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Update Password" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script src="{{ asset('js/admin/jquery.validate.js')}}"></script>
@endsection