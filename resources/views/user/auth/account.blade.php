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
                    <div class="login-form"><!--update acc form-->
                        <h2>Cập nhật tài khoản:</h2>
                        <form id="AccountForm" name="AccountForm" method="post" action="{{ route('account') }}">{{ csrf_field() }}
                            <input id="name" name="name" type="text" value="{{ $userDetail->name }}" placeholder="Name"/>
                            <input id="address" name="address" type="text" value="{{ $userDetail->adress }}" placeholder="Address"/>
                            <input id="city" name="city" type="text" value="{{ $userDetail->city }}" placeholder="City"/>
                            <input id="state" name="state" type="text" value="{{ $userDetail->state }}" placeholder="Stage"/>
                            <select id="country" name="country" >
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                <option value="{{ $country->country_name }}" @if($country->country_name == $userDetail->country) selected @endif>{{ $country->country_name }}</option>
                                @endforeach
                            </select>
                            <input style="margin-top:10px;" id="phone_number" name="phone_number" type="text" value="{{ $userDetail->phone_number }}" placeholder="Phone number"/>
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>
                    </div><!--/update acc form-->
                </div>
            </div>
        </div>
    </section><!--/form-->
@endsection 