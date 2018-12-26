
@extends('admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}" />
@endsection

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a><a href="{{ route('product.create')}}" class="current">Create product</a> </div>
            <h1>Form create</h1>
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
                            <h5>Add Attributes</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ route('productAttributes.create', $productDetails->id)}}" name="add_productribute" id="add_productribute" > {{ csrf_field()}}

                                <input type="hidden" name="product_id" value="{{ $productDetails->id }}">
                                <div class="control-group">
                                    <label class="control-label">Category Name</label>
                                    <label class="control-label"><strong>{{ $category_name }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <label class="control-label"><strong>{{ $productDetails->product_name }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code</label>
                                    <label class="control-label"><strong>{{ $productDetails->product_code }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Color</label>
                                    <label class="control-label"><strong>{{ $productDetails->product_color }}</strong></label>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Add Product Attribute</label>
                                    <div class="controls field_wrapper">
                                        <input required title="Required" type="text" name="sku[]" id="sku" placeholder="SKU" style="width:120px;">
                                        <input required title="Required" type="text" name="size[]" id="size" placeholder="Size" style="width:120px;">
                                        <input required title="Required" type="text" name="price[]" id="price" placeholder="Price" style="width:120px;"> 
                                        <input required title="Required" type="text" name="stock[]" id="stock" placeholder="Stock" style="width:120px;">
                                        <button href="javascript:void(0);" class="btn btn-info add_button" title="Add field">Add</button>
                                    </div>
                                </div>
                                
                                <div class="form-actions">
                                    <input type="submit" value="Add Attributes" class="btn btn-success">
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
                            <h5>View Product Attributes</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form action="{{ route('productAttributes.edit', $productDetails->id) }}" method="POST">{{ csrf_field() }}
                                <table class="table table-bordered data-table">
                                    <thead>
                                        <tr>
                                            <th>Attribute ID</th>
                                            <th>SKU</th>
                                            <th>Size</th>
                                            <th>Price</th>
                                            <th>Stock</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($productDetails['attributes'] as $attribute)
                                            <tr class="gradeX">
                                                <td ><input type="hidden" name="idAttr[]" value="{{ $attribute->id }}">{{ $attribute->id }}</td>
                                                <td >{{ $attribute->sku }}</td>
                                                <td >{{ $attribute->size }}</td>
                                                <td ><input name="price[]" value="{{ $attribute->price }}" type="text" required></td>
                                                <td ><input name="stock[]" value="{{ $attribute->stock }}" type="text" required></td>
                                                <td >
                                                    <input type="submit" value="Update" class="btn btn-primary btn-mini" />
                                                    <a rel="{{ $attribute->id }}" rel1="delete-attribute" href="javascript:" class="btn btn-danger btn-mini deleteRecord">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
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