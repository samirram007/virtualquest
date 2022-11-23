<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SchemeController;
use App\Http\Controllers\Admin\MpsInvestmentController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\InvestmentController;

Route::group(['middleware' =>['guest:admin' ],'prefix'=>'admin','as'=>'admin.'], function () {

// Route::get('register', [RegisteredUserController::class, 'create'])
//             ->name('register');

// Route::post('register', [RegisteredUserController::class, 'store']);

Route::post('login', [LoginController::class, 'login'])->name('login.store');

// Route::post('login', [AuthenticatedSessionController::class, 'store']);

// Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
//             ->name('password.request');

// Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
//             ->name('password.email');

// Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
//             ->name('password.reset');

// Route::post('reset-password', [NewPasswordController::class, 'store'])
//             ->name('password.update');
});


//==========================================================================================================================
//========================== auth:admin ====================================================================================
//==========================================================================================================================
Route::group(['middleware' =>['auth:admin'],'prefix'=>'admin','as'=>'admin.'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Scheme section
    Route::get('/schemes', [SchemeController::class, 'index'])->name('scheme_index');
    Route::get('/schemes/create', [SchemeController::class, 'create'])->name('scheme_create');
    Route::post('/schemes_store', [SchemeController::class, 'store'])->name('scheme_store');
    Route::get('/schemes/edit/{scheme}', [SchemeController::class, 'edit'])->name('scheme_edit');
    Route::post('/schemes_update/{scheme}', [SchemeController::class, 'update'])->name('scheme_update');
    Route::post('/schemes/{scheme}', [SchemeController::class, 'destroy'])->name('scheme_delete');
    Route::get('/scheme_referral_commission/{scheme}', [SchemeController::class, 'scheme_referral_commission'])->name('scheme_referral_commission');
    Route::get('/scheme_pps_level_commission/{scheme}', [SchemeController::class, 'scheme_pps_level_commission'])->name('scheme_pps_level_commission');
    Route::post('/referral_commision_store/{scheme}', [SchemeController::class, 'referral_commision_store'])->name('referral_commision_store');
    Route::post('/pps_level_commision_store/{scheme}', [SchemeController::class, 'pps_level_commision_store'])->name('pps_level_commision_store');



 //home menu section
 Route::get('/investment', [InvestmentController::class, 'investment'])->name('investment');
 Route::get('/investment/index', [InvestmentController::class, 'investment_index'])->name('investment_index');
 Route::get('/investment/all', [InvestmentController::class, 'investment_all'])->name('investment_all');
 Route::get('/investment/pending', [InvestmentController::class, 'investment_pending'])->name('investment_pending');
 Route::get('/investment/rejected', [InvestmentController::class, 'investment_rejected'])->name('investment_rejected');

    Route::post('/investment/store', [InvestmentController::class, 'investment_store'])->name('investment.store');
    Route::post('/user/validate', [InvestmentController::class, 'user_validate'])->name('investment.user_validate');
    Route::post('/investment/acknowledge', [InvestmentController::class, 'investment_acknowledge'])->name('investment.acknowledge');

//=======MPS =====================
    Route::get('/mps', [MpsInvestmentController::class, 'mps'])->name('mps');
    Route::get('/mps/index', [MpsInvestmentController::class, 'mps_index'])->name('mps_index');
    Route::get('/mps/all', [MpsInvestmentController::class, 'mps_all'])->name('mps_all');
    Route::get('/mps/pending', [MpsInvestmentController::class, 'mps_pending'])->name('mps_pending');
    Route::get('/mps/rejected', [MpsInvestmentController::class, 'mps_rejected'])->name('mps_rejected');

       Route::post('/mps/store', [MpsInvestmentController::class, 'mps_store'])->name('mps.store');
       Route::post('/mps_user/validate', [MpsInvestmentController::class, 'user_validate'])->name('mps.user_validate');
       Route::post('/mps/acknowledge', [MpsInvestmentController::class, 'mps_acknowledge'])->name('mps.acknowledge');


    Route::get('/generate/pps_distribution', [InvestmentController::class, 'pps_distribution'])->name('pps_distribution');
    Route::get('/generate/pps_distribution_log', [InvestmentController::class, 'pps_distribution_log'])->name('pps_distribution_log');


    Route::get('/report/downline', [ReportController::class, 'downline_report'])->name('downline_report');
    Route::get('/report/referral_benefit', [ReportController::class, 'referral_benefit_report'])->name('referral_benefit_report');
    Route::get('/payment_request_process', [ReportController::class, 'payment_request_process'])->name('payment_request_process');
    Route::get('/status_form', [ReportController::class, 'status_form'])->name('status_form');
    Route::post('/status/change', [ReportController::class, 'payment_status_change'])->name('payment.status');
    Route::get('/desk_query', [ReportController::class, 'desk_query'])->name('desk_query');



        //logout
        Route::get('/logout', function(){
            Auth::guard('admin')->logout();
            return redirect('/admin/login');
        })->name('logout');
});
