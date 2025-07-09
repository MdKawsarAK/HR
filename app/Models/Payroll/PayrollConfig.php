<?php

namespace App\Models\HR\payroll;

use Illuminate\Database\Eloquent\Model;

class PayrollConfig extends Model
{
    protected $table = 'payroll_configs';
    public $timestamps = false;

    public function item()
    {
        return $this->belongsTo(PayrollItem::class, 'payroll_item_id');
    }
}
