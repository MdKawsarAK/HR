<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PayrollInvoice extends Model
{
    protected $fillable = ['employee_id', 'created_at', 'billed_at', 'invoice_total'];
}