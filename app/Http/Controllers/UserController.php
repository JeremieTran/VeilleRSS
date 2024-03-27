<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request; // Import de la classe Request

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('gallery', compact('users'));
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('gallery')->with('error', 'Utilisateur non trouvé.');
        }

        if ($request->action == 'edit') {
            // Mettre à jour les informations de l'utilisateur
            $user->name = $request->name;
            $user->email = $request->email;
            $user->save();

            return redirect()->route('gallery')->with('success', 'Utilisateur mis à jour avec succès.');
        } elseif ($request->action == 'delete') {
            // Supprimer l'utilisateur
            $user->delete();

            return redirect()->route('gallery')->with('success', 'Utilisateur supprimé avec succès.');
        }

        return redirect()->route('gallery')->with('error', 'Action non reconnue.');
    }

}
