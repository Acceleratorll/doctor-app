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
                'group_id' => 1,
                'name' => 'Mesial',
                'action' => '',
                'short' => 'M',
            ],
            [
                'group_id' => 1,
                'name' => 'Occlusal',
                'action' => '',
                'short' => 'O',
            ],
            [
                'group_id' => 1,
                'name' => 'Distal',
                'action' => '',
                'short' => 'D',
            ],
            [
                'group_id' => 1,
                'name' => 'Vestibular/Bukal/Labial',
                'action' => '',
                'short' => 'V',
            ],
            [
                'group_id' => 1,
                'name' => 'Lingual/Palatal',
                'action' => '',
                'short' => 'L',
            ],
            [
                'group_id' => 2,
                'name' => 'Normal/baik',
                'action' => '',
                'short' => 'sou',
            ],
            [
                'group_id' => 3,
                'name' => 'Tambalan Amalgam',
                'action' => '',
                'short' => 'amf',
            ],
            [
                'group_id' => 3,
                'name' => 'Tambalan Composite',
                'action' => 'arsir',
                'short' => 'cof',
            ],
            [
                'group_id' => 3,
                'name' => 'pit dan fissure sealant',
                'action' => '',
                'short' => 'fis',
            ],
            [
                'group_id' => 2,
                'name' => 'gigi non-vital',
                'action' => '',
                'short' => 'nvt',
            ],
            [
                'group_id' => 4,
                'name' => 'Perawatan Saluran Akar',
                'action' => '',
                'short' => 'rct',
            ],
            [
                'group_id' => 2,
                'name' => 'gigi tidak ada, tidak diketahui ada atau tidak ada',
                'action' => '',
                'short' => 'non',
            ],
            [
                'group_id' => 2,
                'name' => 'Un-Erupted',
                'action' => '',
                'short' => 'une',
            ],
            [
                'group_id' => 2,
                'name' => 'Anomali (Pegshaped, micro, fusi, etc)',
                'action' => '',
                'short' => 'ano',
            ],
            [
                'group_id' => 2,
                'name' => 'Caries',
                'action' => '',
                'short' => 'car',
            ],
            [
                'group_id' => 2,
                'name' => 'fracture',
                'action' => '',
                'short' => 'cfr',
            ],
            [
                'group_id' => 4,
                'name' => 'Full metal crown',
                'action' => '',
                'short' => 'fmc',
            ],
            [
                'group_id' => 2,
                'name' => 'Partial erupted',
                'action' => '',
                'short' => 'pre',
            ],
            [
                'group_id' => 2,
                'name' => 'Impacted visible',
                'action' => '',
                'short' => 'imv',
            ],
            [
                'group_id' => 2,
                'name' => 'Diasterma',
                'action' => '',
                'short' => 'dia',
            ],
            [
                'group_id' => 2,
                'name' => 'Atrisi',
                'action' => '',
                'short' => 'att',
            ],
            [
                'group_id' => 2,
                'name' => 'Abrasi',
                'action' => '',
                'short' => 'abr',
            ],
            [
                'group_id' => 2,
                'name' => 'Sisa Akar',
                'action' => '',
                'short' => 'rrx',
            ],
            [
                'group_id' => 2,
                'name' => 'Gigi Hilang',
                'action' => '',
                'short' => 'mis',
            ],
            [
                'group_id' => 3,
                'name' => 'GIC/Silika',
                'action' => '',
                'short' => 'gif',
            ],
            [
                'group_id' => 3,
                'name' => 'Inlay',
                'action' => '',
                'short' => 'inl',
            ],
            [
                'group_id' => 3,
                'name' => 'Onlay',
                'action' => '',
                'short' => 'onl',
            ],
            [
                'group_id' => 4,
                'name' => 'Porcelain Crown',
                'action' => '',
                'short' => 'poc',
            ],
            [
                'group_id' => 4,
                'name' => 'Metal Porcelain Crown',
                'action' => '',
                'short' => 'mpc',
            ],
            [
                'group_id' => 4,
                'name' => 'Gold Metal Crown',
                'action' => '',
                'short' => 'gmc',
            ],
            [
                'group_id' => 4,
                'name' => 'Implan',
                'action' => '',
                'short' => 'ipx',
            ],
            [
                'group_id' => 4,
                'name' => 'Metal Bridge',
                'action' => '',
                'short' => 'meb',
            ],
            [
                'group_id' => 4,
                'name' => 'Porcelain Bridge',
                'action' => '',
                'short' => 'pob',
            ],
            [
                'group_id' => 4,
                'name' => 'Pontic',
                'action' => '',
                'short' => 'pon',
            ],
            [
                'group_id' => 4,
                'name' => 'Gigi Abutment',
                'action' => '',
                'short' => 'abu',
            ],
            [
                'group_id' => 5,
                'name' => 'Partial Denture',
                'action' => '',
                'short' => 'prd',
            ],
            [
                'group_id' => 5,
                'name' => 'Full Denture',
                'action' => '',
                'short' => 'fld',
            ],
            [
                'group_id' => 5,
                'name' => 'Acrilic',
                'action' => '',
                'short' => 'acr',
            ],
        ];

        DB::table('symbols')->insert($data);
    }
}
