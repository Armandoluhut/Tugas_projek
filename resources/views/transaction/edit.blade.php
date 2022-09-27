@extends('home')
@section('content')
<form action="/transaction/edit/{{ $transactions->id }}" method="POST">
    @csrf
    <h1 class="h3 mb-2 text-gray-800">Transaction</h1>

    <div class="card shadow">
    <div class="card-header py-3">
        <input type="hidden" id="total_diskon" value="0">
        <h6 class="m-0 font-weight-bold text-primary">
        <a href="/transaction" class="btn btn-secondary btn-sm"><i class="fas fa-chevron-left"></i></a>
        </h6>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-3">
            <label>Produk <span class="text-danger">*</span></label>
            <select name="produk" id="produk" class="form-control" value>
                <option value="">--Pilih Produk--</option>
                @foreach ($produk as $item)
                    <option {{ $item->id == $transactionDetail->products_id ? 'Selected' : ''  }} value="{{$item->id}}">{{$item->name}}</option>
                @endforeach
            </select>
            </div>
            <div class="form-group col-md-3">
            <label>Quantity <span class="text-danger">*</span></label>
            <input type="number" class="form-control" required name="qty" id="qty" value="{{$transactionDetail->qty }}" onkeyup="hitung()">

            </div>
            <div class="form-group col-md-3">
                <label>Price</label>
                <input type="text" class="form-control" readonly name="price_satuan" id="price_satuan" value="{{ $transactionDetail->price_satuan }}">
            </div>
    </div>
    </div>


    <br>

    <h1 class="h3 mb-2 text-gray-800">Payment</h1>

    <div class="card shadow">
    <div class="card-body">
        <div class="row">
            <div class="form-group col-md-6">
                <label>Customer Name <span class="text-danger">*</span></label>
                <input type="text" name="customer_name" class="form-control" required value="{{ $transactions->customer_name }}">
            </div>
            <div class="form-group col-md-6">
                <label>Customer Email <span class="text-danger">*</span></label>
                <input type="email" name="customer_email" class="form-control" required value="{{ $transactions->customer_email }}">
            </div>
            <div class="form-group col-md-3">
                <label>Customer Phone</label>
                <input type="text" name="customer_phone" class="form-control" required value="{{ $transactions->customer_phone }}">
            </div>
            <div class="form-group col-md-3">
                <label>Sub Total <span class="text-danger">*</span></label>
                <input type="number" name="sub_total" class="form-control" required value="{{ $transactions->sub_total }}"> 
            </div>
            <div class="form-group col-md-3">
                <label>Total <span class="text-danger">*</span></label>
                <input type="number" name="total" class="form-control" required value="{{ $transactions->total }}">
            </div>
            <div class="form-group col-md-3">
                <label>Total Purchase <span class="text-danger">*</span></label>
                <input type="number" name="total_purchase" class="form-control" required value="{{ $transactions->total_purchase }}">
            </div>
            <div class="form-group col-md-6">
                <label>Additional Request</label>
                <textarea name="additional_request" class="form-control" required >{{ $transactions->additional_request }}</textarea>
            </div>
            <div class="form-group col-md-3">
                <label>Payment Method <span class="text-danger">*</span></label>
                <input type="text" name="payment_method" class="form-control" required value="{{ $transactions->payment_method }}">
            </div>
            <div class="form-group col-md-3">
                <label>Vocher</label>
                <select name="voucher" id="voucher" class="form-control">
                    <option value="none">None</option>
                    @foreach ($voucher as $item)
                    <option {{ $item->id == $voucherUsage->voucher_id ? 'Selected' : ''  }} value="{{$item->id}}">{{$item->code}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group col-md-3">
                <label>Total Price</label>
                <input type="text" class="form-control" readonly name="total_price" id="total_price" value="{{ $transactions->total_price }}">
            </div>
            <div class="form-group col-md-9"></div>
            <button type="submit" class="btn btn-primary ml-3">Submit</button>

        </div>
    </div>
    </div>
</form>

<script>
    $('#produk').on('change', function(){
        var value = $('#produk').val();
        $.ajax({
            type: 'post',
            url: 'product_price',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": value,
            },
            success : function(data){
                $('#qty').val("");
                $('#total_price').val(0);
                $('#price_satuan').val(data);
            }
        });
    });

    function hitung() {
        var quantity = parseInt($('#qty').val());
        var price = parseInt($('#price_satuan').val());
        var disc = parseInt($('#total_diskon').val());

        var total = quantity * price - disc;

        $('#total_price').val(total);
    }

    $('#voucher').on('change', function() {
        var value = this.value;
        $.ajax({
            type: 'post',
            url: 'voucher_use',
            data: {
                "_token": "{{ csrf_token() }}",
                "id": value,
            },
            success : function(data){
                $('#total_diskon').val(data);
                var disc = parseInt(data);
                var quantity = parseInt($('#qty').val());
                var price = parseInt($('#price_satuan').val());
                var total = quantity * price;

                if (!isNaN(disc)) {
                    total = quantity * price - disc;
                }
                $('#total_price').val(total);
            }
        });
    });
</script>


@endsection
