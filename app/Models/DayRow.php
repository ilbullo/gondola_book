<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DayRow extends Model
{
    use HasFactory;

    protected $fillable = [
        'day_id',
        'type',
        'agency_id',
        'amount',
        'payment_date',
        'payment_type',
        'note'
    ];

    protected $table = "dayrows";

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    protected $casts = [
        'type'              => \App\Enum\WorkType::class,
        'payment_type'      => \App\Enum\PaymentType::class
    ];
}
