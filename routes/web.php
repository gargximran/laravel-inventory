<?php

use Illuminate\Http\Request;
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






// routes for inventory full system

Route::namespace('inventory')->group(function(){


    Route::get('/','InventoryDashBoard@index')->name('inventory_index');


    // route for employee management   
    Route::prefix('employees')->group(function(){

        Route::get('/', 'EmployeeController@index')->name('employee_view_table');
        Route::post('/', 'EmployeeController@store')->name('employee_store');
        Route::get('/{employee:id}/watch', 'EmployeeController@show')->name('employee_view_single');
        Route::get('/{employee:id}/edit', 'EmployeeController@edit')->name('employee_edit');
        Route::post('/{employee:id}/update', 'EmployeeController@update')->name('employee_update');
        Route::delete('/{employee:id}/delete', 'EmployeeController@destroy')->name('employee_delete');

    });
    


    // route for manage customers
    Route::prefix('customer')->group(function(){

        Route::get('/','CustomerController@index')->name('customer_view_table');
        Route::post('/','CustomerController@store')->name('customer_store');
        Route::get('/{customer:id}/edit','CustomerController@edit')->name('customer_edit');
        Route::post('/{customer:id}/update','CustomerController@update')->name('customer_update');
        Route::get('/{customer:id}/view', 'CustomerController@show')->name('customer_singe_view');
        Route::delete('/{customer:id}/delete','CustomerController@destroy')->name('customer_delete');

    });


    // route for manage suppliers
    Route::prefix('supplier')->group(function(){

        Route::get('/', 'SupplierController@index')->name('supplier_view');
        Route::post('/', 'SupplierController@store')->name('supplier_store');
        Route::get('/{supplier:id}/watch', 'SupplierController@show')->name('supplier_view_single');
        Route::get('/{supplier:id}/edit', 'SupplierController@edit')->name('supplier_edit');
        Route::put('/{supplier:id}/update', 'SupplierController@update')->name('supplier_update');
        Route::delete('/{supplier:id}/delete', 'SupplierController@destroy')->name('supplier_delete');

    });


    // route for manage brand
    Route::prefix('brand')->group(function(){

        Route::get('/', 'BrandController@index')->name('brand_view');
        Route::post('/', 'BrandController@store')->name('brand_view');
        Route::put('/{brand:id}/update', 'BrandController@update')->name('brand_update');
        Route::delete('/{brand:id}/delete', 'BrandController@destroy')->name('brand_delete');

    });


    //route for manage inventory
    Route::prefix('inventories')->group(function(){
        Route::get('/', 'InventoryController@index')->name('inventory_view');
        Route::post('/', 'InventoryController@store')->name('inventory_store');
        Route::get('/{inventory:id}/show', 'InventoryController@show')->name('inventory_watch');
    });

    //manage buy from supplier
    Route::prefix('buy_from_supplier')->group(function(){

        Route::get('/', 'BuyFromSupplierController@index')->name('buy_from_supplier');
        Route::post('/', 'BuyFromSupplierController@store')->name('buy_form_supplier_store');
         

    });

    Route::prefix('buy_hostory')->group(function(){

        Route::get('/buy', 'InvoiceController@buy_hostory')->name('buy_history');
        Route::get('/invoice', 'InvoiceController@invoice_history')->name('invoice_history');
    });

    Route::prefix('stock')->group(function(){


        Route::get('all', 'InvoiceController@all_stock')->name('all_stock');
        Route::get('expired', 'InvoiceController@expired_stock')->name('expired_stock');
        Route::get('finished', 'InvoiceController@finished_stock')->name('finished_stock');

    });
    
});