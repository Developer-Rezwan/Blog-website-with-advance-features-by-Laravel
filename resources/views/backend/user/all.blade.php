@extends('backend.layouts.backend-master')

@section('main-content')
<section class="content">

    <!-- Default box -->
    <div class="card card-solid">
        <div class="card-body pb-0">
            <div class="row d-flex align-items-stretch">
                @foreach ($users as $user)
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            {{Str::ucfirst($user->role)}}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{$user->fullName}}</b></h2>
                                    <p class="text-muted text-sm"><b>Skills: </b> {{optional($user->about)->skills}}
                                    </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-address-book"></i></span> Address:
                                            {{optional($user->about)->location}}</li>
                                        <li class="small py-2"><span class="fa-li"><i
                                                    class="fas fa-lg fa-phone"></i></span>
                                            Phone #: {{$user->phone_number}}</li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{asset('storage/backend/images/'.$user->photo)}}" alt="{{$user->photo}}"
                                        class="img-fluid img-circle" style="width:105px;height:100px">
                                    <ul class="ml-4 pt-3 mb-0 fa-ul text-muted text-left">
                                        <li class="small"><i class="fas fa-lg fa-blog"></i></span>
                                            Post:
                                            {{optional($user->posts)->count()}}</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <form action="{{route('user.destroy',$user->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are You Sure')"
                                        class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                                    <a href="#" class="btn btn-sm bg-teal">
                                        <i class="fas fa-comments"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-primary">
                                        <i class="fas fa-user"></i> View Profile
                                    </a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <nav aria-label="Contacts Page Navigation">
                <ul class="pagination justify-content-center m-0">
                    {!!$users->links()!!}
                </ul>
            </nav>
        </div>
        <!-- /.card-footer -->
    </div>
    <!-- /.card -->

</section>
@stop
