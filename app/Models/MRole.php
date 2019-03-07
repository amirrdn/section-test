<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MRole extends Model
{
    protected $table    = 'roles';
    protected $fillable = ['id','name', 'guard_name'];
}
