@extends('user.app')

@section('content')
    <section id="form" style="margin-top: 50px;"><!--form-->
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><a href="{{ route('orderReview')}}">Order Review</a></li>
                </ol>
            </div>
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
            <form action="{{ route('checkout') }}" method="post">{{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-4 col-sm-offset-1">
                        <div class="login-form"><!--login form-->
                            <h2>Bill to</h2>
                            <div class="form-group">
                                <input name="billing_name" id="billing_name" @if(!empty($userDetail->name)) value="{{ $userDetail->name }}" @endif class="form-control" type="text" placeholder="Billing Name" />
                            </div>
                            <div class="form-group">
                                <select  name="billing_country" id="billing_country" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->country_name }}" @if(!empty($userDetail->country) && $country->country_name == $userDetail->country) selected @endif>{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="billing_city" id="billing_city" @if(!empty($userDetail->city)) value="{{ $userDetail->city }}" @endif class="form-control" type="text" placeholder="Billing City" />
                            </div>
                            <div class="form-group">
                                <input name="billing_state" id="billing_state" @if(!empty($userDetail->state)) value="{{ $userDetail->state }}" @endif class="form-control" type="text" placeholder="Billing State" />
                            </div>
                            <div class="form-group">
                                <input name="billing_address" id="billing_address" @if(!empty($userDetail->address)) value="{{ $userDetail->address }}" @endif class="form-control" type="text" placeholder="Billing address" />
                            </div>
                            <div class="form-group">
                                <input name="billing_phone_number" id="billing_phone_number" @if(!empty($userDetail->phone_number)) value="{{ $userDetail->phone_number }}" @endif class="form-control" type="text" placeholder="Billing Phone Number" />
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="billtoship">
                                <label class="form-check-label" for="billtoship">Shipping address same as Billing address</label>
                            </div>
                        </div><!--/login form-->
                    </div>
                    <div class="col-sm-1">
                    </div>
                    <div class="col-sm-4">
                        <div class="signup-form"><!--sign up form-->
                            <h2>Ship to</h2>
                            <div class="form-group">
                                <input name="shipping_name" id="shipping_name" @if(!empty($shippingDetail->name)) value="{{ $shippingDetail->name }}" @endif class="form-control" type="text" placeholder="shipping Name" />
                            </div>
                            <div class="form-group">
                                <select  name="shipping_country" id="shipping_country" class="form-control">
                                    <option value="">Select Country</option>
                                    @foreach($countries as $country)
                                    <option value="{{ $country->country_name }}" @if(!empty($shippingDetail->country) && $country->country_name == $shippingDetail->country) selected @endif>{{ $country->country_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <input name="shipping_city" id="shipping_city" @if(!empty($shippingDetail->city)) value="{{ $shippingDetail->city }}" @endif class="form-control" type="text" placeholder="shipping City" />
                            </div>
                            <div class="form-group">
                                <input name="shipping_state" id="shipping_state" @if(!empty($shippingDetail->state)) value="{{ $shippingDetail->state }}" @endif class="form-control" type="text" placeholder="shipping State" />
                            </div>
                            <div class="form-group">
                                <input name="shipping_address" id="shipping_address" @if(!empty($shippingDetail->address)) value="{{ $shippingDetail->address }}" @endif class="form-control" type="text" placeholder="shipping address" />
                            </div>
                            <div class="form-group">
                                <input name="shipping_phone_number" id="shipping_phone_number" @if(!empty($shippingDetail->phone_number)) value="{{ $shippingDetail->phone_number }}" @endif class="form-control" type="text" placeholder="shipping Phone Number" />
                            </div>
                            <button type="submit" class="btn btn-success">Checkout</button>
                        </div><!--/sign up form-->
                    </div>
                </div>
            </form>
        </div>
    </section><!--/form-->
    @endsection 