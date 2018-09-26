
@extends('admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}" />
@endsection

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a><a href="{{ route('category.create')}}" class="current">Create Category</a> </div>
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
                            <h5>Add a new category</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{ route('category.store')}}" name="add_category" id="add_category" novalidate="novalidate"> {{ csrf_field()}}
                                <div class="control-group">
                                    <label class="control-label">Category Name</label>
                                    <div class="controls">
                                        <input type="text" name="category_name" id="category_name" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea placeholder="Place some text here" id="description" name="description"></textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Slug</label>
                                    <div class="controls">
                                        <input type="text" name="slug" id="slug" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status" value="1"/>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Add Category" class="btn btn-success">
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