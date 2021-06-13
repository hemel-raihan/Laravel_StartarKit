<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $moduleAppDashboard = Module::updateOrCreate([
            'name' => 'Admin Dashboard'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppDashboard->id,
            'name' => 'Access Dashboard',
            'slug' => 'app.dashboard'
        ]);

        $moduleAppRole = Module::updateOrCreate([
            'name' => 'Role Management'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Access Role',
            'slug' => 'app.roles.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Create Role',
            'slug' => 'app.roles.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Edit Role',
            'slug' => 'app.roles.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppRole->id,
            'name' => 'Delete Role',
            'slug' => 'app.roles.destroy'
        ]);


        $moduleAppUser = Module::updateOrCreate([
            'name' => 'User Management'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Access User',
            'slug' => 'app.users.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Create User',
            'slug' => 'app.users.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Edit User',
            'slug' => 'app.users.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppUser->id,
            'name' => 'Delete User',
            'slug' => 'app.users.destroy'
        ]);


        $moduleAppBackups = Module::updateOrCreate([
            'name' => 'Backups'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Access Backup',
            'slug' => 'app.backups.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Create Backup',
            'slug' => 'app.backups.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Download Backup',
            'slug' => 'app.backups.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppBackups->id,
            'name' => 'Delete Backup',
            'slug' => 'app.backups.destroy'
        ]);

//pages
        $moduleAppPage = Module::updateOrCreate([
            'name' => 'Page'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Access Page',
            'slug' => 'app.pages.index'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Create Page',
            'slug' => 'app.pages.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Edit Page',
            'slug' => 'app.pages.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppPage->id,
            'name' => 'Delete Page',
            'slug' => 'app.pages.destroy'
        ]);


        //menu
        $moduleAppMenu = Module::updateOrCreate([
            'name' => 'Menu'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Access Menus',
            'slug' => 'app.menus.index'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Access Menu Builder',
            'slug' => 'app.menus.builder'
        ]);

        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Create Menus',
            'slug' => 'app.menus.create'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Edit Menus',
            'slug' => 'app.menus.edit'
        ]);
        Permission::updateOrCreate([
            'module_id' => $moduleAppMenu->id,
            'name' => 'Delete Menus',
            'slug' => 'app.menus.destroy'
        ]);
    }
}