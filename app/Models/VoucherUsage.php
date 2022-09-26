<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VoucherUsage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function voucher()
    {
        return $this->belongsTo(Vouchers::class, 'vouchers_id');
    }

    public function transaction()
    {
        return $this->belongsTo(transaction::class, 'transactions_id');
    }
}
