<?php
namespace App\Http\Controllers;

use App\Models\User;


class UserController extends Controller
{
    public function index() {
        $users = User::all(['id', 'name']);
        return response()->json($users);
    }

}