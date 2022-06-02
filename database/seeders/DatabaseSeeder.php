<?php

namespace Database\Seeders;

use App\Enum\UserRole;
use App\Models\{Day, DayRow};
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StazioSeeder::class);
        $this->call(AgencySeeder::class);


        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'role' => UserRole::SUPERADMIN->value
        ]);

        //10 days of tabella
        Day::factory(10)->create([
            'user_id'      => \App\Models\User::get()->first()->id,
            'stazio_id'    => \App\Models\Stazio::inRandomOrder()->get()->first()->id,
            'type'         => \App\Enum\DayType::TABELLA->value
        ]);
        //10 days of cavana
        Day::factory(10)->create([
            'user_id'      => \App\Models\User::get()->first()->id,
            'stazio_id'    => \App\Models\Stazio::inRandomOrder()->get()->first()->id,
            'type'         => \App\Enum\DayType::CAVANA->value
        ]);

        //10 days of nolo
        Day::factory(10)->create([
            'user_id'      => \App\Models\User::get()->first()->id,
            'stazio_id'    => \App\Models\Stazio::inRandomOrder()->get()->first()->id
        ]);

        //every day of work in tabella has 10 rows
        foreach(\App\Models\Day::where('type',\App\Enum\DayType::TABELLA->value)->get() as $day) {
            DayRow::factory(10)->create([
                'day_id'    => $day->id
            ]);
        }
    }
}
