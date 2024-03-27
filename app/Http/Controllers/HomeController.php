<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Vérifier si un utilisateur est connecté
        if (Auth::check()) {
            // Récupérer l'utilisateur connecté
            $user = Auth::user();

            // Récupérer les catégories liées à l'utilisateur connecté avec leurs sous-catégories
            $parentCategories = $user->categories()->with(['children' => function ($query) use ($user) {
                $query->where('users_id', $user->id);
            }])->whereNull('parent_id')->get();
            
            return view('index', ['parentCategories' => $parentCategories]);
        } else {
            // Si aucun utilisateur n'est connecté, renvoyer toutes les catégories
            $parentCategories = Category::whereNull('parent_id')->get();
            return view('index', ['parentCategories' => $parentCategories]);
        }
    }
    public function services()
    {
        // Vérifier si un utilisateur est connecté
        if (Auth::check()) {
            // Récupérer l'utilisateur connecté
            $user = Auth::user();

            // Récupérer les catégories liées à l'utilisateur connecté avec leurs sous-catégories
            $parentCategories = $user->categories()->with(['children' => function ($query) use ($user) {
                $query->where('users_id', $user->id);
            }])->whereNull('parent_id')->get();
            
            return view('services', ['parentCategories' => $parentCategories]);
        } else {
            // Si aucun utilisateur n'est connecté, renvoyer toutes les catégories
            $parentCategories = Category::whereNull('parent_id')->get();
            return view('services', ['parentCategories' => $parentCategories]);
        }
    }
}