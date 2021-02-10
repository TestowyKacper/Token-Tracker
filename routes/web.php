<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use  App\Http\Controllers\TransController;
use  App\Http\Controllers\PanelAdminaController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\SymboleController;
use App\Http\Controllers\SygnalyController;
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


Auth::routes();


//Przekierowania na strony
Route::get('/', [PagesController::class, 'index']);
Route::get('/home',[ PagesController::class, 'index'])->name('home');
Route::get('/kup', [PagesController::class, 'kup'])->name('kup');
Route::get('/portfel', [PagesController::class, 'portfel'])->name('portfel');

//obsluga transakcji
Route::post('/save', [TransController::class, 'store'])->name('save');
Route::post('/saveedit', [TransController::class, 'update'])->name('saveedit');
Route::post('/cena/{id}', [TransController::class, 'edytuj_cene'])->name('cena');
Route::get('/edit/{id}', [TransController::class, 'edit'])->name('edit');
Route::get('/zamknij/{id}/{cena}', [TransController::class, 'zamknij_poz'])->name('zamknij');
Route::get('/usun/{id}', [TransController::class, 'destroy'])->name('usun');
Route::get('/usunZam/{id}', [TransController::class, 'usunZam'])->name('usunZam');
Route::get('/zamkniete', [TransController::class, 'pokaz_zamkniete'])->name('zamkniete');


//Obsluga sygnałów
Route::get('/dodaj-sygnal',[ SygnalyController::class, 'index'])->name('addsygnaly');
Route::get('/sygnaly',[ SygnalyController::class, 'index'])->name('sygnaly');
Route::post('/zapisz-sygnal',[ SygnalyController::class, 'create'])->name('zapisz-sygnal');
Route::get('/zaakceptowany/{id}',[ SygnalyController::class, 'zaakceptowany'])->name('zaakceptowany');
Route::get('/odrzucony/{id}',[ SygnalyController::class, 'odrzucony'])->name('odrzucony');
Route::get('/pokaz-sygnaly',[ SygnalyController::class, 'show'])->name('pokaz-sygnaly');


//Panel administratora
Route::get('/uzytkownicy', [PanelAdminaController::class, 'uzytkownicy'])->name('uzytkownicy');
Route::get('/sprawdz-sygnaly',[ PanelAdminaController::class, 'sprawdzSygnaly'])->name('sprawdz-sygnaly');
Route::get('/zmiana-uprawnien/{status}/{id}',[ PanelAdminaController::class, 'zmiana_uprawnien'])->name('zmiana-uprawnien');

//Pary 
Route::get('/pary', [SymboleController::class, 'pairs'])->name('pairs');
Route::get('/symbole', [SymboleController::class, 'symbole'])->name('symbole');