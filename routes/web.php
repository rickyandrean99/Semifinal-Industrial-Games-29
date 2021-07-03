<?php

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
    return redirect('/login');
});

// [COMMENT]
// Route::resource('panitias', 'PanitiaController');
// Route::resource('pesertas', 'TeamController');

// Routing Peserta
Route::middleware(['auth'])->group(function(){
    // Routing Panitia
    Route::get('/dashboard/panitia', 'PanitiaController@dashboardPanitia')->name('dashboardpanitia');
    Route::get('/pos/upgradeapp', 'PanitiaController@posRating')->name('posrating');
    Route::get('/pos/produk', 'PanitiaController@posProduk')->name('posproduk');
    Route::get('/pos/forecasting', 'PanitiaController@posForecasting')->name('posforecasting');
    Route::get('/pos/promosi', 'PanitiaController@posPromosi')->name('pospromosi');
    Route::get('/pos/wilayah', 'PanitiaController@posWilayah')->name('poswilayah');
    Route::get('/pos/bank', 'PanitiaController@miniGames')->name('minigames');
    Route::get('/pos/inputcustomer', 'PanitiaController@inputCustomer')->name('inputcustomer');
    Route::get('/pos/franchise', 'PanitiaController@franchise')->name('franchise');
    Route::get('/pos/updatesiklus', 'PanitiaController@updateSiklus')->name('updatesiklus');
    Route::get('/pos/mapwilayah', 'PanitiaController@mapWilayah')->name('mapWilayah');
    Route::get('/pos/customerlist', 'PanitiaController@customerList')->name('customerlist');

    // Routing Peserta
    Route::get('/dashboard', 'TeamController@dashboard')->name('dashboardpeserta');
    Route::get('/modalawal', 'TeamController@modalAwal')->name('modalawal');
    Route::get('/forecast', 'TeamController@forecast')->name('forecast');
    Route::get('/app', 'TeamController@app')->name('app');
});

// Routing Ajax Request
Route::post('/team/konsultasi', 'TeamController@konsultasi')->name('team.konsultasi');
Route::post('/team/upgradeLevel', 'TeamController@upgradeLevel')->name('team.upgradeapplication');
Route::post('/team/pinjambank', 'TeamController@pinjamBank')->name('team.pinjambank');
Route::post('/team/bayarbank', 'TeamController@bayarBank')->name('team.bayarbank');
Route::post('/team/inputforecast', 'TeamController@inputForecast')->name('team.inputforecast');
Route::post('/team/inputpromosi', 'TeamController@inputPromosi')->name('team.inputpromosi');
Route::post('/team/inputproduk', 'TeamController@inputProduk')->name('team.inputproduk');
Route::post('/team/klaimwilayah', 'TeamController@klaimWilayah')->name('team.klaimwilayah');
Route::post('/team/rebutwilayah', 'TeamController@rebutWilayah')->name('team.rebutwilayah');
Route::post('/team/showteampromotion', 'TeamController@showTeamPromotion')->name('team.showteampromotion');
Route::post('/team/showdebt', 'TeamController@showDebt')->name('team.showdebt');
Route::post('/team/inputmodalawal', 'TeamController@inputModalAwal')->name('team.inputmodalawal');
Route::post('/team/cekmodalawal', 'TeamController@cekModalAwal')->name('team.cekmodalawal');
Route::post('/team/realtimemap', 'TeamController@realTimeMap')->name('team.realtimemap');
Route::post('/team/realtimeplayerdetail', 'TeamController@realTimePlayerDetail')->name('team.realtimeplayerdetail');
Route::post('/team/realtimecustomer', 'TeamController@realTimeCustomer')->name('team.realtimecustomer');
Route::post('/team/inputclaimcustomer', 'TeamController@inputClaimCustomer')->name('team.inputclaimcustomer');
Route::post('/team/showhistory', 'TeamController@showHistory')->name('team.showhistory');
Route::post('/team/upgradeapp', 'TeamController@upgradeApp')->name('team.upgradeapp');
Route::post('/panitia/updatesiklustimer', 'PanitiaController@updateSiklusTimer')->name('panitia.updatesiklustimer');
Route::post('/panitia/gettimer', 'PanitiaController@getTimer')->name('panitia.gettimer');
Route::post('/team/getproductteamdetail', 'TeamController@getProductTeamDetail')->name('team.getproductteamdetail');
Route::post('/team/sellproductcompetitor', 'TeamController@sellProductCompetitor')->name('team.sellproductcompetitor');
Route::post('/team/openfranchise', 'TeamController@openFranchise')->name('team.openfranchise');
Route::post('/team/realtimeproduk', 'TeamController@realTimeProduk')->name('team.realtimeproduk');
Route::post('/panitia/updatehargaproduk', 'PanitiaController@updateHargaProduk')->name('panitia.updatehargaproduk');

// Auth::routes();
Auth::routes(['register' => false]);
Route::get('/home', 'HomeController@index')->name('home');