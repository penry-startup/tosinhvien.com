<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(CitySeeder::class);
        $this->call(SiteManagementSeeder::class);
        $this->call(SubjectSeeder::class);
        $this->call(SubjectCombinationGroupSeeder::class);
    }
}
