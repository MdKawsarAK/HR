<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class PayrollInvoiceDetail extends Model
{
    protected $table = 'payroll_invoice_details';

    public $timestamps = false;

    protected $fillable = [
        'invoice_id',
        'item_id',
        'amount'
    ];

    public function invoice()
    {
        return $this->belongsTo(PayrollInvoice::class, 'invoice_id');
    }

    public function item()
    {
        return $this->belongsTo(PayrollItem::class, 'item_id');
    }
}
