<?php

namespace Database\Factories;

use Carbon\Carbon;
use Google\Service\HangoutsChat\Card;
use Illuminate\Database\Eloquent\Factories\Factory;
use ListHelper;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sex_keys       = config('constants.sex.key');
        $is_active_keys = config('constants.is_active.key');
        $is_draft_keys  = config('constants.is_draft.key');

        return [
            'name'       => \Str::random(10),
            'avatar'     => ListHelper::randomAvatar(),
            'username'   => $this->faker->unique()->userName(),
            'sex'        => $sex_keys[array_rand($sex_keys)],
            'email'      => $this->faker->unique()->email(),
            'phone'      => $this->faker->unique()->phoneNumber(),
            'dob'        => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('Y'),
            'mob'        => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('m'),
            'yob'        => $this->faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('d'),
            'password'   => \Hash::make('@Hung12345678'),
            'is_active'  => $is_active_keys[array_rand($is_active_keys)],
            'is_draft'   => $is_draft_keys[array_rand($is_draft_keys)],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
