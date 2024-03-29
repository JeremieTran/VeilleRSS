<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function create()
    {
        $categories = $user->categories()->with('subcategories')->get();
        $parentCategories = Category::whereNull('parent_id')->get();
        return view('create_category', compact('categories','parentCategories'));
 
        
    }
    
    public function store(Request $request)
    {
        // Validation des données
        $request->validate([
            'subcategory_name' => 'required|string|max:255',
            'rss_url' => 'nullable|url|max:255', // Validation de l'URL du flux RSS
        ]);

        // Création de la sous-catégorie
        $subcategory = new Category();
        $subcategory->name = $request->input('subcategory_name');
        $subcategory->users_id = Auth::id(); // Renseigne l'ID de l'utilisateur connecté

        // Si une catégorie parente a été sélectionnée, associez-la à la sous-catégorie
        if ($request->filled('parent_category_id')) {
            $parentCategory = Category::findOrFail($request->input('parent_category_id'));
            $subcategory->parent_id = $parentCategory->id;
        }

        $subcategory->save();

        // Redirection vers la même page
        return redirect()->back()->with('success', 'Sous-catégorie créée avec succès.');
    }

    // Méthode pour créer une catégorie parente
    public function storeCategory(Request $request)
    {
        // Validation des données
        $request->validate([
            'category_name' => 'required|string|max:255',
        ]);

        // Création de la catégorie parente
        $category = new Category();
        $category->name = $request->input('category_name');
        $category->users_id = Auth::id(); // Renseigne l'ID de l'utilisateur connecté
        $category->save();

        // Redirection vers la même page
        return redirect()->back()->with('success', 'Catégorie créée avec succès.');
    }
}
   

