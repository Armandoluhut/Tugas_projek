@extends('home')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Product Categories</h1>

<div class="card shadow">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Categories List</h6>
    <a href="/categories/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr class="text-center">
          <th width="100">#</th>
          <th>Category</th>
          <th>Descripsi</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @if (count($categories) > 0)
          @foreach ($categories as $category)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td class="text-center">{{ $category->category }}</td>
              <td class="text-center">{{ $category->description}}</td>
              <td width="100">
                <a href="/categories/edit/{{ $category->id }}" class="btn btn-warning btn-sm btn-icon"><i class="fas fa-pen"></i></a>
                <a href="/categories/delete/{{ $category->id }}" onclick="return confirm('Are you sure want to delete this category?')" class="btn btn-danger btn-sm btn-icon"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
          @endforeach
          @else
          <tr>
            <td colspan="3" class="text-center">No data found</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>

@endsection