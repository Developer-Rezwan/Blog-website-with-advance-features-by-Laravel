@extends('backend.layouts.backend-master')

@section('main-content')
<a href="{{route('sub-category.create')}}" class="btn btn-success btn-sm float-right">Add New</a>
<h3 class="text-center text-info">SUB-CATEGORIES LIST</h3>
<hr>
<div class="table-responsive">
  <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
    <thead class="text-center bg-dark text-light">
        <th>#Sl</th>
        <th>Sub-Categories</th>
        <th>Categories</th>
        <th>Status</th>
        <th>Action</th>
    </thead>
    <tbody>
        @foreach ($subCategories as $subCategory)
            @if ($subCategory->category->status === 1)
                <tr class="text-dark">
                    <td>{{$loop->index+1}}</td>
                    <td>{{$subCategory->name}}</td>
                    <td>{{$subCategory->category->name}}</td>
                <td class="text-center"><span class="btn btn-sm text-{{$subCategory->status ? 'success':'danger'}}">{{$subCategory->status ? 'Active':'Inactive'}}</span></td>
                    <td width="20%" class="text-center">
                        <form action="{{ route('sub-category.destroy',$subCategory->id) }}" method="POST" onsubmit="return confirm('Are you Sure???')">
                            @csrf
                            @method('DELETE')
                            <a href="{{route('sub-category.edit',$subCategory->slug)}}" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa fa-trash-alt"></i></button type="submit">
                        </form>
                    </td>
                </tr>
            @endif
        @endforeach
    </tbody>
  </table>
</div>
@stop
