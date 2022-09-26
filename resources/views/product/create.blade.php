@extends('home')

@section('content')

<h1 class="h3 mb-2 text-gray-800">Product</h1>

<div class="card shadow">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      <a href="/product" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i></a> 
    </h6>
  </div>
  <div class="card-body">
    <form action="/product/create" method="POST" class="row">
    @csrf
      <div class="form-group col-md-6">
        <label>Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="name"  id="name" required autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label>Code <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="code"  id="code" required autocomplete="off">
      </div>
      <div class="form-group col-md-6">
        <label>Category <span class="text-danger">*</span></label>
        <select name="product_categories_id" id="product_categories_id" class="form-control">
          <option>--- Select Category ---</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->category }}</option>
          @endforeach
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>Status</label>
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="status" id="status">
          <label class="form-check-label" for="status">
            Aktif
          </label>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label>Price <span class="text-danger">*</span></label>
        <input type="number" class="form-control" required autocomplete="off" name="price" id="price">
      </div>
      <div class="form-group col-md-6">
        <label>Purchase Price <span class="text-danger">*</span></label>
        <input type="number" class="form-control" required autocomplete="off" name="purchase_price" id="purchase_price">
      </div>
      <div class="form-group text-center col-md-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="new_product" id="new_product" >
          <label class="form-check-label" for="new_product">
            New Product
          </label>
        </div>
      </div>
      <div class="form-group text-center col-md-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="best_seller" id="best_seller" >
          <label class="form-check-label" for="best_seller">
            Best Seller
          </label>
        </div>
      </div>
      <div class="form-group text-center col-md-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" value="1" name="featured" id="featured">
          <label class="form-check-label" for="featured">
            Featured
          </label>
        </div>
      </div>
      <div class="form-group col-md-6">
        <label>Short Description</label>
        <textarea name="short_description"  id="short_description" class="form-control" rows="8"></textarea>
      </div>
      <div class="form-group col-md-6">
        <label>Description</label>
        <textarea name="description" id="description" class="form-control" rows="8"></textarea>
      </div>
      <div class="col-12 text-right">
        <button class="btn btn-primary">Create</button>
      </div>
    </form>
  </div>
</div>
@endsection