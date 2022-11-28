<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\SchemeController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\InvestmentController;
use App\Http\Controllers\Admin\MpsInvestmentController;
use App\Http\Controllers\Admin\Mps36InvestmentController;
use App\Http\Controllers\Admin\Mps48InvestmentController;
use App\Http\Controllers\Admin\Mps60InvestmentController;
use App\Http\Controllers\Admin\PpsxInvestmentController;

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
//ppsx investment section
    Route::get('/ppsx', [PpsxInvestmentController::class, 'investment'])->name('ppsx');
 Route::get('/ppsx/index', [PpsxInvestmentController::class, 'investment_index'])->name('ppsx_index');
 Route::get('/ppsx/all', [PpsxInvestmentController::class, 'investment_all'])->name('ppsx_all');
 Route::get('/ppsx/pending', [PpsxInvestmentController::class, 'investment_pending'])->name('ppsx_pending');
 Route::get('/ppsx/rejected', [PpsxInvestmentController::class, 'investment_rejected'])->name('ppsx_rejected');

    Route::post('/ppsx/store', [PpsxInvestmentController::class, 'investment_store'])->name('ppsx.store');
    Route::post('/ppsx_user/validate', [PpsxInvestmentController::class, 'user_validate'])->name('ppsx.user_validate');
    Route::post('/ppsx/acknowledge', [PpsxInvestmentController::class, 'investment_acknowledge'])->name('ppsx.acknowledge');


//=======MPS =====================
    Route::get('/mps', [MpsInvestmentController::class, 'mps'])->name('mps');
    Route::get('/mps/index', [MpsInvestmentController::class, 'mps_index'])->name('mps_index');
    Route::get('/mps/all', [MpsInvestmentController::class, 'mps_all'])->name('mps_all');
    Route::get('/mps/pending', [MpsInvestmentController::class, 'mps_pending'])->name('mps_pending');
    Route::get('/mps/rejected', [MpsInvestmentController::class, 'mps_rejected'])->name('mps_rejected');

    Route::post('/mps/store', [MpsInvestmentController::class, 'mps_store'])->name('mps.store');
    Route::post('/mps_user/validate', [MpsInvestmentController::class, 'user_validate'])->name('mps.user_validate');
    Route::post('/mps/acknowledge', [MpsInvestmentController::class, 'mps_acknowledge'])->name('mps.acknowledge');

    //=======MPS36 =====================
    Route::get('/mps36', [Mps36InvestmentController::class, 'mps36'])->name('mps36');
    Route::get('/mps36/index', [Mps36InvestmentController::class, 'mps36_index'])->name('mps36_index');
    Route::get('/mps36/all', [Mps36InvestmentController::class, 'mps36_all'])->name('mps36_all');
    Route::get('/mps36/pending', [Mps36InvestmentController::class, 'mps36_pending'])->name('mps36_pending');
    Route::get('/mps36/rejected', [Mps36InvestmentController::class, 'mps36_rejected'])->name('mps36_rejected');

    Route::post('/mps36/store', [Mps36InvestmentController::class, 'mps36_store'])->name('mps36.store');
    Route::post('/mps36_user/validate', [Mps36InvestmentController::class, 'user_validate'])->name('mps36.user_validate');
    Route::post('/mps36/acknowledge', [Mps36InvestmentController::class, 'mps36_acknowledge'])->name('mps36.acknowledge');


     //=======MPS48 =====================
     Route::get('/mps48', [Mps48InvestmentController::class, 'mps48'])->name('mps48');
     Route::get('/mps48/index', [Mps48InvestmentController::class, 'mps48_index'])->name('mps48_index');
     Route::get('/mps48/all', [Mps48InvestmentController::class, 'mps48_all'])->name('mps48_all');
     Route::get('/mps48/pending', [Mps48InvestmentController::class, 'mps48_pending'])->name('mps48_pending');
     Route::get('/mps48/rejected', [Mps48InvestmentController::class, 'mps48_rejected'])->name('mps48_rejected');

     Route::post('/mps48/store', [Mps48InvestmentController::class, 'mps48_store'])->name('mps48.store');
     Route::post('/mps48_user/validate', [Mps48InvestmentController::class, 'user_validate'])->name('mps48.user_validate');
     Route::post('/mps48/acknowledge', [Mps48InvestmentController::class, 'mps48_acknowledge'])->name('mps48.acknowledge');
     //=======MPS60 =====================
     Route::get('/mps60', [Mps60InvestmentController::class, 'mps60'])->name('mps60');
     Route::get('/mps60/index', [Mps60InvestmentController::class, 'mps60_index'])->name('mps60_index');
     Route::get('/mps60/all', [Mps60InvestmentController::class, 'mps60_all'])->name('mps60_all');
     Route::get('/mps60/pending', [Mps60InvestmentController::class, 'mps60_pending'])->name('mps60_pending');
     Route::get('/mps60/rejected', [Mps60InvestmentController::class, 'mps60_rejected'])->name('mps60_rejected');

     Route::post('/mps60/store', [Mps60InvestmentController::class, 'mps60_store'])->name('mps60.store');
     Route::post('/mps60_user/validate', [Mps60InvestmentController::class, 'user_validate'])->name('mps60.user_validate');
     Route::post('/mps60/acknowledge', [Mps60InvestmentController::class, 'mps60_acknowledge'])->name('mps60.acknowledge');


    Route::get('/generate/pps_distribution', [InvestmentController::class, 'pps_distribution'])->name('pps_distribution');
    Route::get('/generate/pps_distribution_log', [InvestmentController::class, 'pps_distribution_log'])->name('pps_distribution_log');
    Route::get('/generate/ppsx_distribution', [PpsxInvestmentController::class, 'ppsx_distribution'])->name('ppsx_distribution');
    Route::get('/generate/ppsx_distribution_log', [PpsxInvestmentController::class, 'ppsx_distribution_log'])->name('ppsx_distribution_log');


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
