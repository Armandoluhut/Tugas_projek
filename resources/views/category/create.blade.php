@extends('home')

@section('content')

<h1 class="h3 mb-2 text-gray-800">Product Categories</h1>

<div class="card shadow">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      <a href="/categories" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i></a> 
    </h6>
  </div>
  <div class="card-body">
    <form action="/categories/create" method="POST">
      @csrf
      <div class="form-group">
        <label>Category <span class="text-danger">*</span></label>
        <input type="text" class="form-control" required name="category" id="category" autocomplete="off">
      </div>
      <div class="form-group">
        <label>Description</label>
        <textarea name="description" id="description" class="form-control"></textarea>
      </div>
      <div class="text-right">
        <button class="btn btn-primary btn-sm">Create</button>
      </div>
    </form>
  </div>
</div>
@endsection