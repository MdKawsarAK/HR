<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class PayrollBillDetails extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'bill_id',
        'item_id',
        'amount'
    ];
}
