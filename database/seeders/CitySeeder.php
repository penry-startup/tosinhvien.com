<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('cities')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $cities = json_decode(file_get_contents(app_path('../database/json/cities.json')), true);
        foreach ($cities as $key => $value) {
            \DB::table('cities')->insert([
                'code'       => $key,
                'name'       => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
