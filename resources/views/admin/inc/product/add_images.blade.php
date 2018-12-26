
@extends('admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}" />
@endsection

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a></div>
            <h1>Form upload Product Alternate Image </h1>
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
                            <h5>Add Product Image</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ route('AlternateImage', $productDetail->id)}}" name="add_productribute" id="add_productribute" > {{ csrf_field()}}

                                <input type="hidden" name="product_id" value="{{ $productDetail->id }}">
                                <div class="control-group">
                                    <label class="control-label">Category Name</label>
                                    <label class="control-label"><strong>{{ $category_name }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <label class="control-label"><strong>{{ $productDetail->product_name }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code</label>
                                    <label class="control-label"><strong>{{ $productDetail->product_code }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Color</label>
                                    <label class="control-label"><strong>{{ $productDetail->product_color }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Alternate Image(s)</label>
                                    <div class="controls">
                                        <div class="uploader" id="uniform-undefined"><input name="image[]" id="image" type="file" multiple="multiple"></div>
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <input type="submit" value="Add Image" class="btn btn-success">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                            <h5>Product Alternate Image</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table">
                                <thead>
                                    <tr>
                                        <th>Attribute ID</th>
                                        <th>Product ID</th>
                                        <th>Image</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($productImages as $image)
                                    <tr class="gradeX">
                                        <td class="center">{{ $image->id }}</td>
                                        <td class="center">{{ $image->product_id }}</td>
                                        <td class="center"><img width="100px;" src="{{ asset('images/admin/product/small/'.$image->image) }}"></td>
                                        <td class="center">
                                            <a id="delImage" rel="{{ $image->id }}" rel1="delete-alt-image" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
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