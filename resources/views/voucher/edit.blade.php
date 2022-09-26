@extends('home')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Vouchers</h1>

<div class="card shadow">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">
      <a href="/voucher" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i></a> 
    </h6>
  </div>
  <div class="card-body">
    <form action="/voucher/edit/{{ $voucher->id }}" method="POST" class="row">
    @csrf
      <div class="form-group col-md-12">
        <label>Code <span class="text-danger">*</span></label>
        <input type="text" class="form-control" required name="code"  id="code" autocomplete="off" value="{{ $voucher->code }}">
      </div>
      <div class="form-group col-md-6">
        <label>Type <span class="text-danger">*</span></label>
        <select name="type" id="type" class="form-control">
          <option>--- Select Type ---</option>
          <option value="{{ $voucher->type }}" @if($voucher->type == 1)selected @endif>Flat Discount</option>
          <option value="{{ $voucher->type }}" @if($voucher->type == 2)selected @endif>Percent Discount</option>
        </select>
      </div>
      <div class="form-group col-md-6">
        <label>Discount Value <span class="text-danger">*</span></label>
        <input type="number" class="form-control" required name="disc_value" id="disc_value" autocomplete="off"  value="{{ $voucher->disc_value }}">
      </div>
      <div class="form-group col-md-6">
        <label>Start Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control" required name="start_date" id="start_date" value="{{ $voucher->start_date }}">
      </div>
      <div class="form-group col-md-6">
        <label>End Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control" required name="end_date" name="end_date" value="{{ $voucher->end_date }}">
      </div>
      <div class="col-12 text-right">
        <button class="btn btn-primary btn-sm">Edit</button>
      </div>
    </form>
  </div>
</div>
@endsection