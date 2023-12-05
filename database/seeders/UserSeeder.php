<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
       

        // Utiliser la factory pour générer des utilisateurs
        User::factory()->count(50)->create();
    }
}