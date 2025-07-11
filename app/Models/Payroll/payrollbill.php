<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class Payrollbill extends Model
{
    protected $table = 'payroll_bills_details';

    public $timestamps = false;

    protected $fillable = [

        'employee_id',
        'created_at',
        'billed_at',
        'bill_total',
        'status',
        'remarks'
    ];
}
