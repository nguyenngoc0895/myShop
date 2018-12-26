@extends('user.app')

@section('content')
<section>
    <div class="container text-center">
        <h2>Yêu cầu của bạn đã được xử lý</h2>
        <h3><a href="{{ route('home')}}"><b>Quay về trang chủ</b></a> để tiếp tục mua sắm</h3>
        <br>
    </div>
</section> 
@endsection 
<?php
    Session::forget('order_id');
    Session::forget('grand_total');
?>