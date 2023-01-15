<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PassbookController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\Admin\InvestmentController as AdminInvestmentController;
use App\Http\Controllers\Auth\RegisterController;

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


Route::group(['middleware' => ['guest','guest:admin']],function(){
    Route::get('/',function(){
        //return view('maintenance');
         return view('landing');
    })->name('landing');
    // Route::get('/', function () {
    //     return redirect()->route('login');
    // }) ;
    Route::post('/setLoginSession', [LoginController::class, 'setLoginSession'])->name('setLoginSession');
    Route::post('/notify', [LoginController::class, 'notify'])->name('notify');
    Route::get('/login', function () {
        return view('landing');
    })->name('login') ;
    Route::group(['prefix'=>'admin','as'=>'admin.'], function () {
        Route::get('/login', function () {
               return view('landing');
           })->name('login.create');
           Route::get('/', function () {
            return redirect()->route('admin.login.create');
        });
           });
           Auth::routes();

});

require __DIR__.'/adminauth.php';
require __DIR__.'/user.php';




//cache clear
Route::get('/clear_cache', function() {
    $exitCode = Artisan::call('cache:clear');
    return 'Cache is cleared';
});
//storage link
Route::get('/storage_link', function() {
    $exitCode = Artisan::call('storage:link');
    return 'Storage is linked';
});
//migrate
Route::get('/migrate', function() {
    $exitCode = Artisan::call('migrate');
    return 'Migration is done';
});
