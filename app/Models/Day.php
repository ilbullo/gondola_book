<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Day extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'stazio_id',
        'date',
        'percent',
        'type',
    ];

    protected $casts = [
        'type'              => \App\Enum\DayType::class
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Show all related rows
     */

    public function rows() {
        return $this->hasMany('dayrows','day_id');
    }
}
