<?php

use App\Http\Controllers\InvocieController;
use App\Http\Controllers\IvoicesAttachmuntController;
use App\Http\Controllers\IvoicesDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InvoicesReport;
use Illuminate\Support\Facades\Route;

use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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


Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function () {
Route::get('/index', [App\Http\Controllers\HomeController::
        class, 'index'])->name('index.index');
Route::get('/test', [App\Http\Controllers\HomeController::
        class, 'test']);
});



Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function () {

    Route::get('/', function () {
        return view('auth.login');
    });


    Auth::routes();

//    Route::resource('Invoices',InvocieController::class);
    Route::controller(SectionController::class)->group(function (){
        Route::get('section/index','index')->name('section.index');
        Route::get('section/edit','edit')->name('section.edit');
        Route::post('section/store','store')->name('section.store');
        Route::get('section/update','update')->name('section.update');
        Route::post('section/destroy','destroy')->name('section.destroy');
    });
        Route::controller(ProductController::class)->group(function (){
        Route::get('product/index','index')->name('product.index');
        Route::get('product/product','edit')->name('product.edit');
        Route::post('product/store','store')->name('product.store');
        Route::get('product/update','update')->name('product.update');
        Route::post('product/destroy','destroy')->name('product.destroy');
    });

        Route::controller(InvocieController::class)->group(function (){
            Route::get('Invoices','index')->name('Invoices.index');
            Route::post('Invoices/store','store')->name('invoices.store');
            Route::get('Invoices/create','create')->name('invoices.create');
            Route::get('Invoices/{id}/edit','edit')->name('Invoices.edit');
            Route::get('Invoices/{id}/editActive','editActive')->name('Invoices.editActive');
            Route::post('Invoices/{id}/updateٍStatus','updSta')->name('invoices.updateٍStatus');
            Route::post('Invoices/update','update')->name('invoices.update');
            // add to archev in the database not delete ارشيف  or delete the route one can delete the invoices or ercheav the invoices
            Route::delete('Invoices','destroy')->name('invoices.destroy');
            Route::get('section/{id}','section_invoices');
//           Route::get('Invoices/achive','show')->name('Invoices.achive');
            // show any invoices to the erachev
            Route::get('Invoices/Erachev','show')->name('Invoices.Erachev');
            //retuen any invoices ot the erachev
            Route::post('Archive','Arch_upd')->name('Archive.update');

            // delete the column of the trached
            Route::post('withTrached','withTrached')->name('withTrached');

            // print the invoices
            Route::get('InvoicesPrint/{id}','Print')->name('Print.Invoices');

            // export Excel This route
                Route::get('Invoices/export','export')->name('export.excel');

            Route::get('MarkAsRead_all','MarkAsRead_all')->name('MarkAsRead_all.index');
        });





        Route::controller(IvoicesDetailController::class)->group(function (){
            Route::get('/Details/{id}','Details')->name('section.Details');
            Route::get('/View_file/{invoices_number}/{file_name}','show');
            Route::get('/download/{invoices_number}/{file_name}','download');
            Route::post('delete','destroy')->name('delete_file');
            Route::post('InvoiceAttachments','store');
        });
        Route::get('Invoice_Paid',[IvoicesAttachmuntController::class,'index'])->name('Invoice_Paid');
        Route::get('Invoice_UpPaid',[IvoicesAttachmuntController::class,'create'])->name('Invoice_UpPaid');
        Route::get('Invoice_Partial',[IvoicesAttachmuntController::class,'store'])->name('Invoice_Partial');

        Route::controller(InvoicesReport::class)->group(function (){
            Route::get('invoices/report','index')->name('invoices.report');
            Route::post('invoices/report','create')->name('Search_invoices');
            Route::get('report/customer','show')->name('report.customer');
            Route::post('Search/customers','store')->name('Search_customers');
        });




    Route::controller(UserController::class)->group(function (){
        Route::get('usersIndex','index')->name('users.indexs');
        Route::get('Create','create')->name('users.creates');
//        Route::post('store','store')->name('users.store');
//        Route::get('users/{id}/edit','edit')->name('users.edit');
        Route::patch('users/{id}/update','update')->name('users.updates');
    });


    Route::controller(RoleController::class)->group(function (){
        Route::get('RoleIndex','index')->name('roles.users');
//        Route::get('RoleEdit','edit')->name('roles.edit');
//        Route::PATCH('RoleUpdate','Update')->name('roles.update');
//        Route::post('store','store')->name('roles.store');
    });


});

Route::group(['prefix' => LaravelLocalization::setLocale()], function()
{


});




Route::group(['prefix' => LaravelLocalization::setLocale(),'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]],function () {
    Route::get('/{page}', [\App\Http\Controllers\AdminController::class,'index']);
    Route::group(['middleware' => ['auth']], function() {
        Route::resource('users',UserController::class);
        Route::resource('roles',RoleController::class);

        Route::resource('products','ProductController');
    });
});



/*
MAIL_MAILER=mailgun
MAIL_HOST=mailhog
MAIL_PORT=465
MAIL_USERNAME=yemennetwebsite@gmail.com
MAIL_PASSWORD=m123.123
MAIL_ENCRYPTION=ssl
MAIL_FROM_ADDRESS=yemennetwebsite@gmail.com
MAIL_FROM_NAME="${APP_NAME}"
 */
