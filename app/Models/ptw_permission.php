<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ptw_permission extends Model
{
    protected $fillable = [
        'ptw_id',
        'permission_id'
    ];
}
