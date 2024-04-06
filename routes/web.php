<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RssController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/index', function () {
//     return view('index');
// });

Route::get('/services', function () {
    return view('services');
});

Route::get('/about-us', function () {
    return view('about-us');
});

Route::get('/', function () {
    return view('index');
});

Route::get('/gallery', [UserController::class, 'index'])->name('gallery'); // Définition de la route nommée "gallery"

Route::put('/gallery/{id}', [UserController::class, 'updateUser'])->name('updateUser');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/', [HomeController::class, 'index'])->middleware('auth.user');

Route::post('/logout', function () {
    Auth::logout();
    return redirect('/'); // Redirige vers la page d'accueil après la déconnexion
})->middleware('auth')->name('logout');
Route::get('/services', [HomeController::class, 'services'])->name('services');
Route::get('/categories/create', [CategoryController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::post('/categories/create', [CategoryController::class, 'storeCategory'])->name('categories.storeCategory');
Route::delete('/category/{parentId}/subcategory/{subcategoryId}', [CategoryController::class, 'deleteSubCategory'])->name('subcategory.delete');
Route::delete('/category/{categoryId}', [CategoryController::class, 'deleteCategory'])->name('category.delete');


// Définir la route pour afficher le formulaire de création de flux RSS
Route::get('/rss/create', [RssController::class, 'create'])->name('rss.create');

// Définir la route pour enregistrer le flux RSS
Route::post('/rss', [RssController::class, 'store'])->name('rss.store');

Route::middleware('auth')->group(function () {
    // Route pour afficher le formulaire de modification d'un flux
    Route::get('/rss/{id}/edit', [RssController::class, 'edit'])->name('rss.edit');

    // Route pour mettre à jour un flux
    Route::put('/rss/{id}', [RssController::class, 'updateFlux'])->name('updateFlux');

    // Route pour supprimer un flux
    Route::delete('/rss/{id}', [RssController::class, 'destroy'])->name('rss.destroy');
});

// Route::get('/', function () {
//     return view('index');
// })->middleware('auth.user');

require __DIR__.'/auth.php';
