<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    public function run()
 {
   
$roles = ['admin', 'editor', 'user'];
foreach ($roles as $roleName) {
    Role::create(['name' => $roleName]);
}

$permissions = ['edit articles', 'delete articles', 'view articles','create articles'];
foreach ($permissions as $permissionName) {
    Permission::create(['name' => $permissionName]);
}
    }
}