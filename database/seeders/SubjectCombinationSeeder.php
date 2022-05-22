<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubjectCombinationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        \DB::table('subject_combinations')->truncate();
        \DB::table('group_subject')->truncate();
        \DB::table('major_subject_combination')->truncate();
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $subject_groups = json_decode(file_get_contents(app_path('../database/json/subject_combinations.json')), true);

        $group_names = [];
        foreach ($subject_groups as $name => $subjects) {
            $group_name  = 'Khối ' . ucfirst(mb_substr($name, 0, 1));
            if (empty($group_names[$group_name])) {
                $group_names[$group_name] = 1;
            }
        }

        $subjC_grps_db = \DB::table('subject_combination_groups')->whereIn('name', array_keys($group_names))->pluck('id', 'name')->toArray();

        $subject_unique = [];
        foreach ($subject_groups as $group => $subjects) {
            foreach ($subjects as $subject) {
                if (empty($subject_unique[$subject])) {
                    $subject_unique[$subject] = 1;
                }
            }
        }
        $subjects_db = \DB::table('subjects')->whereIn('name', array_keys($subject_unique))->pluck('id', 'name')->toArray();

        $date_now = Carbon::now();
        $i = 1;
        foreach ($subject_groups as $name => $subjects) {
            $group_name  = 'Khối ' . ucfirst(mb_substr($name, 0, 1));
            \DB::table('subject_combinations')->insert([
                'id'         => $i,
                'name'       => $name,
                'group_id'   => $subjC_grps_db[$group_name],
                'created_at' => $date_now,
                'updated_at' => $date_now
            ]);

            foreach ($subjects as $subject) {
                \DB::table('group_subject')->insert([
                    'group_id'   => $i,
                    'subject_id' => $subjects_db[$subject],
                    'created_at' => $date_now,
                    'updated_at' => $date_now
                ]);
            }

            $i++;
        }

        // Insert Pivot table major_subject_combination
        $majors_db = \DB::table('majors')->pluck('subject_group', 'id')->toArray();

        foreach ($majors_db as $id => $subject_group) {
            // if ($id == 1280) {
            //     $subject_group_arr = explode('; ', $subject_group);
            //     // dd($subject_group_arr);
            //     $subjects_cb_db = \DB::table('subject_combinations')->whereIn('name', $subject_group_arr)->pluck('id', 'name')->toArray();
            // }
            $subject_group_arr = explode('; ', $subject_group);
            $subjects_cb_db = \DB::table('subject_combinations')->whereIn('name', $subject_group_arr)->pluck('id', 'name')->toArray();

            foreach ($subjects_cb_db as $subject_cb_db) {
                \DB::table('major_subject_combination')->insert([
                    'major_id'               => $id,
                    'subject_combination_id' => $subject_cb_db,
                    'created_at'             => $date_now,
                    'updated_at'             => $date_now
                ]);
            }
        }
    }
}
