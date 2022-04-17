<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('subjects')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $subjects = json_decode(file_get_contents(app_path('../database/json/subjects.json')), true);
        foreach ($subjects as $value) {
            \DB::table('subjects')->insert([
                'name'       => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
