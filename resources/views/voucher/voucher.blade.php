@extends('home')

@section('content')
<h1 class="h3 mb-2 text-gray-800">Vouchers</h1>

<div class="card shadow">
  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
    <h6 class="m-0 font-weight-bold text-primary">Vouchers List</h6>
    <a href="/voucher/create" class="btn btn-primary btn-sm"><i class="fas fa-plus"></i></a>
  </div>
  <div class="card-body">
    <table class="table table-bordered table-hover table-striped">
      <thead>
        <tr class="text-center">
          <th width="100">#</th>
          <th>Code</th>
          <th>Type</th>
          <th>Discount</th>
          <th>Period</th>
          <th>Status</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @if (count($vouchers) > 0)
          @foreach ($vouchers as $vouch)
            <tr>
              <td class="text-center">{{ $loop->iteration }}</td>
              <td class="text-center">{{ $vouch->code }}</td>
              <td class="text-center">{{ ($vouch->type == '1') ? 'Flat' : 'Percentage' }}</td>
              <td class="text-center">{{ number_format($vouch->disc_value) }}</td>
              <td class="text-center">
                {{ \Carbon\Carbon::parse($vouch->start_date)->format('d M Y') }}
                -
                {{ \Carbon\Carbon::parse($vouch->end_date)->format('d M Y') }}
              </td>
              <td class="text-center">@if($vouch->status == 0) <span class="badge badge-success">Active</span> @else <span class="badge badge-secondary">Claimed</span> @endif</td>
              <td class="text-center">
                <a href="/voucher/edit/{{ $vouch->id }}" class="btn btn-warning btn-sm btn-icon"><i class="fas fa-pen"></i></a>
                <a href="/voucher/delete/{{ $vouch->id }}" onclick="return confirm('Are you sure want to delete this voucher ?')" class="btn btn-danger btn-sm btn-icon"><i class="fas fa-trash"></i></a>
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