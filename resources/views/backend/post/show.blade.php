@extends('backend.layouts.backend-master')
@section('main-content')
<div class="pb-2">
<a href="{{route('post.index')}}" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i> Back</a>
</div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title text-success text-center">POST DETAILS</h5>
            <p class="card-text">
             @foreach ($post as $value)
             <table class="table table-striped table-responsive">
               <thead class="bg-dark text-white text-center">
                   <th>Thumbnail</th>
                   <th>Details</th>
               </thead>
               <tbody>
                <tr>
                    <td>
                        <div class="pb-3"><img class="w-100" src="{{asset('storage/backend/images/'.$value->thumbnail_path)}}" alt=""></div>
                        Status :  <span class="text-center {{$value->status == 'trashed' || $value->status == 'unpublished' ? 'text-danger':'text-success'}}">{{$value->status == 'trashed' ? 'Trushed':($value->status == 'unpublised' ? 'Unpublised' : 'Published')}}</span>
                    </td>
                    <td>
                    <table>
                        <tr>
                            <td class="text-right text-bold" width="50%">User Name : </td>
                            <td class="text-left"> {{$value->user->fullName}}</td>
                        </tr>
                        <tr>
                          <td class="text-right" style="width:20px">Category : </td>
                          <td class="text-left"> {{$value->category->name}}</td>
                         </tr>
                         <tr>
                             <td class="text-right">Title : </td>
                             <td class="text-left"> {{$value->title}}</td>
                         </tr>
                         <tr>
                             <td class="text-right">Content : </td>
                             <td class="text-left"> {!! $value->content !!}</td>
                         </tr>
                    </table>
                    </td>
                </tr>
               </tbody>
             </table>
            @endforeach
            </p>
        </div>
    </div>
@stop
