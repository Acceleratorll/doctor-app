<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'add announcement']);
        Permission::create(['name' => 'view announcement']);
        Permission::create(['name' => 'edit announcement']);
        Permission::create(['name' => 'delete announcement']);
        Permission::create(['name' => 'publish announcement']);
        Permission::create(['name' => 'unpublish announcement']);

        Permission::create(['name' => 'add patient']);
        Permission::create(['name' => 'view patient']);
        Permission::create(['name' => 'edit patient']);
        Permission::create(['name' => 'delete patient']);

        Permission::create(['name' => 'add doctor']);
        Permission::create(['name' => 'view doctor']);
        Permission::create(['name' => 'edit doctor']);
        Permission::create(['name' => 'delete doctor']);

        Permission::create(['name' => 'add employee']);
        Permission::create(['name' => 'view employee']);
        Permission::create(['name' => 'edit employee']);
        Permission::create(['name' => 'delete employee']);

        Permission::create(['name' => 'add schedule']);
        Permission::create(['name' => 'view schedule']);
        Permission::create(['name' => 'edit schedule']);
        Permission::create(['name' => 'delete schedule']);

        Permission::create(['name' => 'add reservation']);
        Permission::create(['name' => 'view reservation']);
        Permission::create(['name' => 'edit reservation']);
        Permission::create(['name' => 'delete reservation']);

        Permission::create(['name' => 'add medical record']);
        Permission::create(['name' => 'view medical record']);
        Permission::create(['name' => 'edit medical record']);
        Permission::create(['name' => 'delete medical record']);

        Permission::create(['name' => 'manage reports']);

        $superadmin = Role::create(['name' => 'superadmin'])->givePermissionTo(Permission::all());
        $pegawai = Role::create(['name' => 'pegawai'])->givePermissionTo(
            'add announcement',
            'view announcement',
            'edit announcement',
            'delete announcement',
            'publish announcement',
            'unpublish announcement',
            'add medical record',
            'view medical record',
            'edit medical record',
            'delete medical record',
            'add schedule',
            'edit schedule',
            'view schedule',
            'edit schedule',
            'delete schedule',
            'add reservation',
            'edit reservation',
            'view reservation',
            'delete reservation',
            'add employee',
            'edit employee',
            'view employee',
            'add patient',
            'edit patient',
            'view patient',
            'delete patient',
            'delete employee',
            'manage reports',
        );

        $pasien = Role::create(['name' => 'pasien']);
        $dokter_umum = Role::create(['name' => 'dokter umum'])->givePermissionTo(
            'add announcement',
            'view announcement',
            'edit announcement',
            'delete announcement',
            'publish announcement',
            'unpublish announcement',
            'add medical record',
            'view medical record',
            'edit medical record',
            'delete medical record',
            'add schedule',
            'edit schedule',
            'view schedule',
            'edit schedule',
            'delete schedule',
            'add reservation',
            'edit reservation',
            'view reservation',
            'delete reservation',
            'add employee',
            'edit employee',
            'view employee',
            'add patient',
            'edit patient',
            'view patient',
            'delete patient',
            'delete employee',
            'manage reports',
        );
        $dokter_gigi = Role::create(['name' => 'dokter gigi'])->givePermissionTo(
            'add announcement',
            'view announcement',
            'edit announcement',
            'delete announcement',
            'publish announcement',
            'unpublish announcement',
            'add medical record',
            'view medical record',
            'edit medical record',
            'delete medical record',
            'add schedule',
            'edit schedule',
            'view schedule',
            'edit schedule',
            'delete schedule',
            'add reservation',
            'edit reservation',
            'view reservation',
            'delete reservation',
            'add employee',
            'edit employee',
            'view employee',
            'add patient',
            'edit patient',
            'view patient',
            'delete patient',
            'delete employee',
            'manage reports',
        );
    }
}
