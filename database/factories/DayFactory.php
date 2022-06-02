<?php

namespace Database\Factories;

use App\Enum\DayType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Day>
 */
class DayFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id'   => function() {
                return \App\Models\User::factory()->create();
            },
            'stazio_id' => function() {
                return \App\Models\Stazio::factory()->create();
            },
            'date'      => today(),
            'percent'   => 60,
            'type'      => DayType::NOLO
        ];
    }
}

