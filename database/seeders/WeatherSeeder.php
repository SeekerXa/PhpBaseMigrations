<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('weathers')->insert([
            'city_id' => 2,
            'temperature' => 11,
            'pressure' => 995,5,
            'precipitation' => 1,5,
            'wind_speed' => 30
        ]);

        DB::table('weathers')->insert([
            'city_id' => 3,
            'temperature' => -1,
            'pressure' => 995,5,
            'precipitation' => 0,
            'wind_speed' => 10
        ]);
    }
}


