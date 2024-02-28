<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsTableSeeder extends Seeder
{
    // Default permissions for different roles.
    protected $permissionAdmin = [
        'databarang.create',
        'databarang.delete',
        'databarang.view',
        'databarang.edit',
        'dataservis.create',
        'dataservis.delete',
        'dataservis.view',
        'dataservis.edit',
        'dataruang.create',
        'dataruang.delete',
        'dataruang.view',
        'dataruang.edit',
        'datauser.view',
        'datapeminjaman.create',
        'datapeminjaman.delete',
        'datapeminjaman.view',
        'datapeminjaman.edit',
        'riwayat.view'
    ];

    protected $permissionUser = [
        'datapeminjaman.create',
        'datapeminjaman.delete',
        'datapeminjaman.view',
        'datapeminjaman.edit',
        'riwayat.view',
        'users.create',
        'users.edit',
        'users.delete',
        'users.view'
    ];

       /**
     * Run the database seeds.
     */
    public function run()
    {
        // 1. Create DataBarang
        Permission::firstOrCreate(['name' => 'databarang.create', 'guard_name' => 'api']);
        
        // 2. Delete DataBarang
        Permission::firstOrCreate(['name' => 'databarang.delete', 'guard_name' => 'api']);

        // 3. View DataBarang
        Permission::firstOrCreate(['name' => 'databarang.view', 'guard_name' => 'api']);

        // 4. Edit Data Barang
        Permission::firstOrCreate(['name' => 'databarang.edit', 'guard_name' => 'api']);

        // 5. View Data Servis
        Permission::firstOrCreate(['name' => 'dataservis.view', 'guard_name' => 'api']);

        // 6. Create Data Servis
        Permission::firstOrCreate(['name' => 'dataservis.create', 'guard_name' => 'api']);

        // 7. Delete Data Servis
        Permission::firstOrCreate(['name' => 'dataservis.delete', 'guard_name' => 'api']);
        
        // 8. Edit Data Servis
        Permission::firstOrCreate(['name' => 'dataservis.edit', 'guard_name' => 'api']);

        // 9. View Data Ruang
        Permission::firstOrCreate(['name' => 'dataruang.view', 'guard_name' => 'api']);

        // 10. Edit Data Ruang
        Permission::firstOrCreate(['name' => 'dataruang.edit', 'guard_name' => 'api']);

        // 11. Delete Data Ruang
        Permission::firstOrCreate(['name' => 'dataruang.delete', 'guard_name' => 'api']);

        // 12. Create Data Ruang
        Permission::firstOrCreate(['name' => 'dataruang.create', 'guard_name' => 'api']);

        // 13. View Data User
        Permission::firstOrCreate(['name' => 'datauser.view', 'guard_name' => 'api']);

        // 14. Delete Data Peminjaman
        Permission::firstOrCreate(['name' => 'datapeminjaman.delete', 'guard_name' => 'api']);

        // 15. View Data Peminjaman
        Permission::firstOrCreate(['name' => 'datapeminjaman.view', 'guard_name' => 'api']);

        // 16. Edit Data Peminjaman
        Permission::firstOrCreate(['name' => 'datapeminjaman.edit', 'guard_name' => 'api']);

        // 17. Create Data Peminjaman
        Permission::firstOrCreate(['name' => 'datapeminjaman.create', 'guard_name' => 'api']);

        // 18. View Riwayat
        Permission::firstOrCreate(['name' => 'riwayat.view', 'guard_name' => 'api']);

        // 19. Create User Account
        Permission::firstOrCreate(['name' => 'users.create', 'guard_name' => 'api']);

        // 20. Edit User Account
        Permission::firstOrCreate(['name' => 'users.edit', 'guard_name' => 'api']);

        // 21. Delete User Account
        Permission::firstOrCreate(['name' => 'users.delete', 'guard_name' => 'api']);

        // 19. View User Account
        Permission::firstOrCreate(['name' => 'users.view', 'guard_name' => 'api']);

        // Assign permissions to roles
        $roles = Role::all();

        foreach ($roles as $role) {
            // Check the role
            if ($role->name === 'admin') {
                $role->syncPermissions($this->permissionAdmin);
            } elseif ($role->name === 'user') {
                $role->syncPermissions($this->permissionUser);
            } 
        }
    }
}