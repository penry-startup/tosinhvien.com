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
        \DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $group_a = \DB::table('subject_combination_groups')->where('name', 'Khối A')->first();

        $subject_combinations = [
            'A00' => [1, 2, 3],
            'A01' => [1, 2, 67],
            'A02' => [1, 2, 5],
            'A03' => [1, 2, 6],
            'A04' => [1, 2, 7],
            'A05' => [1, 3, 6],
            'A06' => [1, 3, 7],
            'A07' => [1, 6, 7],
            'A08' => [1, 6, 8],
            'A09' => [1, 9, 8],
            'A10' => [1, 16, 8],
            'A11' => [1, 11, 8],
            'A12' => [1, 12, 13],
            'A14' => [1, 12, 7],
            'A15' => [1, 12, 8],
            'A16' => [1, 12, 15],
            'A17' => [1, 16, 13],
            'A18' => [1, 3, 13],
        ];

        $now = Carbon::now();
        foreach ($subject_combinations as $key => $item) {
            \DB::table('subject_combinations')->insert([
                'name'       => $key,
                'group_id'   => $group_a->id,
                'created_at' => $now,
                'updated_at' => $now,
            ]);
        }

        $subject_combinations_db = \DB::table('subject_combinations')->whereIn('name', array_keys($subject_combinations))->pluck('id', 'name')->toArray();

        foreach ($subject_combinations as $key => $subjects) {
            foreach ($subjects as $subject) {
                \DB::table('group_subject')->insert([
                    'group_id'   => $subject_combinations_db[$key],
                    'subject_id' => $subject,
                    'created_at' => $now,
                    'updated_at' => $now
                ]);
            }
        }
    }
}
