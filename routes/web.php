<?php

use App\Events\FormSubmitted;
use App\Http\Livewire\GamePage;
use App\Http\Livewire\OnlineList;
use Illuminate\Http\Client\Request;
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
Route::middleware(['auth:sanctum', 'verified'])->group(function(){
    Route::get('/', function () {
        return view('dashboard');
    })->name('dashboard');    
    Route::get('/online',OnlineList::class);
    Route::get('/game/{id}',GamePage::class);
});