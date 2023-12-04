<?php

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard(Request $request)
    {
        $user = $request->user(); // Ou auth()->user()

        if ($user->hasRole('admin')) {
            // Actions pour l'admin
        } else {
            abort(403, 'Accès non autorisé.');
        }
    }
}