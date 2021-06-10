@extends('backend.layouts.backend-master')
@section('main-content')
<div class="card">
    <div class="card-body">
        <h3 class="text-center">
            <span class="text-success"> Add New Post </span>
        </h3>
        <p class="card-text">
            <div class="col-8 container">
                <form action="{{route('post.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" placeholder="Enter your title"
                            class="form-control @error('title') is-invalid @enderror " value="{{old('title')}}">
                        @error('title')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="category">Category</label>
                        <select name="category_id" class="form-control @error('title') is-invalid @enderror">
                            <option value="">Select A Category</option>
                            @foreach ($categories as $category )
                            <option value="{{$category->id}}">
                                {{$category->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="editor">Content</label>
                        <textarea name="content" id="editor"
                            class="form-control @error('content') is-invalid @enderror">{{old('content')}}</textarea>
                        @error('content')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="Thumbnail_Path">Thumbnail Image</label>
                        <input type="file" class="form-control @error('thumbnail_path') is-invalid @enderror "
                            name="thumbnail_path" id="Thumbnail_Path" value="{{old('thumbnail_path')}}">
                        @error('thumbnail_path')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="status"></label>
                        <input type="radio" name="status" id="published" value="published" checked> <label
                            for="published">Published</label> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" name="status" id="pending" value="pending"> <label
                            for="pending">Pending</label>
                    </div>
                    <input type="submit" class="form-control btn btn-success" value="Create Now">
                </form>
            </div>
        </p>
    </div>
</div>
@stop
