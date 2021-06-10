@extends('backend.layouts.backend-master')

@section('main-content')
<a href="{{route('category.index')}}" class="btn btn-success btn-sm float-left"><i class="fa fa-arrow-left"></i>
    Back</a>
<section class="container col-6 my-5">
    <div class="card">
        <div class="card-body">
            <h3 class="text-center text-info">Update Category</h3>
            <p class="card-text">

                <!-- Erorr Message -->
                @if (session()->has('message'))
                <div class="alert {{ session('class') }} text-center">{{session('message')}}</div>
                @endif
                <!-- End Erorr Message -->

                @if ($errors->any())
                <ul class="alert alert-danger text-center">
                    @if ($errors->count() === 1)
                    {{$errors->first()}}
                    @else
                    @foreach ($errors->all() as $error)
                    <li class="font-italic">{{$error}}</li>
                    @endforeach
                    @endif
                </ul>
                @endif
                @foreach ($editCategory as $category)
                <form class="p-2" action="{{ route('category.update',$category->slug) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="data" value="{{ encrypt($category->id) }}">
                    <div class="form-group">
                        <label for="name">Category</label>
                        <input type="text" class="form-control" name="name" id="category" placeholder="Category Name"
                            value="{{$category->name}}">
                    </div>
                    <div class="form-group">
                        <label for="slug">Slug</label>
                        <input type="text" disabled class="form-control" name="slug" id="slug"
                            value="{{$category->slug}}" placeholder="category-slug">
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="status" id="status" {{$category->status ? 'checked':''}}
                            data-CheckBoxvalue='{{$category->status}}'>
                        <label for="status">&nbsp; <span id="statusText"
                                class="text-{{$category->status ? 'success':'danger'}}">{{$category->status ? 'Active':'Inactive'}}</span></label>
                    </div>
                    <button type="submit" class="btn btn-info form-control">Update Now</button>
                </form>
                @endforeach
            </p>
        </div>
    </div>
</section>
@stop
