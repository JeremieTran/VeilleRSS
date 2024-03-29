<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Category;
use App\Models\FluxRss;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator; // Importer la classe Validator

class RssController extends Controller
{
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
}
