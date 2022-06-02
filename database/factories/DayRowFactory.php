<?php

namespace Database\Factories;

use App\Enum\PaymentType;
use App\Enum\WorkType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DayRow>
 */
class DayRowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'day_id'        => function() {
                return \App\Models\Day::factory()->create();
            },
            'type'          => WorkType::NOLO->value,
            'agency_id'     => function() {
                return \App\Models\Agency::factory()->create();
            },
            'amount'        => 80,
            'payment_date'  => today(),
            'payment_type'  => PaymentType::CASH->value,
            'note'          => ''
        ];
    }
}
