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

        $subject_unique = [];
        $subject_groups = json_decode(file_get_contents(app_path('../database/json/subject_combinations.json')), true);
        foreach ($subject_groups as $group => $subjects) {
            foreach ($subjects as $subject) {
                if (empty($subject_unique[$subject])) {
                    $subject_unique[$subject] = 1;
                }
            }
        }
        $subject_unique = array_keys($subject_unique);

        foreach ($subject_unique as $value) {
            \DB::table('subjects')->insert([
                'name'       => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]);
        }
    }
}
