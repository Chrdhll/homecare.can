<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'service_id',
        'promotion_id',
        'service_schedule',
        'address',
        'base_price',
        'discount_amount',
        'transport_cost',
        'total_price',
        'payment_status',
        'payment_method',
        'status',
        'created_at',
        'updated_at',
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi: Sebuah Order merujuk ke satu Service.
     */
    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    /**
     * Relasi: Sebuah Order bisa memiliki satu Promotion.
     */
    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }

    /**
     * Relasi: Sebuah Order bisa memiliki satu Review.
     */
    public function review()
    {
        return $this->hasOne(Review::class);
    }
}
