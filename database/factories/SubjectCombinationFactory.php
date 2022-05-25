<?php

namespace Database\Factories;

use App\Models\SubjectCombinationGroup;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectCombinationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $group_ids = SubjectCombinationGroup::pluck('id')->toArray();

        return [
            'name'       => $this->faker->name,
            'group_id'   => $group_ids[array_rand($group_ids)],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
