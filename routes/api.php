<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apicontroller;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Login
route::post('login',[apicontroller::class,'login']);


// Sign Up
route::post('signup',[apicontroller::class,'signup']);


// Profile
route::post('profile',[apicontroller::class,'profile']);
route::post('edit_profile',[apicontroller::class,'edit_profile']);

// Home
route::post('home',[apicontroller::class,'home']);

// Address
route::post('add_address',[apicontroller::class,'add_address']);
route::post('view_address',[apicontroller::class,'view_address']);
route::post('edit_address',[apicontroller::class,'edit_address']);
route::post('delete_address',[apicontroller::class,'delete_address']);



// Add document
route::post('add_document',[apicontroller::class,'add_document']);
route::post('view_document',[apicontroller::class,'view_document']);
route::post('delete_document',[apicontroller::class,'delete_document']);

// Order
route::post('add_order',[apicontroller::class,'add_order']);
route::post('view_order',[apicontroller::class,'view_order']);
// Order
route::post('add_slip',[apicontroller::class,'add_slip']);

// Notification
route::post('notification',[apicontroller::class,'notification']);

//  Forget
route::post('forget',[apicontroller::class,'forget']);

// change password
route::post('change_password',[apicontroller::class,'change_password']);