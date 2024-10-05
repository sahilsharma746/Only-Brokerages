<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\User\UserHomeController;
use App\Http\Controllers\User\UserTradeController;

use App\Http\Controllers\Admin\AdminHomeController;

use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\User\UserDepositController;
use App\Http\Controllers\User\UserProfileController;
use App\Http\Controllers\User\UserUpgradeController;
use App\Http\Controllers\Admin\AdminAssetsController;
use App\Http\Controllers\Admin\AdminTradesController;
use App\Http\Controllers\User\UserWithdrawController;
use App\Http\Controllers\Admin\AdminDepositController;
use App\Http\Controllers\User\UserPersoanlInformation;

use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\AdminSoftwareController;
use App\Http\Controllers\Admin\AdminWithdrawController;
use App\Http\Controllers\User\UserMarktWatchController;
use App\Http\Controllers\Admin\AdminIdentyVerificationController;


Auth::routes();

Route::get('/reboot', function () {
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    Artisan::call('view:cache');
    // composer dump-autoload
});

Route::get('/send-test-email', function () {
    $toEmail = 'sharmasahil00746@gmail.com'; // Replace with the recipient's email address

    Mail::raw('This is a simple test email sent from Laravel.', function ($message) use ($toEmail) {
        $message->to($toEmail)
                ->subject('Test Email from Laravel');
    });

    return 'Email has been sent!';
});


Auth::routes(['reset' => true]);

// home page route 
Route::get('/home', [HomeController::class, 'index'])->name('home');

// lending page route
Route::get('/', [FrontendController::class, 'index'])->name('frontend.index');

// about us page route
Route::get('/about-us', [FrontendController::class, 'about'])->name('frontend.about');

// account plans page route
Route::get('/account-plan', [FrontendController::class, 'accountPlan'])->name('frontend.accountPlan');

// FAQ page route
Route::get('/faq', [FrontendController::class, 'faq'])->name('frontend.faq');

// contact us page route 
Route::get('/contact', [FrontendController::class, 'contact'])->name('frontend.contact');

// Route for saving the users contact page message 
Route::post('/contact', [FrontendController::class, 'message'])->name('contact.store');



// frontend users dashboard urls 
Route::group(['prefix' => 'user', 'middleware' => ['auth', 'is_user']], function () {
    
    // route for the user dashboard 
    Route::get('/dashboard', [UserHomeController::class, 'index'])->name('user.dashboard');

    
    // route for the user dashboard deposits
    Route::get('/deposit-method', [UserDepositController::class, 'index'])->name('user.deposit.getway');
    Route::get('/deposit-method/{plan_id}', [UserDepositController::class, 'index'])->name('user.upgrade.plan');

    // Route::post('upgrade-plan/{plan_id}', [UserUpgradeController::class, 'UpgradeUserPlan'])->name('user.upgrade.plan');

    // route to store the deposites by bitcoin , USDT and XMR
    Route::post('/deposit-store/{id}', [UserDepositController::class, 'storeUserDeposit'])->name('user.deposit.store');

    // route to send the email for deposites by paypal and bank transfer
    Route::get('/deposit-transfer/{id}', [UserDepositController::class, 'sendUserDepositTransferEmail'])->name('user.deposit.transfer');

    // route to update the user pass form user dashboard
    Route::post('/update-password', [UserProfileController::class, 'updatePassword'])->name('user.profile.updatePassword');
    
    // route to update the user setting like currency and langusage form user dashboard
    Route::post('/update-settings', [UserProfileController::class, 'updateSettings'])->name('user.profile.update');

    // route to update the user profile image form user dashboard
    Route::post('/avatar', [UserProfileController::class, 'avatarUpdate'])->name('user.profile.avatarUpdate');

    // route to update the user personal info form user dashboard
    Route::post('/persoanl-information', [UserProfileController::class, 'personalInfoUpdate'])->name('user.personal.info.update');

    // route for all the user withdrawls and request withdrawl
    Route::get('/withdraw', [UserWithdrawController::class, 'index'])->name('user.withdraw.index');
 
     // route for handling withdrawl request
    Route::post('/save-withdraw', [UserWithdrawController::class, 'SaveUserWithdrawlRequest'])->name('user.withdraw.store');

    // route to restore the admin if admin is logged in as user 
    Route::get('/admin-restore', [UserProfileController::class, 'restoreAdmin'])->name('user.admin.restore');

    // route to save the user kyc docs 
    Route::post('/save-kyc-documents', [UserProfileController::class, 'saveKycDocuments'])->name('user.save.kyc');

    // route to  user dashboard trade page
    Route::get('/trade', [UserTradeController::class, 'index'])->name('user.trade.index');

    Route::post('/trade-store', [UserTradeController::class, 'storeTrades'])->name('user.trade.store');

    Route::get('trading-history', [UserTradeController::class, 'tradingHistoryView'])->name('users.trading-history.index');

    Route::get('/generate-pdf', [UserTradeController::class, 'generatePDF'])->name('users.trading-history-download-pdf');
    
    Route::get('trading-bots', [UserTradeController::class, 'tradingBotsView'])->name('users.trading-bots.index');


    
    
    Route::get('/market-news', [UserHomeController::class, 'news'])->name('user.market.news');
    // Route::post('/verification', [UserProfileController::class, 'verificationUpdate'])->name('user.profile.verificationUpdate');
    Route::get('/market-watch', [UserMarktWatchController::class, 'index'])->name('user.marketWatch.index');


    Route::get('upgrade', [UserUpgradeController::class, 'index'])->name('user.upgrade.index');

    
    // Route::post('upgrade-plan/{plan_id}', [UserUpgradeController::class, 'UpgradeUserPlan'])->name('user.upgrade.plan');

});



