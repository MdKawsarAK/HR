<?php

namespace App\Models\HR\Payroll;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payroll\PayrollItemType;

class PayrollItem extends Model
{
    protected $table = 'payroll_items';
    public $timestamps = false;

    public function type()
    {
        return $this->belongsTo(PayrollItemType::class, 'type_id');
    }
}
