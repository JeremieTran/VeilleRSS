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
    public function deleteCategory(Request $request, $categoryId)
    {
        // Récupérer la catégorie à supprimer
        $category = Category::findOrFail($categoryId);
    
        // Vérifier si la catégorie existe
        if (!$category) {
            return redirect()->back()->with('error', 'Catégorie non trouvée.');
        }
    
        // Vérifier si des sous-catégories sont associées à cette catégorie
        if ($category->children()->exists()) {
            // Si des sous-catégories existent, renvoyer un message d'erreur
            return redirect()->back()->with('error', 'Supprimez en premier les sous-catégories avant de supprimer cette catégorie.');
        }
    
        // Si aucune sous-catégorie n'est associée, supprimer la catégorie
        if ($request->action == 'delete') {
            $category->delete();
            return redirect()->back()->with('success', 'Catégorie supprimée avec succès.');
        }
    }
    public function deleteSubCategory(Request $request, $parentId, $subcategoryId)
    {
        // Récupérer la sous-catégorie à supprimer
        $subcategory = Category::where('parent_id', $parentId)->findOrFail($subcategoryId);
    
        // Vérifier si la sous-catégorie existe
        if (!$subcategory) {
            return redirect()->back()->with('error', 'Sous-catégorie non trouvée.');
        }
        // Vérifier s'il y a des flux RSS associés à cette sous-catégorie
        if ($subcategory->flux()->count() > 0) {
            // S'il y a des flux RSS, retourner un message d'erreur
            return redirect()->back()->with('error', 'Veuillez supprimer en premier les flux RSS associés à cette sous-catégorie.');
        }
        // Vérifier l'action demandée
        if ($request->action == 'delete') {
            // Supprimer la sous-catégorie
            $subcategory->delete();
    
            // Redirection avec un message de succès
            return redirect()->back()->with('success', 'Sous-catégorie supprimée avec succès.');
        }
    }
}
   

