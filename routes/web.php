<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\PanierController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminProduitController;
use App\Http\Controllers\Admin\AdminCategorieController;
use App\Http\Controllers\Admin\AdminCommandeController;
use App\Http\Controllers\Admin\AdminShippingMethodController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FaqController;



/*
|--------------------------------------------------------------------------
| Routes Publiques
|--------------------------------------------------------------------------
*/

// Page d'accueil
Route::get('/', [HomeController::class, 'index'])->name('home');

// Authentification
Route::get('/inscription', [AuthController::class, 'showRegister'])->name('register');
Route::post('/inscription', [AuthController::class, 'register']);
Route::get('/connexion', [AuthController::class, 'showLogin'])->name('login');
Route::post('/connexion', [AuthController::class, 'login']);
Route::post('/deconnexion', [AuthController::class, 'logout'])->name('logout');

// Produits
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produit', [ProduitController::class, 'produit'])->name('produits.produit');
Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/categorie/{id}', [ProduitController::class, 'categorie'])->name('produits.categorie');

/*
|--------------------------------------------------------------------------
| Routes Authentifiées (Client)
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {
    // Panier
    Route::get('/panier', [PanierController::class, 'index'])->name('panier.index');
    Route::post('/panier/ajouter', [PanierController::class, 'ajouter'])->name('panier.ajouter');
    Route::post('/panier/modifier', [PanierController::class, 'modifier'])->name('panier.modifier');
    Route::delete('/panier/supprimer/{id}', [PanierController::class, 'supprimer'])->name('panier.supprimer');
    
    // Commandes
    Route::get('/commande/validation', [CommandeController::class, 'validation'])->name('commande.validation');
    Route::post('/commande/confirmer', [CommandeController::class, 'confirmer'])->name('commande.confirmer');
    Route::post('/commande/{commande}/paypal/order', [PaymentController::class, 'createPaypalOrder'])->name('paypal.create-order');
    Route::post('/commande/{commande}/paypal/capture', [PaymentController::class, 'capturePaypalOrder'])->name('paypal.capture-order');
    Route::get('/mes-commandes', [CommandeController::class, 'mesCommandes'])->name('commande.liste');
    Route::get('/commande/{id}', [CommandeController::class, 'details'])->name('commande.details');

});


/*
|--------------------------------------------------------------------------
| Routes Administrateur
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
//     // Gestion des produits
    Route::resource('produits', AdminProduitController::class);
    
//     // Gestion des catégories
    Route::resource('categories', AdminCategorieController::class);
    
//     // Gestion des commandes
    Route::get('commandes', [AdminCommandeController::class, 'index'])->name('commandes.index');
    Route::get('commandes/{id}', [AdminCommandeController::class, 'show'])->name('commandes.show');
    Route::post('commandes/{id}/statut', [AdminCommandeController::class, 'updateStatut'])->name('commandes.statut');
    Route::resource('shipping-methods', AdminShippingMethodController::class)->except(['show']);
    Route::delete('commandes/{id}', [AdminCommandeController::class, 'destroy'])->name('commandes.destroy');

});
Route::get('/commandes/payer', [PaymentController::class, 'payer'])->name('commande.payer');
// Route::get('/About', [AboutController::class, 'index'])->name('about');
// Route::get('/a-propos', [PageController::class, 'about'])->name('About');
Route::get('/a-propos', [AboutController::class, 'index'])->name('a-propos');
// route appropos
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/faq', [FaqController::class, 'faQ'])->name('faq');