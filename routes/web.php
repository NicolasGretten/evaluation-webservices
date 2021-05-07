<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\RedacteurController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/articles', function () {
    return view('articles', ['data'=>$data = (new \App\Http\Controllers\ArticleController())->list()->getOriginalContent()]);
})->middleware(['auth'])->name('articles');

Route::get('/articles/add', [ArticleController::class, 'createForm'])->middleware(['auth'])->name('AddArticle');

Route::post('/articles', function (Request $request) {
    $response = (new ArticleController())->create($request);
    if ($response->getStatusCode() === 200){
        return redirect('articles');
    }
    return false;
})->middleware(['auth'])->name('createArticle');

Route::get('/articles/{id}/delete', function (Request $request) {
    $response = (new ArticleController())->delete($request);
    if ($response->getStatusCode() === 200){
        return back()->with('success','Article supprimer.');
    }
    return false;
})->middleware(['auth']);

Route::get('/articles/{id}/update', [ArticleController::class, 'createUpdateForm'])->middleware(['auth']);

Route::post('/articles/{id}', function (Request $request) {
    $response = (new ArticleController())->update($request);
    if ($response->getStatusCode() === 200){
        return redirect('articles');
    }
    return false;
})->middleware(['auth']);


//Route::delete('/articles/{id}', function (Request $request) {
//    $response = (new ArticleController())->delete($request);
//    if ($response->getStatusCode() === 200){
//        return back()->with('success','Article supprimer.');
//    }
//    return false;
//})->middleware(['auth'])->name('deleteArticle');

Route::get('/redacteurs', [RedacteurController::class, 'createForm'])->middleware(['auth'])->name('redacteurs');

//Route::post('/redacteurs', [RedacteurController::class, 'create'])->name('createRedacteur');
Route::post('/redacteurs', function (Request $request) {
    $response = (new RedacteurController())->create($request);
    if ($response->getStatusCode() === 200){
        return back()->with('success','Redacteur enregistrer.');
    }
    return false;
})->middleware(['auth'])->name('createRedacteur');

Route::get('/categories', [CategoryController::class, 'createForm'])->middleware(['auth'])->name('categories');

Route::post('/categories', function (Request $request) {
    $response = (new CategoryController())->create($request);
    if ($response->getStatusCode() === 200){
        return back()->with('success','Catégorie enregistrer.');
    }
    return false;
})->middleware(['auth'])->name('createCategory');

Route::get('/search', [ArticleController::class, 'createSearchForm'])->middleware(['auth'])->name('search');
//Route::get('/search', function () {
//    return view('search');
//})->middleware(['auth'])->name('search');

require __DIR__.'/auth.php';
