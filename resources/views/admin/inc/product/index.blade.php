
@extends('admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}" />
@endsection

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a><a href="{{ route('category.index')}}" class="current">Index Category</a> </div>
            <h1>Table Category</h1>
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
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Data table</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>Product ID</th>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Price</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr class="gradeX">
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->category_id }}</td>
                                            <td>{{ $product->category_name }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>  
                                            <td>{{ $product->product_color }}</td>
                                            <td>{{ $product->product_price }}</td>
                                            <td ><div class="fr">
                                                    <a href="{{ route('product.edit', $product->id) }}" class="btn btn-primary btn-mini">Edit</a>
                                                    <a id="product_delete" href="{{ route('product.delete', $product->id) }}" class="btn btn-danger btn-mini">Delete</a>
                                                </div>
                                            </td> 
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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