@extends('frontend.layouts.frontend-master')

@section('main-content')
{{-- Trainer Button  --}}
<section id="banner">
    <div class="jumbotron py-1">
        <div class="text-center">
            <a href="#" class="btn btn-danger btn-sm">Be a trainer ! <small class="text-white-50">Share you
                    knowledge..</small></a>
        </div>
        {{-- Banner Section --}}
        <div id="carouselExampleControls" class="carousel slide py-2" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{asset('frontend/assets/banner/2.jpeg')}}" class="d-block w-100 image-fluid" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('frontend/assets/banner/2.jpeg')}}" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="{{asset('frontend/assets/banner/2.jpeg')}}" class="d-block w-100" alt="...">
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</section>
{{-- End Banner Section --}}

{{-- Feature Post --}}
<section id="feature-post" class="shadow-lg">
    <div class="card">
        <div class="card-header bg-light font-size-8">
            Featured Post
        </div>
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 ">
                <img class="w-100 text-right" src="{{asset('frontend/assets/trickbd-new-logo1.png')}}" alt="">
            </div>
            <div class="col-sm-11 col-md-11">
                <div class="card-body">
                    <a href="#" class="card-title">নতুন রূপে ট্রিকবিডি এর অফিশিয়াল অ্যান্ড্রয়েড অ্যাপ </a>
                    <div class="font-size-13">Oct 21, 2019 <a href="#">197 Comments</a></div>
                    <div class="font-size-13"> <span>9 days ago</span> By Rezwan</div>
                </div>
            </div>
        </div>
        <hr>
</section>
{{-- End Feature Post --}}

{{-- Hot Post --}}
<section id="hot_post" class="pt-1">
    <div class="card">
        <div class="card-header bg-light font-size-8">
            Hot Post
        </div>
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 ">
                <img class="w-100 text-right" src="{{asset('frontend/assets/post/Premium-Cookies-Of-1-200x200.png')}}"
                    alt="">
            </div>
            <div class="col-sm-11 col-md-11">
                <div class="card-body">
                    <a href="#" class="card-title">নতুন রূপে ট্রিকবিডি এর অফিশিয়াল অ্যান্ড্রয়েড অ্যাপ </a>
                    <div class="font-size-13">Oct 21, 2019 <a href="#">197 Comments</a></div>
                    <div class="font-size-13"> <span>9 days ago</span> By Rezwan</div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 ">
                <img class="w-100 text-right" src="{{asset('frontend/assets/post/60658a1d4eb55-200x200.png')}}" alt="">
            </div>
            <div class="col-sm-11 col-md-11">
                <div class="card-body">
                    <a href="#" class="card-title">নতুন রূপে ট্রিকবিডি এর অফিশিয়াল অ্যান্ড্রয়েড অ্যাপ </a>
                    <div class="font-size-13">Oct 21, 2019 <a href="#">197 Comments</a></div>
                    <div class="font-size-13"> <span>9 days ago</span> By Rezwan</div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 ">
                <img class="w-100 text-right" src="{{asset('frontend/assets/post/5fb52355e8b4d-200x181.jpeg')}}" alt="">
            </div>
            <div class="col-sm-11 col-md-11">
                <div class="card-body">
                    <a href="#" class="card-title">নতুন রূপে ট্রিকবিডি এর অফিশিয়াল অ্যান্ড্রয়েড অ্যাপ </a>
                    <div class="font-size-13">Oct 21, 2019 <a href="#">197 Comments</a></div>
                    <div class="font-size-13"> <span>9 days ago</span> By Rezwan</div>
                </div>
            </div>
        </div>
        <hr>
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 ">
                <img class="w-100 text-right" src="{{asset('frontend/assets/post/606574a51102f-200x200.jpg')}}" alt="">
            </div>
            <div class="col-sm-11 col-md-11">
                <div class="card-body">
                    <a href="#" class="card-title">নতুন রূপে ট্রিকবিডি এর অফিশিয়াল অ্যান্ড্রয়েড অ্যাপ </a>
                    <div class="font-size-13">Oct 21, 2019 <a href="#">197 Comments</a></div>
                    <div class="font-size-13"> <span>9 days ago</span> By Rezwan</div>
                </div>
            </div>
        </div>
        <hr>
    </div>
</section>
{{-- End hot post Post --}}

{{-- Recent Post --}}
<section id="recent-post" class="py-1">
    <div class="card">
        <div class="card-header bg-light font-size-8">
            Recent Post
        </div>

        @foreach ($posts as $post)
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 ">
                <img class="w-100 text-right" src="{{asset('storage/backend/images/'.$post->thumbnail_path)}}" alt="">
            </div>
            <div class="col-sm-11 col-md-11">
                <div class="card-body">
                    <a href="" class="card-title">{{$post->title}}</a>
                    <div class="font-size-13">{{$post->updated_at->format('F d, Y')}} <a href="#">197 Comments</a></div>
                    <div class="font-size-13"> <span>{{$post->updated_at->diffForHumans()}}</span> By <a
                            href="/">{{optional($post->user)->fullName}}</a></div>
                </div>
            </div>
        </div>
        <hr>
        @endforeach
    </div>
    <div class="pt-2 pb-2">
    </div>
</section>
{{-- End Recent post Post --}}

{{-- Ads --}}
<section id="ads">
    <img src="{{asset('frontend/assets/banner/1.jpeg')}}" width="100%" height="350px" alt="">
</section>
{{-- End Ads --}}

{{-- Post Category --}}
<section id="recent-post" class="py-1">
    <div class="card">
        <div class="card-header bg-light font-size-8">
            Categories
        </div>
        <div class="container-fluid">
            @foreach (optional($categories) as $category)
            <div class="text-dark">
                <span class="font-size-11">> </span>
                <a href="#">{{$category->name}}</a>
                <div class="border-top"></div>
            </div>
            @endforeach
        </div>
</section>
{{-- End Post Category --}}
@endsection
