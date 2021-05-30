@extends('backend.layouts.backend-master')

@section('main-content')
<section class="container col-6 my-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center text-info">Login</h2>
            <p class="card-text">

                <!-- Erorr Message -->
                @if (session()->has('status'))
                <div class="alert {{session('class')}} text-center">{{session('status')}}</div>
                @endif
                @if (session()->has('error'))
                <div class="alert alert-danger text-center">{{session('error')}}</div>
                @endif

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

                <form class="p-2" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email Address"
                            value="rezwanhossainsajeeb@gmail.com">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" name="password" value="password"
                            placeholder="minimum 6 chars password">
                    </div>
                    <button type="submit" class="btn btn-info form-control">Login</button>
                    <div class="mt-3"><span class="text-dark">Recover your </span><a
                            href="{{route('forget.password')}}">Forgotten
                            Password.</a> OR <a href="{{route('sign-up')}}">Create a new account.</a></div>
                </form>
            </p>
        </div>
    </div>
</section>
@endsection
