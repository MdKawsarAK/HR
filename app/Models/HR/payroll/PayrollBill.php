<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollBill extends Model
{
        protected $table = 'payroll_invoice_details';

    public $timestamps = false;

    protected $fillable = [
        'invoice_id',
        'item_id',
        'amount'
    ];
}
