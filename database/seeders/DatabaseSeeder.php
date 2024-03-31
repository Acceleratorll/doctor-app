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
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            TeethSeeder::class,
            SymbolSeeder::class,
            ScheduleTypeSeeder::class,
            EmployeeSeeder::class,
            PlaceSeeder::class,
            PatientSeeder::class,
            AnnouncementSeeder::class,
            ScheduleSeeder::class,
            ICDSeeder::class,
        ]);
    }
}
