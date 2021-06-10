@extends('backend.layouts.backend-master')

@section('main-content')
<a href="{{route('category.create')}}" class="btn btn-success btn-sm float-right">Add New</a>
<h3 class="text-center text-info">CATEGORIES-LIST</h3>
<hr>
<div class="table-responsive">
    <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
        <thead class="text-center bg-dark text-light">
            <th>#Sl</th>
            <th>Categories</th>
            <th>User</th>
            <th>Status</th>
            <th>Action</th>
        </thead>
        <tbody>
            @foreach ($categories as $category)
            <tr class="text-dark">
                <td>{{$loop->index+1}}</td>
                <td>{{$category->name}}</td>
                <td>{{{$category->user->fullName}}}</td>
                <td class="text-center"><span
                        class="btn btn-sm text-{{$category->status ? 'success':'danger'}}">{{$category->status ? 'Active':'Inactive'}}</span>
                </td>
                <td width="20%" class="text-center">
                    <form action="{{ route('category.destroy',$category->id) }}" method="POST"
                        onsubmit="return confirm('Are you Sure???')">
                        @csrf
                        @method('DELETE')
                        <a href="{{route('category.edit',$category->slug)}}" class="btn btn-success btn-sm"><i
                                class="fa fa-edit"></i></a>
                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button
                            type="submit">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@stop
