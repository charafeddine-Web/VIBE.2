<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AmisController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentaireController;


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
Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum',config('jetstream.auth_session'), 'verified',
])->group(function () {
//    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');

    Route::get('/demandes', [AmisController::class, 'afficherDemandesAmitie'])->name('afficherDemandesAmitie');
    Route::post('/envoyer-demande-amitie/{utilisateur_recepteur_id}', [UserController::class, 'envoyerDemandeAmitie'])->name('envoyerDemandeAmitie');
    Route::get('/Search',[UserController::class,'Search'])->name('Search');

    Route::post('/accepter-demande/{id}', [AmisController::class, 'accepterDemandeAmitie'])->name('accepterDemandeAmitie');
    Route::delete('/refuser-demande/{id}', [AmisController::class, 'refuserDemandeAmitie'])->name('refuserDemandeAmitie');
    Route::delete('/anuller-demande/{id}', [AmisController::class, 'AnnulerDemandeAmitie'])->name('AnnulerDemandeAmitie');
    Route::get('/list-Amis', [AmisController::class, 'showallamisaccepter'])->name('showallamis');

// Routes pour les publication

    Route::get('posts', [PostController::class, 'index'])->name('posts.index');
    Route::post('posts', [PostController::class, 'store'])->name('posts.store');
    Route::get('posts/edit/{id}', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('posts/update/{id}', [PostController::class, 'update'])->name('posts.update');
    Route::delete('posts/delete/{id}', [PostController::class, 'destroy'])->name('posts.destroy');

// Routes pour les commontaire

    Route::post('commentaires', [CommentaireController::class, 'store'])->name('commentaires.store');
    Route::delete('commentaires/{id}', [CommentaireController::class, 'destroy'])->name('commentaires.destroy');



});


