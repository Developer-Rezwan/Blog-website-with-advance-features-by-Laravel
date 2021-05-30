@extends('backend.layouts.backend-master')

@section('main-content')
<div class="row float-right mr-5">
    <a href="{{route('login')}}" class="btn btn-info">Login</a>
</div>
<section class="container col-6 my-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center text-info">Create A New Account</h2>
            <p class="card-text">
                <form class="p-2" action="{{ route('sign-up') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="FullName">Full Name</label>
                        <input type="text" class="form-control @error('fullName') is-invalid @enderror"
                            value="{{old('fullName')}}" name="fullName">
                        @error('fullName')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                            value="{{old('email')}}" name="email">
                        @error('email')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="phone_number">Phone</label>
                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                            value="{{old('phone_number')}}" name="phone_number">
                        @error('phone_number')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="photo">Photo</label>
                        <input type="file" class="form-control @error('photo') is-invalid @enderror"
                            value="{{old('photo')}}" name="photo">
                        @error('photo')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password">
                        @error('password')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror"
                            name="password_confirmation">
                        @error('password_confirmation')
                        <p class="text-danger font-italic">{{$message}}</p>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-info form-control">Sign-up Now</button>
                </form>
            </p>
        </div>
    </div>
</section>
@endsection
