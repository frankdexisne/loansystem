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
use Illuminate\Support\Facades\Storage;
Route::get('/', function () {
    return redirect()->route('login');
    // $path = base_path().'\\storage\\app\\LoanSystem';
    // $files = scandir($path, SCANDIR_SORT_DESCENDING);
    // $newest_file = $files[0];
    // $data = [];
    // Mail::send('system.email_message',$data, function($message) use($newest_file){
    //     $message->to('frankdexisne1692@gmail.com','Frankly Dexisne')->subject(env('MAIL_SUBJECT'));
    //     $message->from(env('MAIL_USERNAME'),env('MAIL_NAME'));
    //     $message->attachData($newest_file, "backup.pdf");
    // });
});
Route::resource('branches',App\Http\Controllers\Loans\BranchController::class);
Route::post('branches/submit-fund',[App\Http\Controllers\Loans\BranchController::class,'submit_fund'])->name('branches.submit_fund');
Route::resource('relationships',App\Http\Controllers\Loans\RelationshipController::class);
Route::resource('statuses',App\Http\Controllers\Loans\StatusController::class);
Route::resource('categories',App\Http\Controllers\Loans\CategoryController::class);
Route::resource('terms',App\Http\Controllers\Loans\TermController::class);
Route::resource('payment-modes',App\Http\Controllers\Loans\PaymentModeController::class);
Route::resource('expense-types',App\Http\Controllers\Loans\ExpenseTypeController::class);
Route::resource('charges',App\Http\Controllers\Loans\ChargeController::class);

Route::resource('areas',App\Http\Controllers\Loans\AreaController::class);
Route::get('areas/get-name/{branch_id}',[App\Http\Controllers\Loans\AreaController::class,'getNewAreaName'])->name('areas.getName');
Route::resource('clients',App\Http\Controllers\Loans\ClientController::class);
Route::put('clients/beneficiary/{client_id}',[App\Http\Controllers\Loans\ClientController::class,'beneficiary_update'])->name('clients.beneficiary_update');
Route::put('clients/co-maker/{client_id}',[App\Http\Controllers\Loans\ClientController::class,'co_maker_update'])->name('clients.co_maker_update');
Route::resource('expenses',App\Http\Controllers\Loans\ExpenseController::class);

Route::resource('employees',App\Http\Controllers\Payroll\EmployeeController::class);
Route::resource('job-titles',App\Http\Controllers\Payroll\JobTitleController::class);

Route::resource('users',App\Http\Controllers\System\UserController::class);
Route::post('/users/reset-password/{id}',[App\Http\Controllers\System\UserController::class,'resetPassword'])->name('users.resetPassword');

Route::get('/loans/view-for-approval',[App\Http\Controllers\Loans\LoanController::class,'view_for_approval'])->name('loans.view-for-approval');
Route::get('/loans/view-approved',[App\Http\Controllers\Loans\LoanController::class,'view_approved'])->name('loans.view-approved');
Route::get('/loans/view-for-release',[App\Http\Controllers\Loans\LoanController::class,'view_for_release'])->name('loans.view-for-release');
Route::get('/loans/view-released',[App\Http\Controllers\Loans\LoanController::class,'view_released'])->name('loans.view-released');

Route::resource('loans',App\Http\Controllers\Loans\LoanController::class);
Route::post('loans/approval',[App\Http\Controllers\Loans\LoanController::class,'approval'])->name('loans.approval');
Route::post('loans/for-release',[App\Http\Controllers\Loans\LoanController::class,'for_release'])->name('loans.for-release');
Route::post('loans/release',[App\Http\Controllers\Loans\LoanController::class,'release'])->name('loans.release');



Route::get('loans/voucher/{id}',[App\Http\Controllers\Loans\LoanController::class,'voucher'])->name('loans.voucher');
Route::get('loans/soa/{id}',[App\Http\Controllers\Loans\LoanController::class,'soa'])->name('loans.soa');

Route::get('/loans/sales-monitoring-pdf/{payment_mode_id}/{date}',[App\Http\Controllers\Loans\LoanController::class,'sales_monitoring_pdf'])->name('loans.sales_monitoring_pdf');
Route::get('/loans/collection-report-pdf/{payment_mode_id}/{date}',[App\Http\Controllers\Loans\LoanController::class,'collection_report_pdf'])->name('loans.collection_report_pdf');

Route::get('/remittances/json-payments',[App\Http\Controllers\Loans\RemittanceController::class,'jsonPayment'])->name('remittances.jsonPayment');
Route::resource('remittances',App\Http\Controllers\Loans\RemittanceController::class);

Route::resource('payments',App\Http\Controllers\Loans\PaymentController::class);
Route::resource('deposits',App\Http\Controllers\Loans\DepositController::class);
Route::resource('withdraws',App\Http\Controllers\Loans\WithdrawController::class);


Route::post('employees/add-user',[App\Http\Controllers\Payroll\EmployeeController::class,'addUser'])->name('employees.addUser');
Route::post('employees/assign',[App\Http\Controllers\Payroll\EmployeeController::class,'assign'])->name('employees.assign');
Route::post('users/assign-role',[App\Http\Controllers\System\UserController::class,'assignRole'])->name('users.assign-role');

