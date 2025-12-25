<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;

Route::get('/', function () {
    return view('welcome');
});

// Route avec parametre optionnel donc on ajoute ? (dans l'URL dynamique)
// Route::get('/shop/{nom?}', [ArticleController::class, 'index']);

// pour lister les articles de la boutique
// Route::get('/shop', [ArticleController::class, 'index'])->name('shop.index');

// // Pour contrôler le format des paramètres, ajouter la méthode where() pour définir une expression régulière pour le paramètre
// Route::get('/shop/{slug}-{id}', [ArticleController::class, 'show'])->where([
//     'slug' => '[a-z0-9\-]+',
//     'id' => '[0-9]+'
// ])->name('shop.show');


// Il est possible de grouper les deux routes que nous avons créé car elles ont un préfixe commun dans l’url (‘shop’)

Route::prefix('shop')->name('shop.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');

    Route::get('/{slug}-{article}', [ArticleController::class, 'show'])->where([
        'slug' => '[a-z0-9\-]+',
        'article' => '[0-9]+'
    ])->name('show');

    // pour les routes CRUD des articles (Create, Read, Update, Delete)
    Route::middleware('auth')->group(function () {
        // Routes protégées par le middleware 'auth' (exemple : ajout d'articles

        Route::get('/new', [ArticleController::class, 'create'])
            ->name('create');

        Route::post('/new', [ArticleController::class, 'store'])
            ->name('store');

        Route::get('/{article}/edit', [ArticleController::class, 'edit'])
            ->name('edit');

        Route::patch('/{article}', [ArticleController::class, 'update'])
            ->name('update');

        Route::delete('/{article}', [ArticleController::class, 'destroy'])
            ->name('destroy');
    });
});

Route::get('/register', [RegisterController::class, 'getFormRegister'])
    ->name('register');

Route::post('/register', [RegisterController::class, 'registerUser']);

// middleware 'auth' pour protéger la route du profil utilisateur
Route::view('/profile', 'auth.profile')
    ->name('profile')->middleware('auth');

// pour protéger les routes de connexion et d'inscription aux utilisateurs non authentifiés
Route::get('/login', [LoginController::class, 'getFormLogin'])
    ->name('login')->middleware('guest');

Route::post('/login', [LoginController::class, 'loginUser']);

Route::delete('/logout', [LoginController::class, 'logout'])
    ->name('logout');





// Remarque : vous pouvez à tout moment lister l’ensemble des routes de l’application en exécutant la commande : 
//  php artisan route:list (dans le terminal à la racine du projet.)