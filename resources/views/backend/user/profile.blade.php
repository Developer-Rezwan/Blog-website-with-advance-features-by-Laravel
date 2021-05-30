@extends('backend.layouts.backend-master')

@section('main-content')
<section class="content" id="profile">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

                <!-- Profile Image -->
                <div class="card card-primary card-outline mb-3">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" style="height:95px"
                                src="{{asset('storage/backend/images/'.auth()->user()->photo)}}"
                                alt="{{auth()->user()->photo}}">
                        </div>

                        <h4 class="profile-username text-center">{{auth()->user()->fullName}}</h4>

                        <p class="text-muted text-center">{{Str::ucfirst(optional(auth()->user())->role)}}</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Posts</b> <a class="float-right">{{auth()->user()->posts->count()}}</a>
                            </li>
                            <li class="list-group-item">
                                <b>Likes</b> <a class="float-right">543</a>
                            </li>
                            <li class="list-group-item">
                                <b>Comments</b> <a class="float-right">13,287</a>
                            </li>
                        </ul>

                        <a href="#settings" class="btn btn-primary btn-block" data-toggle="tab"><b>Update
                                Profile</b></a>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <!-- About Me Box -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">About Me</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <strong><i class="fas fa-book mr-1"></i> Education</strong>

                        <p class="text-muted">
                            {{optional(auth()->user()->about)->education}}
                        </p>

                        <hr>

                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                        <p class="text-muted">{{optional(auth()->user()->about)->location}}</p>

                        <hr>

                        <strong><i class="fas fa-pencil-alt mr-1"></i> Skills</strong>

                        <p class="text-muted">
                            {{optional(auth()->user()->about)->skills}}
                        </p>

                        <hr>

                        <strong><i class="far fa-file-alt mr-1"></i> Notes</strong>

                        <p class="text-muted">
                            {{optional(auth()->user()->about)->description}}
                        </p>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Posts</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Comment</a>
                            </li>
                            <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Settings</a>
                            </li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="active tab-pane" id="activity">
                                <!-- Post -->
                                @foreach (auth()->user()->posts as $post)
                                <div class="post">
                                    <div class="user-block">
                                        <img class="img-circle img-bordered-sm"
                                            src="{{asset('storage/backend/images/'.$post->thumbnail_path)}}"
                                            alt="{{$post->thumbnail_path}}">
                                        <span class="username">
                                            <a href="{{route('post.show',$post->slug)}}">{{$post->title}}</a>
                                        </span>
                                        <span class="description">Shared publicly -
                                            {{$post->updated_at->diffForHumans()}}</span>
                                    </div>
                                    <!-- /.user-block -->
                                    <p>{!!substr($post->content,0,400)!!}....<a
                                            href="{{route('post.show',$post->slug)}}">read more</a>
                                    </p>

                                    <p>
                                        <a class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i>
                                            {{Str::ucfirst($post->status)}}</a>
                                        <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i>
                                            Like (10)</a>
                                        <span class="float-right">
                                            <a href="#" class="link-black text-sm">
                                                <i class="far fa-comments mr-1"></i> Comments (5)
                                            </a>
                                        </span>
                                    </p>

                                    <input class="form-control form-control-sm" type="text"
                                        placeholder="Type a comment">
                                </div>
                                @endforeach
                                <!-- /.post -->
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="timeline">
                                <!-- The timeline -->
                                <div class="timeline timeline-inverse">
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-danger">
                                            10 Feb. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-envelope bg-primary"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 12:05</span>

                                            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email
                                            </h3>

                                            <div class="timeline-body">
                                                Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,
                                                weebly ning heekya handango imeem plugg dopplr jibjab, movity
                                                jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle
                                                quora plaxo ideeli hulu weebly balihoo...
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-primary btn-sm">Read more</a>
                                                <a href="#" class="btn btn-danger btn-sm">Delete</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-user bg-info"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 5 mins ago</span>

                                            <h3 class="timeline-header border-0"><a href="#">Sarah Young</a> accepted
                                                your friend request
                                            </h3>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-comments bg-warning"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 27 mins ago</span>

                                            <h3 class="timeline-header"><a href="#">Jay White</a> commented on your post
                                            </h3>

                                            <div class="timeline-body">
                                                Take me to your leader!
                                                Switzerland is small and neutral!
                                                We are more like Germany, ambitious and misunderstood!
                                            </div>
                                            <div class="timeline-footer">
                                                <a href="#" class="btn btn-warning btn-flat btn-sm">View comment</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <!-- timeline time label -->
                                    <div class="time-label">
                                        <span class="bg-success">
                                            3 Jan. 2014
                                        </span>
                                    </div>
                                    <!-- /.timeline-label -->
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-camera bg-purple"></i>

                                        <div class="timeline-item">
                                            <span class="time"><i class="far fa-clock"></i> 2 days ago</span>

                                            <h3 class="timeline-header"><a href="#">Mina Lee</a> uploaded new photos
                                            </h3>

                                            <div class="timeline-body">
                                                <img src="http://placehold.it/150x100" alt="...">
                                                <img src="http://placehold.it/150x100" alt="...">
                                                <img src="http://placehold.it/150x100" alt="...">
                                                <img src="http://placehold.it/150x100" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END timeline item -->
                                    <div>
                                        <i class="far fa-clock bg-gray"></i>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->

                            <div class="tab-pane" id="settings">
                                <ul class="alert-danger">
                                    @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                    @endforeach
                                    @endif
                                </ul>
                                <form class="form-horizontal" enctype="multipart/form-data"
                                    action="{{route('profile.update')}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Full Name</label>
                                        <div class="col-sm-10">
                                            <input type="name" class="form-control" id="inputName" name="fullName"
                                                value="{{auth()->user()->fullName}}" placeholder="your full name...">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                            <input type="email" class="form-control" id="inputEmail" name="email"
                                                value="{{auth()->user()->email}}" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Phone Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputName2" name="phone_number"
                                                value="{{auth()->user()->phone_number}}" placeholder="8801********">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="photo" class="col-sm-2 col-form-label">Photo</label>
                                        <div class="col-sm-10">
                                            <input type="file" class="form-control" id="photo" name="photo"
                                                placeholder="photo">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="new_password" class="col-sm-2 col-form-label">New Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" class="form-control" id="new_password"
                                                name="password" placeholder="password">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="confirm_password" class="col-sm-2 col-form-label">Confirm
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="confirm_password"
                                                name="password_confirmation" placeholder="password">
                                        </div>
                                    </div>

                                    <h3 class="py-3 text-center">About</h3>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Education</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" name="education" id="inputExperience"
                                                placeholder="Experience">{{optional(auth()->user()->about)->education}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" name="skills" id="inputSkills"
                                                value="{{optional(auth()->user()->about)->skills}}"
                                                placeholder="Skills">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="location" class="col-sm-2 col-form-label">Location</label>
                                        <div class="col-sm-10">
                                            <input type="text" name="location" class="form-control" id="location"
                                                value="{{optional(auth()->user()->about)->location}}"
                                                placeholder="Address">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="description" class="col-sm-2 col-form-label">Notes</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" rows="6" cols="30" name="description"
                                                id="description"
                                                placeholder="Notes">{{optional(auth()->user()->about)->description}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                            <button type="submit" class="btn btn-danger">Update Now</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div><!-- /.container-fluid -->
</section>
@stop