Route::get('/reports/note-collection-report',[App\Http\Controllers\Loans\ReportController::class,'ncr'])->name('reports.ncr');
Route::get('/reports/target-performance-report',[App\Http\Controllers\Loans\ReportController::class,'tpr'])->name('reports.tpr');
Route::get('/reports/collection-report',[App\Http\Controllers\Loans\ReportController::class,'cr'])->name('reports.cr');
Route::get('/reports/sales-report',[App\Http\Controllers\Loans\ReportController::class,'sr'])->name('reports.sr');
Route::get('/reports/loan-report',[App\Http\Controllers\Loans\ReportController::class,'lr'])->name('reports.lr');
Route::get('/reports/withdrawal-report',[App\Http\Controllers\Loans\ReportController::class,'wr'])->name('reports.wr');
Route::get('/reports/expense-report',[App\Http\Controllers\Loans\ReportController::class,'er'])->name('reports.er');
Route::get('/reports/closing-report',[App\Http\Controllers\Loans\ReportController::class,'closing_report'])->name('reports.closing_report');

Route::get('/reports/note-collection-report-json',[App\Http\Controllers\Loans\ReportController::class,'ncr_json'])->name('reports.ncr-json');
Route::get('/reports/target-performance-report-json',[App\Http\Controllers\Loans\ReportController::class,'tpr_json'])->name('reports.tpr-json');
Route::get('/reports/collection-report-json',[App\Http\Controllers\Loans\ReportController::class,'cr_json'])->name('reports.cr-json');
Route::get('/reports/sales-report-json',[App\Http\Controllers\Loans\ReportController::class,'sr_json'])->name('reports.sr-json');
Route::get('/reports/loan-report-json',[App\Http\Controllers\Loans\ReportController::class,'lr_json'])->name('reports.lr-json');
Route::get('/reports/withdrawal-report-json',[App\Http\Controllers\Loans\ReportController::class,'wr_json'])->name('reports.wr-json');
Route::get('/reports/expense-report-json',[App\Http\Controllers\Loans\ReportController::class,'er_json'])->name('reports.er-json');

Route::resource('reports',App\Http\Controllers\Loans\ReportController::class);

Route::resource('daily-transactions',App\Http\Controllers\Loans\DailyTransactionController::class);

Route::get('/references', function () {
    
    
    return view('references.index');
})->name('references.index');

// JSON DATA
Route::get('branches-json',[App\Http\Controllers\Loans\BranchController::class,'jsonData'])->name('branches.jsonData');
Route::get('relationships-json',[App\Http\Controllers\Loans\RelationshipController::class,'jsonData'])->name('relationships.jsonData');
Route::get('statuses-json',[App\Http\Controllers\Loans\StatusController::class,'jsonData'])->name('statuses.jsonData');
Route::get('categories-json',[App\Http\Controllers\Loans\CategoryController::class,'jsonData'])->name('categories.jsonData');
Route::get('terms-json',[App\Http\Controllers\Loans\TermController::class,'jsonData'])->name('terms.jsonData');
Route::get('payment-modes-json',[App\Http\Controllers\Loans\PaymentModeController::class,'jsonData'])->name('payment-modes.jsonData');
Route::get('expense-types-json',[App\Http\Controllers\Loans\ExpenseTypeController::class,'jsonData'])->name('expense-types.jsonData');
Route::get('charges-json',[App\Http\Controllers\Loans\ChargeController::class,'jsonData'])->name('charges.jsonData');

Route::get('areas-json',[App\Http\Controllers\Loans\AreaController::class,'jsonData'])->name('areas.jsonData');
Route::get('clients-json',[App\Http\Controllers\Loans\ClientController::class,'jsonData'])->name('clients.jsonData');
Route::get('expenses-json',[App\Http\Controllers\Loans\ExpenseController::class,'jsonData'])->name('expenses.jsonData');

Route::get('employees-json',[App\Http\Controllers\Payroll\EmployeeController::class,'jsonData'])->name('employees.jsonData');
Route::get('job-titles-json',[App\Http\Controllers\Payroll\JobTitleController::class,'jsonData'])->name('job-titles.jsonData');

Route::get('users-json',[App\Http\Controllers\System\UserController::class,'jsonData'])->name('users.jsonData');

Route::get('loans-json',[App\Http\Controllers\Loans\LoanController::class,'jsonData'])->name('loans.jsonData');
Route::post('loans-releases-json',[App\Http\Controllers\Loans\LoanController::class,'jsonDataGetReleases'])->name('loans.jsonDataGetReleases');
Route::get('loans-active-json',[App\Http\Controllers\Loans\LoanController::class,'jsonActiveLoans'])->name('loans.jsonActiveLoans');
Route::get('payments-json',[App\Http\Controllers\Loans\PaymentController::class,'jsonData'])->name('payments.jsonData');
Route::get('deposits-json',[App\Http\Controllers\Loans\DepositController::class,'jsonData'])->name('deposits.jsonData');
Route::get('withdraws-json',[App\Http\Controllers\Loans\WithdrawController::class,'jsonData'])->name('withdraws.jsonData');
Route::get('roles-json',[App\Http\Controllers\System\RoleController::class,'jsonData'])->name('roles.jsonData');
Route::get('roles-vendor-json',[App\Http\Controllers\System\RoleController::class,'jsonDataVendor'])->name('rolesVendor.jsonData');
Route::get('modules-json',[App\Http\Controllers\System\RoleController::class,'moduleJsonData'])->name('roles.moduleJsonData');
Route::post('roles-async-permission',[App\Http\Controllers\System\RoleController::class,'store'])->name('roles.store');

Route::get('address-json',[App\Http\Controllers\System\AddressController::class,'jsonData'])->name('address.jsonData');
Route::get('barangay-json/{id}',[App\Http\Controllers\System\AddressController::class,'getBarangays'])->name('address.getBarangays');

Route::get('/cities-json/{province_id}', function ($province_id) {
    $data = App\Models\PhilippineCity::where('province_code',$province_id)->get();
    return App\Http\Resources\System\PhilippineCityResource::collection($data);
    
});

// JSON DATA





Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

