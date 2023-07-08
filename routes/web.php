<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admincontroller;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('admin/login');
});

    // Group Controller
    Route::controller(admincontroller::class)->group(function(){
    // Prefix User Name
 Route::prefix('admin')->group(function () {

    // Login
    Route::get('/','login');
    Route::get('/login','login');
    Route::post('loginaction','adminloginaction');

    // Forget
   Route::get('/forget', function () { return view('admin.forget');  });
    Route::post('/forget_action','forget_action');

    // Middleware
   Route::group(['middleware' => 'admin'], function () {

      // Logout

    Route::get('logout','logout');

      // Dashboard
      Route::get('dashboard','dashboard');
    
      //profile
      Route::get('profile','profile');
      Route::post('profile_edit_action','profile_edit_action');

      //update password
      Route::get('update_password','update_password');

      Route::post('update_password_action', 'update_password_action'); 

      //Category
      Route::get('category','category');
      Route::post('add_category','add_category');
      Route::post('edit_cat_name_action','edit_cat_name_action');
      Route::get('delete_cat_name/{id}','delete_cat_name');

      //Document
      Route::post('add_document','view_document');
      Route::get('document','document');
      Route::get('delete_document/{id}','delete_document');

     //Product
     Route::get('add_product','add_product');
     Route::post('add_product_action','add_product_action');
     Route::get('view_product','view_product');
     Route::post('edit_product_action','edit_product_action');
     Route::get('delete_product/{id}','delete_product');

     //Frenchies
     Route::get('frenchies','frenchies');


     //Orders
     Route::get('order_awaiting','order_awaiting');
     Route::post('upload_slip','upload_slip');

     Route::get('order_inprogress','order_inprogress');
     
     Route::get('order_pending','order_pending');

     Route::get('order_complete_check/{id}','order_completed_check');
     Route::get('order_complete','order_completed');
     Route::get('order_cancelled','order_cancelled');
     Route::get('order_cancelled_check/{id}','order_cancelled_check');

   //   Notification
   Route::get('add_notification','add_notification');
   Route::post('add_notification_action','add_notification_action');
   Route::get('view_notification','view_notification');

    //  sale_record
     Route::get('sale_record','sale_record');
    });

 });
});