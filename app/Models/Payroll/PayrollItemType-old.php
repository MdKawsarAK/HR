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
    public function type()
{
    return $this->belongsTo(PayrollItemType::class, 'type_id');
}

}
