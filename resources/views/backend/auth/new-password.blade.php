@extends('backend.layouts.backend-master')

@section('main-content')
<section class="container col-6 my-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center text-info">Create New Password</h2>
            <p class="card-text">

                <!-- Erorr Message -->
                @if (session()->has('error'))
                <div class="alert alert-danger text-center">{{session('error')}}</div>
                @endif
                @if (session()->has('success'))
                <div class="alert alert-success text-center">{{session('success')}}</div>
                @endif

                <!-- End Erorr Message -->

                @if ($errors->any())
                <ul class="alert alert-danger">
                    @if ($errors->count() === 1)
                    {{$errors->first()}}
                    @else
                    @foreach ($errors->all() as $error)
                    <li class="font-italic">{{$error}}</li>
                    @endforeach
                    @endif
                </ul>
                @endif
                <!-- End Erorr Message -->

                <form class="p-2" action="{{ route('new.password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="password">New Password</label>
                        <input type="password" class="form-control" name="password" placeholder="8 chars.....">
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password_confirmation" class="form-control" name="password_confirmation"
                            placeholder="8 chars.....">
                    </div>
                    <button type="submit" class="btn btn-info form-control"><i class="fa fa-arrow-right"></i></button>
                </form>
            </p>
        </div>
    </div>
</section>
@endsection
