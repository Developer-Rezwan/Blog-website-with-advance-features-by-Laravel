@extends('backend.layouts.backend-master')

@section('main-content')
<a href="{{route('sub-category.index')}}" class="btn btn-sm btn-success float-left"><i class="fa fa-arrow-left"></i> Back</a>
  <section class="container col-6 my-5">
    <div class="card">
        <div class="card-body">
        <h2 class="card-title text-center text-info">Sub Category</h2>
        <p class="card-text">

        <!-- Erorr Message -->
        @if (session()->has('message'))
            <div class="alert {{ session('success') }} text-center">{{session('message')}}</div>
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
        <form class="p-2" action="{{ route('sub-category.update',$subCategory->slug) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="data" value="{{encrypt($subCategory->id)}}">
        <div class="form-group">
            <select name="category_Id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach ($categories as $category)
                   <option value="{{$category->id}}" {{ $category->id === $subCategory->category->id ? 'selected':''}}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="name">Sub Category</label>
            <input type="text" class="form-control" name="name" id="subCategory" placeholder="Name" value="{{$subCategory->name}}">
        </div>
        <div class="form-group">
            <label for="slug">Slug</label>
            <input type="text" disabled class="form-control" name="slug" id="subCatSlug" value="{{ $subCategory->slug }}" placeholder="category-slug">
        </div>
        <div class="form-group">
            <input type="checkbox" name="status" id="SubCategoryStatus" {{ $subCategory->status ? 'checked':''}} data-SubCatCheckBoxvalue='{{$subCategory->status}}' >
            <label for="SubCategoryStatus">&nbsp; <span id="SubCatstatusText" class="text-{{ $subCategory->status ? 'success':'danger'}}">{{ $subCategory->status ? 'Active':'Inactive'}}</span></label>
        </div>
            <button type="submit" class="btn btn-info form-control">Save Now</button>
        </form>
      </p>
    </div>
  </div>
 </section>
@stop