// Backend admin dashboard urls 
// admin tn URL 
Route::get('/admin', [AdminHomeController::class, 'adminLogin'])->name('admin.login');

Route::group(['prefix' => 'admin', 'middleware' => ['is_admin']], function () {

    // admin main dashboard view url 
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('admin.dashboard');


    
    // admin all users dashboard view url 
    Route::get('/all-user', [AdminUserController::class, 'index'])->name('admin.user.index');

    Route::post('/change-plan/{user}', [AdminUserController::class, 'changeUserPlan'])->name('admin.user.change-plan');

    // admin all active users dashboard view url 
    Route::get('/active-users', [AdminUserController::class, 'activeUsers'])->name('admin.user.activeUsers');
    
    // admin all kyc unverified users dashboard view url 
    Route::get('/kyc-unverified', [AdminUserController::class, 'kycUnverified'])->name('admin.user.kycUnverified');
    
    // admin all kyc verified users dashboard view url 
    Route::get('/kyc-verified', [AdminUserController::class, 'kycVerified'])->name('admin.user.kycVerified');
    
    // admin all email verified users dashboard view url 
    Route::get('/email-verified', [AdminUserController::class, 'emailVerified'])->name('admin.user.emailVerified');
    
    // admin all phone verified users dashboard view url 
    Route::get('/phone-verified', [AdminUserController::class, 'phoneVerified'])->name('admin.user.phoneVerified');
    
    // admin all banned verified users dashboard view url 
    Route::get('/banned-users', [AdminUserController::class, 'bannedVerified'])->name('admin.user.bannedVerified');

    // admin all banned verified users dashboard view url 
    Route::post('/kyc-admin-action/{user}', [AdminUserController::class, 'kycAdminAction'])->name('admin.kyc.action');

    Route::post('/admin-prompt/{user}', [AdminUserController::class, 'AdminPrompt'])->name('admin.prompt');



    // admin dashbopard user details view
    Route::get('/details/{user}', [AdminUserController::class, 'details'])->name('admin.user.details');
    
    // admin update user payment details
    Route::post('/edit-payments/{user}', [AdminUserController::class, 'editUserPaymentSettings'])->name('admin.user.payments');

    // admin balance update view
    Route::get('/edit-balance/{user}', [AdminUserController::class, 'editBalance'])->name('admin.user.editBalance');
    
     // admin balance update post request handle
    Route::post('/update-balance/{user}', [AdminUserController::class, 'updateBalance'])->name('admin.user.updateBalance');

    //subtract the amoun from user accoun by admin
    Route::post('/subtract-balanace/{user}', [AdminUserController::class, 'AddsubtractBlanace'])->name('admin.user.AddsubtractBlanace');
    
    // admin ban user 
    Route::get('/ban-user/{user}', [AdminUserController::class, 'banUser'])->name('admin.user.banUser');
    
    // admin un ban user 
    Route::get('/un-ban-user/{user}', [AdminUserController::class, 'UnbanUser'])->name('admin.user.unBanUser');

    // admin delete user 
    Route::get('/deleteUser/{user}', [AdminUserController::class, 'deleteUser'])->name('admin.user.deleteUser');

    // Admin login as a normal user form admin dashbord
    Route::get('/login-as-user/{user}', [AdminUserController::class, 'loginAsUser'])->name('admin.login-as-user');



    // Admin deposit screen routes
    Route::get('/deposits', [AdminDepositController::class, 'getAllDeposits'])->name('admin.deposit.index');
    Route::get('/deposit/pending', [AdminDepositController::class, 'getPendingDeposits'])->name('admin.deposit.pending');
    Route::get('/deposit/approved', [AdminDepositController::class, 'getApprovedDeposits'])->name('admin.deposit.approved');
    Route::get('/deposit/rejected', [AdminDepositController::class, 'getRejectedDeposits'])->name('admin.deposit.rejected');
    Route::get('/deposit/{id}/approved', [AdminDepositController::class, 'approvedDepositStatus'])->name('admin.deposit.approved.status');
    Route::get('/deposit/{id}/rejected', [AdminDepositController::class, 'rejectedDepositStatus'])->name('admin.deposit.rejected.status');
    Route::get('/deposit/{id}/delete', [AdminDepositController::class, 'deleteDeposit'])->name('admin.deposit.delete');
    Route::get('/deposit/{id}/download', [AdminDepositController::class, 'downloadDeposit'])->name('admin.deposit.download');


    // Admin Withdrawls screen routes
    Route::get('/withdraw', [AdminWithdrawController::class, 'getAllWithDrawls'])->name('admin.withdraw.index');
    Route::get('/withdraw/pending', [AdminWithdrawController::class, 'getPendingWithDrawls'])->name('admin.withdraw.pending');
    Route::get('/withdraw/approved', [AdminWithdrawController::class, 'getApprovedWithDrawls'])->name('admin.withdraw.approved');
    Route::get('/withdraw/rejected', [AdminWithdrawController::class, 'getRejectedWithDrawls'])->name('admin.withdraw.rejected');
    Route::get('/withdraw/{id}/approved', [AdminWithdrawController::class, 'approvedWithDrawlStatus'])->name('admin.withdraw.approved.status');
    Route::get('/withdraw/{id}/rejected', [AdminWithdrawController::class, 'rejectedWithDrawlStatus'])->name('admin.withdraw.rejected.status');
    Route::get('/withdraw/{id}/delete', [AdminWithdrawController::class, 'deleteWithDrawl'])->name('admin.withdraw.delete');


    // Admin dashboard trades screen 
    Route::get('/trades', [AdminTradesController::class, 'getAllTrades'])->name('admin.trades');

    Route::post('/trades-result/{user_id}', [AdminTradesController::class, 'saveTradeResult'])->name('admin.trades.result');


    // admin delete trade  
    Route::get('/delete-trade/{trade_id}', [AdminTradesController::class, 'deleteTrade'])->name('admin.trade.delete');

    // Admin dashboard assets screen 
    Route::get('/assets', [AdminAssetsController::class, 'getAllAssets'])->name('admin.assets');

    
    // Admin dashboard software screen 
    Route::get('/software', [AdminSoftwareController::class, 'getSoftwares'])->name('admin.software');


    // Admin dashboard admin settings screen 
    Route::get('/general-settings', [AdminSettingsController::class, 'getAdminGeneralSettings'])->name('admin.general.settings');
    Route::get('/system-settings', [AdminSettingsController::class, 'getAdminSystemSettings'])->name('admin.system.settings');




    // Admin kyc verification screen routes
    Route::get('/verification', [AdminIdentyVerificationController::class, 'index'])->name('admin.identyVerification.index');
    Route::get('/verification/pending', [AdminIdentyVerificationController::class, 'pending'])->name('admin.identyVerification.pending');
    Route::get('/verification/approved', [AdminIdentyVerificationController::class, 'approved'])->name('admin.identyVerification.approved');
    Route::get('/verification/rejected', [AdminIdentyVerificationController::class, 'rejected'])->name('admin.identyVerification.rejected');
    Route::get('/verification/{id}/approvedStatus', [AdminIdentyVerificationController::class, 'approvedStatus'])->name('admin.identification.approvedStatus');
    Route::get('/verification/{id}/rejectedStatus', [AdminIdentyVerificationController::class, 'rejectedStatus'])->name('admin.identification.rejectedStatus');
    Route::get('/verification/{id}/delete', [AdminIdentyVerificationController::class, 'delete'])->name('admin.identification.delete');

});


