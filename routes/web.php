<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Models\Item;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

// Route::get('/', function () { 
//     $items = Item::all();
//     return view('pages.home', compact('items'));
// })->name('home');

Route::get('/about', function () {
    return view('pages.info.about');
})->name('info.about');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'auth']);
Route::get('/logout', [UserController::class, 'logout'])->name('logout');
Route::get('/register', [UserController::class, 'create'])->name('create');
Route::post('/register', [UserController::class, 'store']);

Route::get('user/dashboard', [UserController::class, 'dashboard'])
->middleware('auth')->name('user.dashboard');

Route::get('/users/{id?}', [UserController::class, 'get_user'])
->where('id', '[0-9]+')->name('user.show');

Route::prefix('/tags')->name('tags.')->middleware('auth')->group(function()
{
    Route::get('/{id}/edit', [TagController::class, 'edit'])->name('edit');
    Route::post('/{id}/edit', [TagController::class, 'update'])->name('update');
    Route::get('/create', [TagController::class, 'create'])->name('create');
    Route::post('/create', [TagController::class, 'store'])->name('store');
});

Route::prefix('/items')->name('items.')->group(function()
{
    Route::get('/', [ItemController::class, 'index'])->name('index');
    Route::get('/{id}/show', [ItemController::class, 'show'])->name('show');
    Route::get('/tag/{id}', [itemController::class, 'show_by_tag'])->name('by_tag');
    
    Route::middleware('auth')->group(function()
    {
        Route::get('/{id}/edit', [itemController::class, 'edit'])->name('edit');
        Route::post('/{id}/edit', [ItemController::class, 'update'])->name('update');
        Route::get('/create', [ItemController::class, 'create'])->name('create');
        Route::post('/create', [ItemController::class, 'store'])->name('store');
        Route::post('/{id}/like', [ItemController::class, 'like'])->name('like');
        Route::post('/{id}/dislike', [ItemController::class, 'dislike'])->name('dislike');
        Route::post('/{id}/add_to_basket', [ItemController::class, 'add_to_basket'])->name('add_to_basket');
        Route::post('/{id}/remove_from_basket', [ItemController::class, 'remove_from_basket'])->name('remove_from_basket');
        Route::post('/{id}/add_to_shelf', [ItemController::class, 'add_to_shelf'])->name('add_to_shelf');
        Route::post('/{id}/remove_from_shelf', [ItemController::class, 'remove_from_shelf'])->name('remove_from_shelf');
        
        Route::post('/{id}/attach/tag', [ItemController::class, 'attach_tag'])->name('attach_tag');
        Route::post('/{id}/detacg/tag', [ItemController::class, 'detach_tag'])->name('detach_tag');
        
        Route::post('/{id}/review/store', [ItemController::class, 'review_store'])->name('review_store');
    });
});

