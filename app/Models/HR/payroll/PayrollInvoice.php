<?php

namespace App\Models\HR\payroll;

use Illuminate\Database\Eloquent\Model;

class PayrollInvoice extends Model
{
    // protected $table = 'payroll_invoices';
    public $timestamps = false;

    protected $fillable = ['employee_id', 'created_at', 'billed_at', 'invoice_total'];

    public function details()
    {
        return $this->hasMany(PayrollInvoiceDetail::class, 'invoice_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class); // create Employee model if needed
    }
}
