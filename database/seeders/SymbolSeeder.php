<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SymbolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Mesial',
                'action' => '',
                'short' => 'M'
            ],
            [
                'name' => 'Occlusal',
                'action' => '',
                'short' => 'O'
            ],
            [
                'name' => 'Distal',
                'action' => '',
                'short' => 'D'
            ],
            [
                'name' => 'Vestibular/Bukal/Labial',
                'action' => '',
                'short' => 'V'
            ],
            [
                'name' => 'Lingual/Palatal',
                'action' => '',
                'short' => 'L'
            ],
            [
                'name' => 'Normal/baik',
                'action' => '',
                'short' => 'sou'
            ],
            [
                'name' => 'Tambalan Amalgam',
                'action' => '',
                'short' => 'amf'
            ],
            [
                'name' => 'Tambalan Composite',
                'action' => 'arsir',
                'short' => 'cof'
            ],
            [
                'name' => 'pit dan fissure sealant',
                'action' => '',
                'short' => 'fis'
            ],
            [
                'name' => 'gigi non-vital',
                'action' => '',
                'short' => 'nvt'
            ],
            [
                'name' => 'Perawatan Saluran Akar',
                'action' => '',
                'short' => 'rct'
            ],
            [
                'name' => 'gigi tidak ada, tidak diketahui ada atau tidak ada',
                'action' => '',
                'short' => 'non'
            ],
            [
                'name' => 'Un-Erupted',
                'action' => '',
                'short' => 'une'
            ],
            [
                'name' => 'Partial Erupt',
                'action' => '',
                'short' => 'pre'
            ],
            [
                'name' => 'Anomali (Pegshaped, micro, fusi, etc)',
                'action' => '',
                'short' => 'ano'
            ],
            [
                'name' => 'Caries',
                'action' => '',
                'short' => 'car'
            ],
            [
                'name' => 'fracture',
                'action' => '',
                'short' => 'cfr'
            ],
            [
                'name' => 'Full metal crown',
                'action' => '',
                'short' => 'fmc'
            ],
            [
                'name' => 'Partial erupted',
                'action' => '',
                'short' => 'pre'
            ],
            [
                'name' => 'Impacted visible',
                'action' => '',
                'short' => 'imv'
            ],
            [
                'name' => 'Diasterma',
                'action' => '',
                'short' => 'dia'
            ],
            [
                'name' => 'Atrisi',
                'action' => '',
                'short' => 'att'
            ],
            [
                'name' => 'Abrasi',
                'action' => '',
                'short' => 'abr'
            ],
            [
                'name' => 'Sisa Akar',
                'action' => '',
                'short' => 'rrx'
            ],
            [
                'name' => 'Gigi Hilang',
                'action' => '',
                'short' => 'mis'
            ],
            [
                'name' => 'GIC/Silika',
                'action' => '',
                'short' => 'gif'
            ],
            [
                'name' => 'Inlay',
                'action' => '',
                'short' => 'inl'
            ],
            [
                'name' => 'Onlay',
                'action' => '',
                'short' => 'onl'
            ],
            [
                'name' => 'Porcelain Crown',
                'action' => '',
                'short' => 'poc'
            ],
            [
                'name' => 'Metal Porcelain Crown',
                'action' => '',
                'short' => 'mpc'
            ],
            [
                'name' => 'Gold Metal Crown',
                'action' => '',
                'short' => 'gmc'
            ],
            [
                'name' => 'Implan',
                'action' => '',
                'short' => 'ipx'
            ],
            [
                'name' => 'Metal Bridge',
                'action' => '',
                'short' => 'meb'
            ],
            [
                'name' => 'Porcelain Bridge',
                'action' => '',
                'short' => 'pob'
            ],
            [
                'name' => 'Pontic',
                'action' => '',
                'short' => 'pon'
            ],
            [
                'name' => 'Gigi Abutment',
                'action' => '',
                'short' => 'abu'
            ],
            [
                'name' => 'Partial Denture',
                'action' => '',
                'short' => 'prd'
            ],
            [
                'name' => 'Full Denture',
                'action' => '',
                'short' => 'fld'
            ],
            [
                'name' => 'Acrilic',
                'action' => '',
                'short' => 'acr'
            ],
        ];

        DB::table('symbols')->insert($data);
    }
}
