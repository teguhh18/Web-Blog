<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create Permissions untuk User Management
        $userPermissions = [
            'user-create',
            'user-read',
            'user-update',
            'user-delete',
        ];

        // Create Permissions untuk Permission Management (hanya admin)
        $permissionPermissions = [
            'permission-create',
            'permission-read',
            'permission-update',
            'permission-delete',
        ];

        // Create Permissions untuk Role Management (hanya admin)
        $rolePermissions = [
            'role-create',
            'role-read',
            'role-update',
            'role-delete',
        ];

        // Create Permissions untuk Berita Management
        $beritaPermissions = [
            'berita-create',
            'berita-read',
            'berita-update',
            'berita-delete',
        ];

        // Create Permissions untuk Tools Management
        $toolsPermissions = [
            'tools-create',
            'tools-read',
            'tools-update',
            'tools-delete',
        ];

        // Create Permissions untuk Kategori Management
        $kategoriPermissions = [
            'kategori-create',
            'kategori-read',
            'kategori-update',
            'kategori-delete',
        ];

        // Create Permissions untuk Comment Management
        $commentPermissions = [
            'comment-create',
            'comment-read',
            'comment-update',
            'comment-delete',
        ];

        // Create Permissions access dashboard
        $dashboardPermissions = [
            'dashboard-access',
        ];

        // Create Permissions untuk Role Ai Management
        $roleAiPermissions = [
            'ai-create',
            'ai-read',
            'ai-update',
            'ai-delete',
        ];

        // Create Permissions untuk Template Image Management
        $templateImagePermissions = [
            'template-image-create',
            'template-image-read',
            'template-image-update',
            'template-image-delete',
        ];

        // Gabungkan semua permission dan buat dalam satu loop
        $allPermissions = array_merge(
            $userPermissions,
            $rolePermissions,
            $permissionPermissions,
            $beritaPermissions,
            $toolsPermissions,
            $kategoriPermissions,
            $commentPermissions,
            $dashboardPermissions,
            $roleAiPermissions,
            $templateImagePermissions
        );

        foreach ($allPermissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // Create Roles dan assign permissions

        // Role: Admin - Full Access (CRUD semua)
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(Permission::all());

        // Role: Staff - Read dan Update User
        $staffRole = Role::create(['name' => 'penulis']);
        $staffRole->givePermissionTo($beritaPermissions, $dashboardPermissions);

        // Role: User/Pembaca - Read Only
        $userRole = Role::create(['name' => 'user']);
        // $userRole->givePermissionTo(['berita-read']);

        // Create super admin user (optional)
        $admin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole('admin');

        // Create penulis/user (optional)
        $staff = User::create([
            'name' => 'Penulis',
            'email' => 'penulis@example.com',
            'password' => bcrypt('password'),
        ]);
        $staff->assignRole('penulis');

        // Create regular user (optional)
        $user = User::create([
            'name' => 'Regular User',
            'email' => 'user@example.com',
            'password' => bcrypt('password'),
        ]);
        $user->assignRole('user');

        $this->command->info('Roles and Permissions seeded successfully!');
    }
}
