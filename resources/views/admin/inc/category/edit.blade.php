
@extends('admin.app')

@section('head')
<link rel="stylesheet" href="{{ asset('css/admin/uniform.css')}}" />
<link rel="stylesheet" href="{{ asset('css/admin/select2.css')}}" />
@endsection

@section('content')
    <div id="content">
        <div id="content-header">
            <div id="breadcrumb"> <a href="{{ route('admin.dashboard')}}" title="Go to Home" class="tip-bottom"><i class="icon-home"></i>
            Home</a><a href="{{ route('category.edit', $category->id)}}" class="current">Edit Category</a> </div>
            <h1>Form create</h1>
        </div>
        <div class="container-fluid">
            <div class="row-fluid">
                <div class="span12">
                    <div class="widget-box">
                        <div class="widget-title"> <span class="icon"> <i class="icon-info-sign"></i> </span>
                            <h5>Add a new category</h5>
                        </div>
                        <div class="widget-content nopadding">
                            <form class="form-horizontal" method="post" action="{{ route('category.update', $category->id)}}" name="edit_category" id="edit_category" novalidate="novalidate">
                                 {{ csrf_field()}}
                                 {{ method_field('PUT')}}
                                <div class="control-group">
                                    <label class="control-label">Category Name</label>
                                    <div class="controls">
                                        <input type="text" name="category_name" id="category_name" value="{{ $category->name }}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Category Level</label>
                                    <div class="controls" >
                                        <select name="parent_id" style="width:220px;">
                                            <option value="0">Main Category </option>
                                            @foreach($levels as $val)
                                                <option value="{{ $val->id }}" @if($val->id == $category->parent_id) selected @endif >{{ $val->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Description</label>
                                    <div class="controls">
                                        <textarea placeholder="Place some text here" id="description" name="description">{{ $category->description }}</textarea>
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label" >Slug</label>
                                    <div class="controls">
                                        <input type="text" name="slug" id="slug" value="{{ $category->slug }}" />
                                    </div>
                                </div>
                                <div class="control-group">
                                    <label class="control-label">Enable</label>
                                    <div class="controls">
                                        <input type="checkbox" name="status" id="status" @if($category->status == '1') checked @endif value="1"/>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <input type="submit" value="Update Category" class="btn btn-success">
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