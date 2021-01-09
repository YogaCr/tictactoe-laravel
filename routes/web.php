<?php

use App\Http\Livewire\Page\GamePage;
use App\Http\Livewire\Page\MainPage;
use App\Http\Livewire\Page\ProfilePage;
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

    Route::get('/',MainPage::class);

Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    
    Route::get('/user',ProfilePage::class);
    Route::get('/game/{id}',GamePage::class);
});