<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerData extends Model
{
    use HasFactory;
    protected $table = 'customer_data';
    protected $primaryKey = 'id_customer';
    protected $fillable = [
    'full_name',
    'email',
    'phone_number',
    'address',];
    protected $dates = ['created_at', 'update_at'];
}
