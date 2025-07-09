<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payrollitem extends Model
{
    
    public $timestamps = false;
    protected $fillable = ['name', 'type_id'];
}