<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ICDSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = file_get_contents('master_icd_x.json');
        $data = json_decode($json, true);

        foreach ($data as $item) {
            DB::table('icds')->insert([
                'code' => $item['kode_icd'],
                'name_en' => $item['nama_icd'],
                'name_id' => $item['nama_icd_indo'],
            ]);
        }
    }
}
