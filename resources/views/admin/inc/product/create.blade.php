
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
                            <h5>Add a new product</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" enctype="multipart/form-data" method="post" action="{{ route('product.create')}}" name="add_product" id="add_product" novalidate="novalidate"> {{ csrf_field()}}

                                <div class="control-group">
                                    <label class="control-label">Choice Category</label>
                                    <div class="controls" >
                                        <select name="category_id" id="category_id" style="width:220px;">
                                            <?php echo $categories_drop_down; ?>
                                            {{-- <option selected disabled>Choice something</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                                @foreach($sub_categories as $sub_category)
                                                    <option value="{{ $sub_category->id }}">&nbsp;&nbsp;--&nbsp;{{ $sub_category->name }}</option>
                                                @endforeach
                                            @endforeach --}}
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Name</label>
                                    <div class="controls">
                                        <input type="text" name="product_name" id="product_name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Code</label>
                                    <div class="controls">
                                        <input type="text" name="product_code" id="product_code" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Color</label>
                                    <div class="controls">
                                        <input type="text" name="product_color" id="product_color" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea placeholder="Place some text here" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Material & Care</label>
                                    <div class="controls">
                                        <textarea placeholder="Place some text here" id="care" name="care"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Product Price</label>
                                    <div class="controls">
                                        <input type="text" name="price" id="price" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Image</label>
                                    <div class="controls">
                                        <div class="uploader" id="uniform-undefined">
                                            <input name="image" id="image" type="file" size="19" style="opacity: 0;">
                                            <span class="filename">No file selected</span>
                                            <span class="action">Choose File</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status" value="1"/>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add product" class="btn btn-success">
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