
@extends('admin.app')

@section('head')
        <link rel="stylesheet" href="{{ asset('css/admin/uniform.css')}}" />
        <link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        
@endsection

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a>
            <h2>Form edit</h2>
        </div>
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
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Update Coupon</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{ route('Coupon.edit', $couponDetail->id)}}" name="add_coupon" id="add_coupon"> {{ csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Amount Type</label>
                                    <div class="controls">
                                        <select name="amount_type" id="amount_type" style="width:220px;">
                                            <option @if($couponDetail->amount_type=="Percentage") selected @endif value="Percentage">Percentage</option>
                                            <option @if($couponDetail->amount_type=="Fixed") selected @endif value="Fixed">Fixed</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Coupon Code</label>
                                    <div class="controls">
                                        <input type="text" value="{{ $couponDetail->coupon_code }}" name="coupon_code" id="coupon_code" maxlength="15" minlength="5" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Amount</label>
                                    <div class="controls">
                                        <input value="{{ $couponDetail->amount }}" type="number" name="amount" id="amount" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Expiry Date</label>
                                    <div class="controls">
                                        <input value="{{ $couponDetail->expiry_date }}" type="text" name="expiry_date" id="expiry_date" required>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status" value="1" @if($couponDetail->status=="1") checked @endif>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add coupon" class="btn btn-success">
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