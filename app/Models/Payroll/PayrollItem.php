<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class PayrollItem extends Model
{
    protected $table = 'payroll_items';
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(PayrollItemType::class, 'type_id');
    }
}
