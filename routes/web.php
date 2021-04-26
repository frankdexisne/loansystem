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
    return view('welcome');
});
Route::resource('branches',App\Http\Controllers\Loans\BranchController::class);
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

Route::resource('loans',App\Http\Controllers\Loans\LoanController::class);
Route::post('loans/approval',[App\Http\Controllers\Loans\LoanController::class,'approval'])->name('loans.approval');
Route::post('loans/for-release',[App\Http\Controllers\Loans\LoanController::class,'for_release'])->name('loans.for-release');
Route::post('loans/release',[App\Http\Controllers\Loans\LoanController::class,'release'])->name('loans.release');
Route::get('loans/voucher/{id}',[App\Http\Controllers\Loans\LoanController::class,'voucher'])->name('loans.voucher');
Route::get('loans/soa/{id}',[App\Http\Controllers\Loans\LoanController::class,'soa'])->name('loans.soa');

Route::resource('payments',App\Http\Controllers\Loans\PaymentController::class);
Route::resource('deposits',App\Http\Controllers\Loans\DepositController::class);
Route::resource('withdraws',App\Http\Controllers\Loans\WithdrawController::class);
Route::resource('reports',App\Http\Controllers\Loans\ReportController::class);

Route::post('employees/add-user',[App\Http\Controllers\Payroll\EmployeeController::class,'addUser'])->name('employees.addUser');
Route::post('employees/assign',[App\Http\Controllers\Payroll\EmployeeController::class,'assign'])->name('employees.assign');
Route::post('users/assign-role',[App\Http\Controllers\System\UserController::class,'assignRole'])->name('users.assign-role');


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
