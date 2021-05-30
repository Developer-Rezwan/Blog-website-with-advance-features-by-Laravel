@extends('frontend.layouts.frontend-master')
@section('main-content')

{{-- Ads Section --}}
{{-- Trainer Button  --}}
<section id="banner">
    <div class="jumbotron py-1">
        <div class="text-center">
            <a href="#" class="btn btn-danger btn-sm">Be a trainer ! <small class="text-white-50">Share you
                    knowledge..</small></a>
        </div>
        {{-- Banner Section --}}
        <div class="ads py-2">
            <img src="{{asset('frontend/assets/banner/2.jpeg')}}" class="d-block w-100 image-fluid" alt="...">
        </div>
        {{-- End Banner Section --}}
    </div>
</section>
{{-- Breadcrum --}}
<section id="breadcrum">
    <div class="breadcrum">
        <nav aria-label="Page breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item" aria-current="page"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Mobile Review</a></li>
                <li class="breadcrumb-item active"> শাওমি Miui রম এর মধ্যে আইফোন লোক এবং ফিল পেতে Ios Colour Style
                    কাস্টম থিম ইনস্টল
                    করুন</li>
            </ol>
        </nav>
    </div>
</section>
{{-- End Breadcurm --}}

{{-- Social link section --}}
<section id="social-link" class="bg-light mb-2">
    <div class="row justify-content-center">
        <ul class="nav">
            <li><a href="https://facebooke.com"><i class="fab fa-facebook fa-3x text-primary mx-2"></i></a></li>
            <li><a href="https://facebooke.com"><i class="fab fa-twitter fa-3x text-primary mx-2"></i></a></li>
            <li><a href="https://facebooke.com"><i class="fab fa-linkedin fa-3x text-primary mx-2"></i></a></li>
        </ul>
    </div>
</section>
{{-- End Social link section --}}

{{-- Post Details --}}
<section id="post_details" class="shadow-lg">
    <div class="card">
        <div class="card-header bg-light">
            <h4 class="text-bold">শাওমি Miui রম এর মধ্যে আইফোন লোক এবং ফিল পেতে Ios Colour Style কাস্টম থিম ইনস্টল করুন
            </h4>
        </div>
        <div class="container-fluid">
            <div class="card-body">
                {{cache()->get('posts')}}
            </div>
        </div>
        <hr>
</section>
{{-- End Post-Details Section --}}

{{-- Comment Section --}}
<section id="comment" class="my-2">
    <div class="card">
        <div class="card-header bg-light font-size-8">
            <h6>20 responses to “শাওমি Miui রম এর মধ্যে আইফোন লোক এবং ফিল পেতে Ios Colour Style কাস্টম থিম ইনস্টল করুন”
            </h6>
        </div>
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 text-right">
                <img class="w-50 rounded rounded-circle"
                    src="{{asset('frontend/assets/post/606574a51102f-200x200.jpg')}}" alt="">
            </div>
            <div class="col-sm-8 col-md-8">
                <div class="card-body">
                    <a href="#" class="card-title">Developer-Rezwan <span class="font-size-10">(Author)</span></a>
                    <p class="mt-3">কয়েক ঘণ্টা পর আপনাআপনি ডিফল্ট থিমস সেট হয়ে যায়। কয়েক ঘন্টার বেশি থাকে না। এই
                        সমস্যার সমাধান
                        থাকলে দেন।</p>
                </div>
            </div>
            <div class="col-sm-3 col-3 col-md-3 text-right">
                <p class="font-sm mt-2 font-size-11">April 1, 2021 at 7:43 pm </p>
                <a class="btn btn-sm btn-secondary mt-5" href="#">Login to Reply</a>
            </div>
        </div>
        <hr>
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 text-right">
                <img class="w-50 rounded rounded-circle"
                    src="{{asset('frontend/assets/post/606574a51102f-200x200.jpg')}}" alt="">
            </div>
            <div class="col-sm-8 col-md-8">
                <div class="card-body">
                    <a href="#" class="card-title">Developer-Rezwan <span class="font-size-10">(Author)</span></a>
                    <p class="mt-3">কয়েক ঘণ্টা পর আপনাআপনি ডিফল্ট থিমস সেট হয়ে যায়। কয়েক ঘন্টার বেশি থাকে না। এই
                        সমস্যার সমাধান
                        থাকলে দেন।</p>
                </div>
            </div>
            <div class="col-sm-3 col-3 col-md-3 text-right">
                <p class="font-sm mt-2 font-size-11">April 1, 2021 at 7:43 pm </p>
                <a class="btn btn-sm btn-secondary mt-5" href="#">Login to Reply</a>
            </div>
        </div>
        <hr>
        <div class="row container-fluid">
            <div class="col-sm-1 col-md-1 container-fluid mt-3 text-right">
                <img class="w-50 rounded rounded-circle"
                    src="{{asset('frontend/assets/post/606574a51102f-200x200.jpg')}}" alt="">
            </div>
            <div class="col-sm-8 col-md-8">
                <div class="card-body">
                    <a href="#" class="card-title">Developer-Rezwan <span class="font-size-10">(Author)</span></a>
                    <p class="mt-3">কয়েক ঘণ্টা পর আপনাআপনি ডিফল্ট থিমস সেট হয়ে যায়। কয়েক ঘন্টার বেশি থাকে না। এই
                        সমস্যার সমাধান
                        থাকলে দেন।</p>
                </div>
            </div>
            <div class="col-sm-3 col-3 col-md-3 text-right">
                <p class="font-sm mt-2 font-size-11">April 1, 2021 at 7:43 pm </p>
                <a class="btn btn-sm btn-secondary mt-5" href="#">Login to Reply</a>
            </div>
        </div>
        <hr>
</section>
{{-- End Comment Section --}}
@endsection
