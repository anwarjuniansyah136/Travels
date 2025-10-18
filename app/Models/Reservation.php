<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Reservation extends Model
{
    use HasFactory;

    protected $table = 'reservation';

    protected $fillable = [
        'user_id',
        'nama_lengkap',
        'email',
        'nomor_telepon',
        'alamat',
        'tujuan',
        'schedule_id',
        'number_of_seats',
        'reservation_code',
        'reservation_date',
        'reservation_duration',
        'payment_date',
        'payment',
        'set_payment_method',
        'payment_status'
    ];

    protected $dates = ['created_at', 'updated_at', 'reservation_date', 'payment_date'];

    // Relasi ke tabel users
    public function user()
    {
        return $this->belongsTo(\App\Models\Admin\user::class, 'user_id');
    }

    // Bisa generate kode unik otomatis
    public static function boot()
    {
        parent::boot();

        static::creating(function ($reservation) {
            if (empty($reservation->reservation_code)) {
                $reservation->reservation_code = strtoupper(Str::random(8));
            }
        });
    }
}
