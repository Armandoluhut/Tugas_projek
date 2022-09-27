<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Transactions;
use App\Models\TransactionDetails;
use App\Models\Vouchers;
use App\Models\VoucherUsage;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function transaction()
    {
        $modul = Transactions::latest()->get();
        return view('transaction.transaction', [
            'modul' => $modul
        ]);
    }

    public function create()
    {
        $dateNow = date('Y-m-d');
        $produk = Products::latest()->get();
        $voucher = Vouchers::where('start_date', '>=', $dateNow)->where('status', '0')->latest()->get();
        $getVoucher = array();
        foreach ($voucher as $key => $voc) {
            $end_date = strtotime($voc->end_date);
            if (strtotime($dateNow) >= strtotime($voc->start_date)) {
                if (strtotime($dateNow) <= $end_date) {
                    $getVoucher[] = [
                        "id" => $voc->id,
                        "voc" => $voc->code . " - " . $voc->disc_value,
                    ];
                }
            }
        }
        return view('transaction.create', [
            'produk' => $produk,
            'voucher' => $getVoucher
        ]);
    }

    public function transactionCreate(Request $request)
    {
        $rules = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'sub_total' => 'required',
            'total' => 'required',
            'total_purchase' => 'required',
            'payment_method' => 'required',
        ]);

        if ($request->has('customer_phone')) {
            $rules['customer_phone'] = $request->customer_phone;
        }

        if ($request->has('additional_request')) {
            $rules['additional_request'] = $request->additional_request;
        }

        $rules['transaction_id'] = rand();
        $rules['status'] = 0;

        $prod = Transactions::create($rules);

        if ($prod) {
            $details['transactions_id'] = $prod->id;
            $details['products_id'] = $request->produk;
            $details['qty'] = $request->qty;
            $details['price_satuan'] = $request->price_satuan;
            $details['price_total'] = $request->total_price;
            $details['price_purchase_satuan'] = $request->price_satuan;
            $details['price_purchase_total'] = $request->total_price;
            TransactionDetails::create($details);

            if ($request->voucher != null && $request->voucher != "") {
                $voc['status'] = 1;
                $upVoucher = Vouchers::where('id', $request->voucher)->update($voc);

                $voc_usages['transactions_id'] = $prod->id;
                $voc_usages['vouchers_id'] = $request->voucher;
                $voc_usages['discounted_value'] = $request->voucher;
                VoucherUsage::create($voc_usages);
            }

            return redirect('transaction')->with('success', 'Data telah tersimpan');
        }
    }

    public function showEdit(Transactions $transactions, Vouchers $voucher)
    {
        $transactionDetail = TransactionDetails::where('id', $transactions->id)->first();
        $voucherUsage = VoucherUsage::where('id', $voucher->id)->first();
        return view('transaction.edit', [
            'transactions' => $transactions,
            'transactionDetail' => $transactionDetail,
            'produk' => Products::all(),
            'voucher' => Vouchers::all(),
            'voucherUsage' => $voucherUsage,

            dd($voucherUsage),
        ]);
    }

    public function transactionEdit(Request $request, Transactions $transactions, TransactionDetails $transactionDetails, VoucherUsage $voucherUsage)
    {
        $rules = $request->validate([
            'customer_name' => 'required',
            'customer_email' => 'required',
            'sub_total' => 'required',
            'total' => 'required',
            'total_purchase' => 'required',
            'payment_method' => 'required',
        ]);

        if ($request->has('customer_phone')) {
            $rules['customer_phone'] = $request->customer_phone;
        }

        if ($request->has('additional_request')) {
            $rules['additional_request'] = $request->additional_request;
        }

        $rules['transaction_id'] = rand();
        $rules['status'] = 0;

        $prod = Transactions::where('id', $transactions->id)->update($rules);

        if ($prod) {
            $details['transactions_id'] = $prod->id;
            $details['products_id'] = $request->produk;
            $details['qty'] = $request->qty;
            $details['price_satuan'] = $request->price_satuan;
            $details['price_total'] = $request->total_price;
            $details['price_purchase_satuan'] = $request->price_satuan;
            $details['price_purchase_total'] = $request->total_price;
            TransactionDetails::where('id', $transactionDetails->id)->update($details);

            if ($request->voucher != null && $request->voucher != "") {
                $voc['status'] = 1;
                $upVoucher = Vouchers::where('id', $request->voucher)->update($voc);

                $voc_usages['transactions_id'] = $prod->id;
                $voc_usages['vouchers_id'] = $request->voucher;
                $voc_usages['discounted_value'] = $request->voucher;
                VoucherUsage::where('id', $voucherUsage->id)->update($voc_usages);
            }

            return redirect('transaction')->with('success', 'Data telah diubah');
        }
    }

    public function transactionDelete(Transactions $transactions)
    {
        Transactions::destroy($transactions->id);
        return redirect('transaction');
    }
}
