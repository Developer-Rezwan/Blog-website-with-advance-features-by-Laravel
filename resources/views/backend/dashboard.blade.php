@extends('backend.layouts.backend-master')

@section('main-content')
<div class="container-fluid">
    <!-- Page Heading -->

    <!-- Confirm Messages -->
    @if (session()->has('status'))
      <div class="alert alert-success text-center">{{session('status')}}</div>
    @endif
    <!-- End Confirm Messages -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Cards</h1>
</div>

    <div class="row">

    <!-- Total Blog Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <a href="{{route('post.index')}}" class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Total Posts</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$allPost}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-blog fa-2x text-gray-300"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <!-- End Total Blog Card -->

    <!-- Pending Post Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <a href="{{route('pending.index')}}">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Pending Post </div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$pendingPost}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-tag fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <!-- End Pending Post Card -->

        <!--  Total Visitor Card-->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-info shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Target Posts
                        </div>
                        <div class="row no-gutters align-items-center">
                            <div class="col-auto">
                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{$allPost}}</div>
                            </div>
                            <div class="col">
                                <div class="progress progress-sm mr-2">
                                    <div class="progress-bar bg-info" role="progressbar"
                                        style='width: {{ $allPost }}%' aria-valuenow="{{$allPost}}" aria-valuemin="0"
                                        aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Total Visitor-->

    <!-- Total Category Card -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-success shadow h-100 py-2">
            <a href="{{route('category.index')}}">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                            Total Categories</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{$category}}</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-list-alt fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>
    <!-- End Total Category Card -->

    <!-- Pending Requests Card Example -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-warning shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                            Pending Comment</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
@endsection
