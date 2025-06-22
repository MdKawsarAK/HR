<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = ['person_id', 'att_datetime', 'attendance_method_id'];
}