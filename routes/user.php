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
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MpsInvestmentController;
use App\Http\Controllers\JoiningRequestController;
use App\Http\Controllers\PpsxInvestmentController;
use App\Http\Controllers\Mps36InvestmentController;
use App\Http\Controllers\Mps48InvestmentController;
use App\Http\Controllers\Mps60InvestmentController;
use App\Http\Controllers\Admin\InvestmentController as AdminInvestmentController;
Route::group(['middleware' => 'guest'],function(){


Route::get('/send_link', [RegisterController::class, 'send_link'])->name('send_link');
Route::get('/registration_link/{code}', [RegisterController::class, 'registration_link_body'])->name('registration_link');
Route::get('/confirm_link/{code}', [RegisterController::class, 'confirm_registration_link'])->name('confirm_link');
Route::get('/join_confirm_link/{code}', [RegisterController::class, 'confirm_joining_link'])->name('join_confirm_link');
Route::post('/send_link/email', [RegisterController::class, 'send_link_email'])->name('send_link.email');
Route::post('/register_through_link', [RegisterController::class, 'register_through_link'])->name('register_through_link');
Route::post('/get_parent', [RegisterController::class, 'get_parent'])->name('get_parent');
Route::get('/generate/pps_distribution', [AdminInvestmentController::class, 'pps_distribution'])->name('pps_distribution');
Route::get('/generate/pps_distribution_log', [AdminInvestmentController::class, 'pps_distribution_log'])->name('pps_distribution_log');

});
Route::group(['middleware' => ['auth','prevent-back-history']], function () {

Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/reset_passcode', [UserController::class, 'reset_passscode'])->name('reset_passscode');
Route::get('/profile/edit', [UserController::class, 'profile'])->name('profile.edit');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/report/downline_report', [ReportController::class, 'downline_report'])->name('downline_report');
Route::get('/report/mps_downline_report', [ReportController::class, 'mps_downline_report'])->name('mps_downline_report');
Route::get('/passbook', [PassbookController::class, 'passbook'])->name('passbook');
Route::post('/passbook_search', [PassbookController::class, 'passbook_search'])->name('passbook_search');
// Report Routes
Route::get('/report/referral_benefit', [ReportController::class, 'referral_benefit_report'])->name('referral_benefit_report');
Route::get('/report/pps_staking_report', [ReportController::class, 'pps_staking_report'])->name('pps_staking_report');
Route::get('/report/pps_level_report', [ReportController::class, 'pps_level_report'])->name('pps_level_report');
// End of Report Routes
//home menu section
Route::get('/self/investment', [InvestmentController::class, 'self_investment'])->name('self_investment');
Route::get('/self/report', [InvestmentController::class, 'self_report'])->name('self_report');
Route::get('/self/investment/contact_admin', [InvestmentController::class, 'self_investment_contact_admin'])->name('self_investment.contact_admin');
Route::post('/self/investment/contact_admin', [InvestmentController::class, 'self_investment_contact_admin_store'])->name('self_investment.contact_admin_store');
Route::get('/self/investment/pay', [InvestmentController::class, 'self_investment_pay'])->name('self_investment.pay');

// Route::get('/pps', [InvestmentController::class, 'pps'])->name('pps');
Route::get('/pps/index', [InvestmentController::class, 'self_investment'])->name('pps.index');
Route::post('/pps/user_validate', [InvestmentController::class, 'user_validate'])->name('pps_investment.user_validate');
Route::post('/pps/create', [InvestmentController::class, 'store'])->name('pps_investment.store');

//ppsx
Route::get('/ppsx/index', [PpsxInvestmentController::class, 'self_report'])->name('ppsx.index');
Route::post('/ppsx/user_validate', [PpsxInvestmentController::class, 'user_validate'])->name('ppsx.user_validate');
Route::post('/ppsx/create', [PpsxInvestmentController::class, 'store'])->name('ppsx_investment.store');

Route::get('/mps', [MpsInvestmentController::class, 'index'])->name('mps.index');
Route::get('/mps/create', [MpsInvestmentController::class, 'create'])->name('mps.create');
Route::post('/mps/user_validate', [MpsInvestmentController::class, 'user_validate'])->name('mps.user_validate');
Route::post('/mps/create', [MpsInvestmentController::class, 'store'])->name('mps_investment.store');
Route::get('/mps/all', [MpsInvestmentController::class, 'mps_all'])->name('mps_all');
Route::get('/mps/applied', [MpsInvestmentController::class, 'mps_applied'])->name('mps_applied');
Route::get('/mps/pending', [MpsInvestmentController::class, 'mps_pending'])->name('mps_pending');
Route::get('/mps/rejected', [MpsInvestmentController::class, 'mps_rejected'])->name('mps_rejected');

Route::get('/mps36', [Mps36InvestmentController::class, 'index'])->name('mps36.index');
Route::get('/mps36/create', [Mps36InvestmentController::class, 'create'])->name('mps36.create');
Route::post('/mps36/user_validate', [Mps36InvestmentController::class, 'user_validate'])->name('mps36.user_validate');
Route::post('/mps36/create', [Mps36InvestmentController::class, 'store'])->name('mps36_investment.store');
Route::get('/mps36/all', [Mps36InvestmentController::class, 'mps_all'])->name('mps36_all');
Route::get('/mps36/applied', [Mps36InvestmentController::class, 'mps_applied'])->name('mps36_applied');
Route::get('/mps36/pending', [Mps36InvestmentController::class, 'mps_pending'])->name('mps36_pending');
Route::get('/mps36/rejected', [Mps36InvestmentController::class, 'mps_rejected'])->name('mps36_rejected');

Route::get('/mps48', [Mps48InvestmentController::class, 'index'])->name('mps48.index');
Route::get('/mps48/create', [Mps48InvestmentController::class, 'create'])->name('mps48.create');
Route::post('/mps48/user_validate', [Mps48InvestmentController::class, 'user_validate'])->name('mps48.user_validate');
Route::post('/mps48/create', [Mps48InvestmentController::class, 'store'])->name('mps48_investment.store');
Route::get('/mps48/all', [Mps48InvestmentController::class, 'mps_all'])->name('mps48_all');
Route::get('/mps48/applied', [Mps48InvestmentController::class, 'mps_applied'])->name('mps48_applied');
Route::get('/mps48/pending', [Mps48InvestmentController::class, 'mps_pending'])->name('mps48_pending');
Route::get('/mps48/rejected', [Mps48InvestmentController::class, 'mps_rejected'])->name('mps48_rejected');
// Route::post('/mps/create', [MpsInvestmentController::class, 'store'])->name('mps_investment.store');

Route::get('/mps60', [Mps60InvestmentController::class, 'index'])->name('mps60.index');
Route::get('/mps60/create', [Mps60InvestmentController::class, 'create'])->name('mps60.create');
Route::post('/mps60/user_validate', [Mps60InvestmentController::class, 'user_validate'])->name('mps60.user_validate');
Route::post('/mps60/create', [Mps60InvestmentController::class, 'store'])->name('mps60_investment.store');
Route::get('/mps60/all', [Mps60InvestmentController::class, 'mps_all'])->name('mps60_all');
Route::get('/mps60/applied', [Mps60InvestmentController::class, 'mps_applied'])->name('mps60_applied');
Route::get('/mps60/pending', [Mps60InvestmentController::class, 'mps_pending'])->name('mps60_pending');
Route::get('/mps60/rejected', [Mps60InvestmentController::class, 'mps_rejected'])->name('mps60_rejected');

//Report to Wallet section
Route::post('/pps_wallet_transfer', [WalletController::class, 'pps_transfer_to_wallet'])->name('pps_transfer.wallet');
Route::post('/ppsx_wallet_transfer', [WalletController::class, 'ppsx_transfer_to_wallet'])->name('ppsx_transfer.wallet');
Route::post('/rld_wallet_transfer', [WalletController::class, 'rld_transfer_to_wallet'])->name('rld_transfer.wallet');
// Route::post('/pps_level_wallet_transfer', [WalletController::class, 'pps_level_transfer_to_wallet'])->name('pps_level.transfer.wallet');
Route::post('/pps_level_wallet_transfer', [WalletController::class, 'pps_level_transfer_to_wallet'])->name('pps_level_transfer');
Route::post('/ppsx_level_wallet_transfer', [WalletController::class, 'ppsx_level_transfer_to_wallet'])->name('ppsx_level_transfer');
// Route::post('/pps_level_wallet_transfer', function(Request $request){
//     dd($request->all());
//     return response()->json(['success' => 'Data is successfully added']);
// })->name('pps_level_transfer');
// End of Report to Wallet section

Route::get('/wallet', [WalletController::class, 'wallet_view'])->name('wallet');
Route::get('/main_wallet', [WalletController::class, 'main_wallet'])->name('main_wallet');
Route::get('/payment_request', [PaymentController::class, 'payment_request_view'])->name('payment_request');
Route::post('/payment_request/process', [PaymentController::class, 'payment_request_process'])->name('payment_request.process');
Route::post('/payment_request/process_new', [PaymentController::class, 'payment_request_process_new'])->name('payment_request.process_new');
Route::get('/my_team', [UserController::class, 'my_team_view'])->name('my_team');
Route::get('/joining_request', [JoiningRequestController::class, 'joining_request'])->name('joining_request');
Route::post('/send_joining_request', [JoiningRequestController::class, 'send_joining_request'])->name('send_joining_request');
Route::get('/user_level_search', [UserController::class, 'user_level_search'])->name('user.level.search');
Route::get('/tree_view', [UserController::class, 'tree_view'])->name('user.tree_view');
Route::get('/tree_view_individual', [UserController::class, 'tree_view_individual'])->name('tree_view_individual');

Route::get('/token/application', [TokenController::class, 'create'])->name('token_application.create');
Route::post('/token_application', [TokenController::class, 'store'])->name('token_application.store');


//logout
Route::get('/logout', function(){
    Auth::logout();
    return redirect('/');
})->name('logout');
});
