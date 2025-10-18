<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusType extends Model
{
    use HasFactory;
    protected $table = 'bus_type';
    protected $fillable = [
        'type',
        'price',
        'facility',
        'seat_capacity',
        'image',
    ];
    protected $dates = ['created_at', 'update_at'];

    /**
     * Get the schedules for this bus type
     */
    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'bus_type_id', 'id');
    }
}
