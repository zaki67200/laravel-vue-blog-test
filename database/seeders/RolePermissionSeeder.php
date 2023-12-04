<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
    {
        // Création des rôles
        $roleAdmin = Role::create(['name' => 'admin']);
        // ... autres rôles ...

        // Création des permissions
        $permEditArticles = Permission::create(['name' => 'edit articles']);
        // ... autres permissions ...

        // Assigner les permissions au rôle
        $roleAdmin->givePermissionTo($permEditArticles);
        // ... autres assignations ...
    }
}