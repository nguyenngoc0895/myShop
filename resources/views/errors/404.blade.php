@extends('user.app')

@section('content')
<section>
    <div class="container text-center">
        <div class="content-404">
            <h1><b>OPP!</b>Không tìm thấy trang</h1>
            <p>Có gì đó không ổn! Bạn vui lòng xem lại kết nối!</p>
            <h3><a href="{{ route('home')}}">Quay về trang chủ</a></h3>
            <br>
        </div>    
    </div>
</section> 
@endsection 