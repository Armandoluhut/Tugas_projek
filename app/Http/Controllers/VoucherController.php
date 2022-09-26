<?php

namespace App\Http\Controllers;

use App\Models\Vouchers;
use Illuminate\Http\Request;

class VoucherController extends Controller
{
    public function voucher()
    {
        return view('voucher.voucher', [
            'vouchers' => Vouchers::all()
        ]);
    }

    public function create()
    {
        return view('voucher.create');
    }

    public function voucherCreate(Request $request)
    {

        $rules = $request->validate([
            'code' => 'required',
            'type' => 'required',
            'disc_value' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($request->has('status')) {
            $rules['status'] = $request->status;
        }

        Vouchers::create($rules);
        return redirect('voucher')->with('success', 'Voucher berhasil ditambahkan');
    }

    public function showEdit(Vouchers $vouchers)
    {
        return view('voucher.edit', ['voucher' => $vouchers]);
    }

    public function voucherEdit(Request $request, Vouchers $vouchers)
    {
        $rules = $request->validate([
            'code' => 'required',
            'type' => 'required',
            'disc_value' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($request->has('status')) {
            $rules['status'] = $request->status;
        }

        Vouchers::where('id', $vouchers->id)->update($rules);
        return redirect('/voucher')->with('success', 'Voucher berhasil diedit');
    }

    public function voucherDelete(Vouchers $vouchers)
    {
        Vouchers::destroy($vouchers->id);
        return redirect('voucher');
    }

    public function useVoucher()
    {
        $voc = Vouchers::find(request('id'));

        return $voc->disc_value;
    }
}
