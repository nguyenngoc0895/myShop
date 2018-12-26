
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
                                        <th>S.No</th>
                                        <th>Product ID</th>
                                        <th>Category ID</th>
                                        <th>Category Name</th>
                                        <th>Product Name</th>
                                        <th>Product Code</th>
                                        <th>Product Color</th>
                                        <th>Price</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($products as $product)
                                        <tr class="gradeX">
                                            <td>{{ $loop->index + 1 }}</td>
                                            <td>{{ $product->id }}</td>
                                            <td>{{ $product->category_id }}</td>
                                            <td>{{ $product->category_name }}</td>
                                            <td>{{ $product->product_name }}</td>
                                            <td>{{ $product->product_code }}</td>  
                                            <td>{{ $product->product_color }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>
                                                @if(!empty($product->image))
                                            <img src="{{ asset('/images/admin/product/small/'.$product->image) }}" style="width:50px;">
                                                @endif
                                            </td>
                                            <td >
                                                <div class="fr">
                                                    <a href="#myModal{{ $product->id }}" data-toggle="modal" title="view product" class="btn btn-success btn-mini">View</a>
                                                    <a href="{{ route('product.edit', $product->id) }}" title="update product" class="btn btn-primary btn-mini">Edit</a>
                                                    <a href="{{ route('productAttributes.create', $product->id) }}" title="add attribute product" class="btn btn-success btn-mini">Add Attribute </a>
                                                    <a href="{{ route('AlternateImage', $product->id) }}" title="Alternate Image" class="btn btn-success btn-mini">Add Image </a>
                                                    <a rel="{{ $product->id }}" rel1="delete-product" href="javascript:"   class="btn btn-danger btn-mini deleteRecord" title="delete product">Delete</a>
                                                </div>
                                            </td> 
                                        </tr>
                                        <div id="myModal{{ $product->id }}" class="modal hide">
                                            <div class="modal-header">
                                                <button data-dismiss="modal" class="close" type="button">×</button>
                                                <h3>{{ $product->product_name }} Full Details</h3>
                                            </div>
                                            <div class="modal-body">
                                                <p><b>Product ID:</b> {{ $product->id }}</p>
                                                <p><b>Category ID:</b> {{ $product->category_id }}</p>
                                                <p><b>Category name:</b> {{ $product->category_name }}</p>
                                                <p><b>Product code:</b> {{ $product->product_code }}</p>  
                                                <p><b>Product color:</b> {{ $product->product_color }}</p>
                                                <p><b>Product price:</b> {{ $product->price }}</p>
                                                <b>Image:</b>
                                                <div align="center">
                                                    @if(!empty($product->image))
                                                        <img src="{{ asset('/images/admin/product/small/'.$product->image) }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
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