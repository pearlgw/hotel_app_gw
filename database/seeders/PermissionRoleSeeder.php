<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'manage users', // superadmin
            'manage category', // admin
            'manage bedrooms', // admin & staff
            'make confirmation', // admin & staff
            'make user order', // admin & staff
            'cashier', // admin & staff
            'view bedrooms', // order
            'make reservation', // order
            'view transaksi', // order
        ];

        foreach($permissions as $permission){
            Permission::firstOrCreate([
                'name' => $permission,
            ]);
        }

        $orderRole = Role::firstOrCreate([
            'name' => 'order'
        ]);

        $orderPermission = [
            'view bedrooms', // order
            'make reservation', // order
            'view transaksi', // order
        ];

        $orderRole->syncPermissions($orderPermission);

        $userOrder = User::create([
            'code_user' => 'ORD001',
            'name' => 'Order',
            'email' => 'order@gmail.com',
            'password' => bcrypt('password'),
            'no_phone' => '+628578389383',
            'address' => 'cilacap'
        ]);

        $userOrder->assignRole($orderRole);

        //

        $staffRole = Role::firstOrCreate([
            'name' => 'staff'
        ]);

        $staffPermission = [
            'manage bedrooms', // admin & staff
            'make confirmation', // admin & staff
            'cashier', // admin & staff
            'make user order' // admin & staff
        ];

        $staffRole->syncPermissions($staffPermission);

        $userStaff = User::create([
            'code_user' => 'STF001',
            'name' => 'Staff',
            'email' => 'staff@gmail.com',
            'password' => bcrypt('password'),
            'no_phone' => '+628578389383',
            'address' => 'cilacap'
        ]);

        $userStaff->assignRole($staffRole);

        //

        $adminRole = Role::firstOrCreate([
            'name' => 'admin'
        ]);

        $adminPermission = [
            'manage category', // admin
            'manage bedrooms', // admin & staff
            'make confirmation', // admin & staff
            'cashier', // admin & staff
            'make user order' // admin & staff
        ];

        $adminRole->syncPermissions($adminPermission);

        $userAdmin = User::create([
            'code_user' => 'ADM001',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('password'),
            'no_phone' => '+628578389383',
            'address' => 'cilacap'
        ]);

        $userAdmin->assignRole($adminRole);

        //

        $superAdminRole = Role::firstOrCreate([
            'name' => 'super_admin'
        ]);

        $userSuperAdmin = User::create([
            'code_user' => 'SADM001',
            'name' => 'Super Admin',
            'email' => 'superadmin@gmail.com',
            'password' => bcrypt('password'),
            'no_phone' => '+628578389383',
            'address' => 'Bandung'
        ]);

        $userSuperAdmin->assignRole($superAdminRole);
    }
}
