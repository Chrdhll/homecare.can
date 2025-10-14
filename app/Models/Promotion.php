<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'discount_type',
        'discount_value',
        'service_id',
        'start_date',
        'end_date',
        'is_active',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
