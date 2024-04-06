<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FluxRss;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator; // Importer la classe Validator
use App\Models\Category;

class RssController extends Controller
{
    public function edit($id)
    {
        // Récupérer le flux à modifier
        $flux = FluxRss::findOrFail($id);

        // Afficher le formulaire de modification avec les données du flux
        return view('services', compact('flux'));
    }

    public function updateFlux(Request $request, $id)
    {
        // Récupérer le flux à mettre à jour
        $flux = FluxRss::findOrFail($id);
    
        // Vérifier l'action demandée
        if ($request->action == 'edit') {
            // Mettre à jour les données du flux avec les nouvelles valeurs
            $flux->url = $request->input('url');
            $flux->save();
    
            // Redirection avec un message de succès
            return redirect()->back()->with('success', 'Flux mis à jour avec succès.');
        } elseif ($request->action == 'delete') {
            // Supprimer le flux
            $flux->delete();
    
            // Redirection avec un message de succès
            return redirect()->back()->with('success', 'Flux supprimé avec succès.');
        }
    
        // Si l'action n'est ni "edit" ni "delete", rediriger avec un message d'erreur
        return redirect()->back()->with('error', 'Action non reconnue.');
    }

    public function create()
    {
        // Récupérer l'utilisateur connecté
        $user = auth()->user();
        
        // Récupérer toutes les catégories et sous-catégories de l'utilisateur connecté
        $categories = $user->categories()->with('subcategories.flux')->get();
    
        return view('services', compact('categories'));
    }

    public function store(Request $request)
    {

    
        // Création du flux RSS
        $rss = new FluxRss();
        $rss->url = $request->input('rss_url');
        $rss->category_id = $request->input('category_id');
        $rss->save();
    
        // Redirection vers la même page avec un message de succès
        return redirect()->back()->with('success', 'Flux créé avec succès.');
    }
    public function indexRss()
    {
        // Récupérer toutes les catégories avec leurs sous-catégories et les URL de flux RSS correspondantes
        $parentCategories = Category::with('children')->get();
    
        return view('index', compact('parentCategories'));
    }
    
}
