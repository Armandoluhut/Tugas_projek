@extends('home')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Products</h1>

<div class="card shadow">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Products List</h6>
    <a href="/product/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
  </div>

  <div class="card-body">
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr class="text-center">
          <th width="100">#</th>
          <th>Name</th>
          <th>Code</th>
          <th>Category</th>
          <th>Price</th>
          <th>Purchase</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @if (count($products) > 0)
          @foreach ($products as $product)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td class="text-center">{{ $product->name }}</td>
              <td class="text-center">{{ $product->code }}</td>
              <td class="text-center">{{ $product->category->category }}</td>
              <td class="text-center">{{ number_format($product->price) }}</td>
              <td class="text-center">{{ number_format($product->purchase_price) }}</td>
              <td class="text-center">{!! ($product->status) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-danger">Non Active</span>' !!}</td>
              <td width="100">
                <a href="/product/edit/{{ $product->id }}" class="btn btn-warning btn-sm btn-icon"><i class="fas fa-pen"></i></a>
                <a href="/product/delete/{{ $product->id }}" onclick="return confirm('Are you sure want to delete this product?')" class="btn btn-danger btn-sm btn-icon"><i class="fas fa-trash"></i></a>
              </td>
            </tr>
          @endforeach
        @else
          <tr>
            <td colspan="8" class="text-center">No data found</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection