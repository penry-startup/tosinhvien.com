<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class UniversityFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $cities_ids      = \DB::table('cities')->pluck('id')->toArray();
        $university_type = config('constants.university_type.label');

        return [
            'name'       => $this->faker->name(),
            'code'       => strtoupper(\Str::random(2)),
            'city_id'    => $cities_ids[array_rand($cities_ids)],
            'type'       => $university_type[array_rand($university_type)],
            'address'    => $this->faker->address(),
            'phone'      => $this->faker->phoneNumber(),
            'website'    => $this->faker->url(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
