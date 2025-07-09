<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class PayrollInvoice extends Model
{
    protected $table = 'payroll_invoices';

    public $timestamps = false;

    protected $fillable = [
        'employee_id',
        'created_at',
        'billed_at',
        'invoice_total'
    ];

    public function employee()
    {
        return $this->belongsTo(\App\Models\Employee::class, 'employee_id');
    }

    public function details()
    {
        return $this->hasMany(PayrollInvoiceDetail::class, 'invoice_id');
    }
}
