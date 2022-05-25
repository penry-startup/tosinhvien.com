<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MajorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $subject_groups = [
            'A00; A01; C00; D01',
            'A00; D07',
            'C00; C19; D14; D15',
            'A00; A01; B00; D01',
            'R08',
            'A00; C00; C15; D01',
            'A00; B00; C00; D01',
            'C00',
            'A00; A01; C01; D01',
            'A00; B00; D07',
            'A00; A01; D01; D03; D09',
            'B00',
            'D06',
            'V03; V04',
            'A09; C00; C20; D15'
        ];
        $universities = \DB::table('universities')->pluck('id')->toArray();

        return [
            'code'          => \Str::random(2),
            'name'          => $this->faker->name(),
            'subject_group' => $subject_groups[array_rand($subject_groups)],
            'thpt_score'    => $this->faker->randomFloat(2, 10, 25),
            'hocba_score'   => $this->faker->randomFloat(0, 10, 30),
            'dgnl_score'    => $this->faker->randomFloat(0, 100, 600),
            'university_id' => $universities[array_rand($universities)],
            'created_at'    => Carbon::now(),
            'updated_at'    => Carbon::now(),
        ];
    }
}
