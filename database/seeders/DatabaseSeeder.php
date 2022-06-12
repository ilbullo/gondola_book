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

        //all agencies from previou
        $agencies = array(
            array('Id' => '0','Nome' => 'DESTINATION'),
            array('Id' => '1','Nome' => 'AMEDIDA'),
            array('Id' => '2','Nome' => 'TURIVE'),
            array('Id' => '3','Nome' => 'ALBATRAVEL'),
            array('Id' => '4','Nome' => 'OLTREX 4M'),
            array('Id' => '5','Nome' => 'GONDOLIERI TRAVEL'),
            array('Id' => '6','Nome' => 'JTB'),
            array('Id' => '7','Nome' => 'ITALIAN ESCAPADE'),
            array('Id' => '8','Nome' => 'VENICE ITALY TRAVEL'),
            array('Id' => '9','Nome' => 'TRUMPY TOURS'),
            array('Id' => '10','Nome' => 'CONTIKI'),
            array('Id' => '11','Nome' => '--'),
            array('Id' => '12','Nome' => 'DOGE'),
            array('Id' => '13','Nome' => 'ESCAPADE'),
            array('Id' => '14','Nome' => 'AMS'),
            array('Id' => '15','Nome' => 'BUCINTORO'),
            array('Id' => '16','Nome' => 'TRAFALGAR'),
            array('Id' => '17','Nome' => 'TOMORROW TRAVEL'),
            array('Id' => '18','Nome' => 'GARTOUR'),
            array('Id' => '19','Nome' => 'GIALPI'),
            array('Id' => '20','Nome' => 'HOTUSA'),
            array('Id' => '21','Nome' => 'MDS'),
            array('Id' => '22','Nome' => 'VERY VIVA VENICE'),
            array('Id' => '23','Nome' => 'GLOBUS'),
            array('Id' => '24','Nome' => 'ACAMPORA'),
            array('Id' => '25','Nome' => 'BASSANI'),
            array('Id' => '26','Nome' => 'INSIDE.COM'),
            array('Id' => '27','Nome' => 'EUROPLAN'),
            array('Id' => '28','Nome' => 'GREAT TRAVEL'),
            array('Id' => '29','Nome' => 'CLEMENTSON'),
            array('Id' => '30','Nome' => 'SENSE OF ITALY'),
            array('Id' => '31','Nome' => 'LAR VIAGGI'),
            array('Id' => '32','Nome' => 'INSIGHT'),
            array('Id' => '33','Nome' => 'GIGA'),
            array('Id' => '34','Nome' => 'VENICE TOURS'),
            array('Id' => '35','Nome' => 'VAMOS'),
            array('Id' => '36','Nome' => 'FABEREST'),
            array('Id' => '37','Nome' => 'UNL'),
            array('Id' => '38','Nome' => 'INTERCRUISE'),
            array('Id' => '39','Nome' => 'ITC'),
            array('Id' => '40','Nome' => 'PARK VIAGGI'),
            array('Id' => '41','Nome' => 'TOPLINE'),
            array('Id' => '42','Nome' => 'MERY'),
            array('Id' => '43','Nome' => 'KNOW HOW'),
            array('Id' => '44','Nome' => 'PODIUM'),
            array('Id' => '45','Nome' => 'ALBATRAVEL ROMA'),
            array('Id' => '46','Nome' => 'MADOX'),
            array('Id' => '47','Nome' => 'EXPLORA'),
            array('Id' => '48','Nome' => 'VIATOR'),
            array('Id' => '49','Nome' => 'LUXURY TRAVEL'),
            array('Id' => '50','Nome' => 'BRAMANTE'),
            array('Id' => '51','Nome' => 'SERENATA'),
            array('Id' => '52','Nome' => 'VENICE EVENTS'),
            array('Id' => '53','Nome' => 'LIBERTY'),
            array('Id' => '54','Nome' => 'CITY WONDERS'),
            array('Id' => '55','Nome' => 'ANXUR'),
            array('Id' => '56','Nome' => 'PLANNING VENICE'),
            array('Id' => '57','Nome' => 'MONOGRAM'),
            array('Id' => '58','Nome' => 'MEDOW'),
            array('Id' => '59','Nome' => 'MY BUS'),
            array('Id' => '60','Nome' => 'DOLCE VITA'),
            array('Id' => '61','Nome' => 'CIAO FLORENCE'),
            array('Id' => '62','Nome' => 'EURO MOSE'),
            array('Id' => '63','Nome' => 'CAPITANIO'),
            array('Id' => '64','Nome' => 'DAVIDE'),
            array('Id' => '65','Nome' => 'SMART TRAVEL'),
            array('Id' => '66','Nome' => 'ENJOY VENICE'),
            array('Id' => '67','Nome' => 'ALLIAN TOURS'),
            array('Id' => '68','Nome' => 'SALVADORI TOURS'),
            array('Id' => '69','Nome' => 'EUROSAN'),
            array('Id' => '70','Nome' => 'SHOW ME VENICE'),
            array('Id' => '71','Nome' => 'ITALY TRAVEL')
          );

        foreach($agencies as $agency) {
            \App\Models\Agency::factory()->create(['name'   => $agency['Nome']]);
        }


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
