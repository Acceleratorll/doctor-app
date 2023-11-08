<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $announcements = [
            [
                'employee_id' => 1,
                'title' => 'Doctor-App released',
                'content' => 'Doctor-App has been Released in 2023',
                'image' => '/announcement/Default.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'employee_id' => 1,
                'title' => 'Doctor-App Maintenance',
                'content' => 'Doctor-App will be Maintenance at WIB 20:23',
                'image' => '/announcement/Default.png',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
        ];
        DB::table('announcements')->insert($announcements);
    }
}
