@extends('backend.layouts.backend-master')

@section('main-content')
<h3 class="text-center text-info">Recycle Bean</h3>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead class="text-center bg-dark text-light">
            <th>#Sl</th>
            <th>Photo</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Type</th>
            <th>Action</th>
        </thead>
        <tbody>
            @php
            $sl = 1;
            @endphp
            @foreach ($users as $user)
            <tr class="text-dark">
                <td>{{$sl++}}</td>
                <td class="text-center"><img width="100px" src="{{asset('storage/backend/images/'.$user->photo)}}"></td>
                <td>{{$user->fullName}}</td>
                <td>{{$user->email}}</td>
                <td>{{Str::ucfirst($user->role)}}</td>
                <td style="width:15%">
                    <form action="{{route('user.delete',$user->id)}}" method="POST"
                        onsubmit="return confirm('Are Sure To Delete ???')">
                        @csrf
                        @method('DELETE')
                        <a href="{{route('user.restore',encrypt($user->id))}}" class="btn btn-success btn-sm"><i
                                class="fa fa-recycle"></i></a>
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
