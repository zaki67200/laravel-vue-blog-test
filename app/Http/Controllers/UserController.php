<?php
namespace App\Http\Controllers;

use App\Models\User;


class UserController extends Controller
{
    public function store(Request $request)
    {
        // Logique de création de l'utilisateur
        $user = User::create(/* données de l'utilisateur */);

        // Assignation du rôle et des permissions
        $user->assignRole('admin');
        $user->givePermissionTo('edit articles');

  
    }

}