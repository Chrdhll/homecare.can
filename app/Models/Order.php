<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Str;


class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_name',
        'patient_email',
        'patient_phone',


        'uuid',
        'user_id',
        'service_id',
        'promotion_id',
        'service_schedule',
        'address',
        'notes',

        'base_price',
        'discount_amount',
        'transport_cost',
        'total_price',

        'latitude',
        'longitude',
        'distance',

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

    public function getRouteKeyName()
    {
        return 'uuid';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = (string) Str::uuid();
            }
        });
    }
}
