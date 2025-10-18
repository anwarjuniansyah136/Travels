<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles extends Model
{
    use HasFactory;
    protected $table = 'roles';
    protected $fillable = ['name', 'status'];
    protected $dates = ['created_at', 'update_at'];
}
