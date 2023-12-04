<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
// ... autres imports ...

class UserSeeder extends Seeder
{
    public function run()
    {
        // Création d'un utilisateur exemple
        $user = User::create([
            'name' => 'zak',
            'email' => 'zak@email.com',
            'password' => Hash::make('password'),
            // autres attributs...
        ]);

        // Assignation de rôle et permissions
        $user->assignRole('admin');
        $user->givePermissionTo('edit articles');
    }
}