@extends('backend.layouts.backend-master')

@section('main-content')
<a href="{{route('post.create')}}" class="btn btn-success btn-sm float-right">Add New</a>
<h3 class="text-center text-info">{{$header}}</h3>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead class="text-center bg-dark text-light">
            <th>#Sl</th>
            <th>Thumbnail</th>
            <th>Title</th>
            <th>Category</th>
            <th>User</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php
            $sl = 1;
            @endphp
            @foreach ($posts as $post)
            @if ($post->category->status)
            <tr class="text-dark">
                <td>{{$sl++}}</td>
                <td class="text-center"><img width="100px"
                        src="{{asset('storage/backend/images/'.$post->thumbnail_path)}}"></td>
                <td>{{substr($post->title,0,30)}}</td>
                <td>{{$post->category->name}}</td>
                <td>{{$post->user->fullName}}</td>
                <td><span
                        class="text-center {{$post->status == 'trashed' || $post->status == 'unpublished' ? 'text-danger':'text-success'}}">{{$post->status == 'trashed' ? 'Trushed':($post->status == 'unpublished' ? 'Unpublised' : 'Published')}}</span>
                </td>
                <td style="width:15%">
                    <form action="{{ route('trashed.destroy',$post->id) }}" method="POST"
                        onsubmit="return confirm('Are Sure To Delete ???')">
                        @csrf
                        @method('DELETE')
                        <a href="{{route('post.show',$post->slug)}}" class="btn btn-info btn-sm"><i
                                class="fa fa-eye"></i></a>
                        <a href="{{route('trashed.restore',$post->slug)}}" class="btn btn-success btn-sm"><i
                                class="fa fa-recycle"></i></a>
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endif
            @endforeach
        </tbody>
    </table>
</div>
@stop
