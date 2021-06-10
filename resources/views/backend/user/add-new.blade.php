@extends('backend.layouts.backend-master')

@section('main-content')
<div class="row">
    <div class="container col-10">
        <div class="card card-solid">
            <div class="card-body pb-0">
                <h3 class="text-center text-success">Add New User</h3>
                <form class="form-horizontal" enctype="multipart/form-data" action="{{route('user.add-new')}}"
                    method="POST">
                    @csrf
                    <div class="form-group row">
                        <label for="inputName" class="col-sm-2 col-form-label">Full Name</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control @error('fullName') is-invalid @enderror"
                                id="inputName" name="fullName" value="{{old('fullName')}}"
                                placeholder="your full name...">
                            @error('fullName')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                id="inputEmail" name="email" value="{{old('email')}}" placeholder="Email">
                            @error('email')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputName2" class="col-sm-2 col-form-label">Phone Number</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('phone_number') is-invalid @enderror"
                                id="inputName2" name="phone_number" value="{{old('phone_number')}}"
                                placeholder=" 8801********">
                            @error('phone_number')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                                name="photo" placeholder="photo">
                            @error('photo')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="new_password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="new_password" name="password" placeholder="password">
                            @error('password')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm
                            Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror"
                                id="confirm_password" name="password_confirmation" placeholder="password">
                            @error('password_confirmation')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row ml-3">
                        <label for="role" class="col-sm-2 col-form-label">User Role</label>
                        <div class="col-sm-10">
                            <input type="radio" id="admin" name="role" class="form-check-input" value="admin"><label
                                for="admin">Admin</label> <br>
                            <input type="radio" id="author" name="role" class="form-check-input" value="author"><label
                                for="author">Author</label> <br>
                            <input type="radio" id="contributor" name="role" class="form-check-input"
                                value="contributor" checked><label for="contributor">Contributor</label>
                        </div>
                    </div>

                    <h3 class="py-3 text-center">About</h3>
                    <div class="form-group row">
                        <label for="inputExperience" class="col-sm-2 col-form-label">Education</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('education') is-invalid @enderror" name="education"
                                id="inputExperience" placeholder="Experience">{{old('education')}}</textarea>

                            @error('education')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('skills') is-invalid @enderror" name="skills"
                                id="inputSkills" value="{{old('skills')}}" placeholder="Skills">
                            @error('skills')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="location" class="col-sm-2 col-form-label">Location</label>
                        <div class="col-sm-10">
                            <input type="text" name="location"
                                class="form-control @error('location') is-invalid @enderror" id="location"
                                value="{{old('location')}}" placeholder="Address">
                            @error('location')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="description" class="col-sm-2 col-form-label">Notes</label>
                        <div class="col-sm-10">
                            <textarea class="form-control @error('description') is-invalid @enderror" rows="6" cols="30"
                                name="description" id="description"
                                placeholder="Notes">{{old('description')}}</textarea>
                            @error('location')
                            <p class="text-danger font-italic">{{$message}}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <button type="submit" class="btn btn-success">Create Now</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@stop
