@extends('home')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Transaction</h1>

<div class="card shadow">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Transaction List</h6>
    <a href="/transaction/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr class="text-center">
          <th width="100">#</th>
          <th>Date</th>
          <th>Customer Name</th>
          <th>Customer Email</th>
          <th>Customer Phone</th>
          <th>Total</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @if (count($modul) > 0)
            @foreach ($modul as $item)
                <tr>
                    <td class="text-center">{{ $item->transaction_id }}</td>
                    <td class="text-center">{{ date('d-m-Y H:i:s', strtotime($item->created_at)) }}</td>
                    <td class="text-center">{{ $item->customer_name }}</td>
                    <td class="text-center">{{ $item->customer_email }}</td>
                    <td class="text-center">{{ $item->customer_phone }}</td>
                    <td class="text-center">Rp. {{ number_format($item->total) }}</td>
                    <td class="text-center">
                        <a href="/transaction/edit/{{ $item->id }}" class="btn btn-warning btn-sm btn-icon"><i class="fas fa-pen"></i></a>
                        <a href="/transaction/delete/{{ $item->id }}" onclick="return confirm('Are you sure want to delete this voucher ?')" class="btn btn-danger btn-sm btn-icon"><i class="fas fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
          <tr>
            <td colspan="7" class="text-center">No data found</td>
          </tr>
        @endif
      </tbody>
    </table>
  </div>
</div>
@endsection
