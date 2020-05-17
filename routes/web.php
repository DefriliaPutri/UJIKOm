<?php

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::match(["GET", "POST"], "/register", function(){
    return redirect("/login");
    })->name("register");


Route::group(['middleware' => 'auth'],
function() {
    

        Route::resource("users", "UserController");


        //outlets routes
        Route::get('/outlets/trash', 'OutletController@trash')->name('outlets.trash');

        Route::get('/outlets/{id}/restore', 'OutletController@restore')->name('outlets.restore');

        Route::delete('/outlets/{outlet}/delete-permanent', 'OutletController@deletePermanent')->name('outlets.deletepermanent');

        Route::resource("outlets", "OutletController");

        //member routes
        Route::get('/members/trash', 'MemberController@trash')->name('members.trash');

        Route::get('/members/{id}/restore', 'MemberController@restore')->name('members.restore');

        Route::delete('/members/{outlet}/delete-permanent', 'MemberController@deletePermanent')->name('members.deletepermanent');

        Route::resource("members", "MemberController");

        
        //paket routes
        Route::get('/pakets/trash', 'PaketController@trash')->name('pakets.trash');

        Route::get('/pakets/{id}/restore', 'PaketController@restore')->name('pakets.restore');

        Route::delete('/pakets/{outlet}/delete-permanent', 'PaketController@deletePermanent')->name('pakets.deletepermanent');

        Route::get('/ajax/outlets/search', 'OutletController@ajaxSearch');

        Route::resource("pakets", "PaketController");

        //tansaksi route

        Route::get('/ajax/outlets/search', 'OutletController@ajaxSearch');

        Route::get('/ajax/paket/search', 'PaketController@ajaxSearch');

        Route::get('/ajax/members/search', 'MemberController@ajaxSearch');

        Route::get('/transaksi/{id}/cetakinvoice/', 'TransactionController@cetakInvoice')->name('transaksi.cetakInvoice');

        Route::get('/transaksi/laporanTransaksi/', 'TransactionController@laporan')->name('transaksi.laporan');

        Route::resource("transaksi", "TransactionController");


        
});