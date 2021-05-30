@extends('backend.layouts.backend-master')

@section('main-content')
<section class="container col-6 my-5">
 <div class="card">
  <div class="card-body">
   <h2 class="card-title text-center text-info">Verify code</h2>
   <p class="card-text">

    <!-- Erorr Message -->
    @if (session()->has('error'))
   <div class="alert alert-danger text-center">{{session('error')}}</div>
   @endif
   @if (session()->has('success'))
   <div class="alert alert-success text-center">{{session('success')}}</div>
   @endif

   <!-- End Erorr Message -->

   <form class="p-2" action="{{ route('verify-phone') }}" method="POST">
    @csrf
    <div class="form-group">
     <label for="code">Code</label>
     <input type="code" class="form-control" name="code" placeholder="6 digits.....">
    </div>
    <button type="submit" class="btn btn-info form-control"><i class="fa fa-arrow-right"></i></button>
   </form>
   </p>
  </div>
 </div>
</section>
@endsection
