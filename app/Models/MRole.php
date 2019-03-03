<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MRole extends Model
{
    protected $table    = 'role';
    protected $fillable = ['role_name', 'role_status'];
}
