<?php

namespace App\Models\Payroll;

use Illuminate\Database\Eloquent\Model;

class PayrollItemType extends Model
{
    protected $table = 'payroll_item_types';

    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    // No need for any relationship method here unless you want to see items under a type:
    public function items()
    {
        return $this->hasMany(\App\Models\HR\Payroll\PayrollItem::class, 'type_id');
    }
}
