@extends('backend.layouts.backend-master')

@section('main-content')
<section class="container col-6 my-5">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title text-center text-info">Search your account</h4>
            <p class="card-text">

                <!-- Erorr Message -->
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

                <form class="p-2" action="{{ route('forget.password') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Email Address"
                            value="rezwanhossainsajeeb@gmail.com">
                    </div>
                    <button type="submit" class="btn btn-info form-control"><i class="fa fa-arrow-right"></i></button>
                </form>
            </p>
        </div>
    </div>
</section>
@endsection
