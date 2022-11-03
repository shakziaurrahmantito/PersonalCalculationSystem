<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\amountController;
use App\Http\Controllers\memberController;
use App\Http\Controllers\roleController;
use App\Http\Controllers\paymentGetwayController;
use App\Http\Controllers\roleassignController;
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


Route::group(["middleware" => "loginCheck"], function(){


	Route::get("/login",[userController::class,"login"]);
	Route::post("/userlogin",[userController::class,"userlogin"]);
	

});


Route::group(["middleware" => "userCheck"], function(){

	

	Route::get("/",[userController::class,"dasboard"]);
	Route::get("/userAdd",[userController::class,"userAdd"]);
	Route::post("/userinsert",[userController::class,"userinsert"]);
	Route::get("/logout",[userController::class,"logout"]);
	Route::get("/userlist",[userController::class,"userlist"]);
	Route::get("/userAction",[userController::class,"userAction"]);
	Route::get("/userDelete",[userController::class,"userDelete"]);
	Route::get("/userGetupdatedata",[userController::class,"userGetupdatedata"]);
	Route::post("/userUpdate",[userController::class,"userUpdate"]);
	Route::get("/profile",[userController::class,"profile"]);
	Route::post("/userUpdateProfile",[userController::class,"userUpdateProfile"]);
	Route::get("/passwordchange",[userController::class,"passwordchange"]);
	Route::post("/passwordchangeupdate",[userController::class,"passwordchangeupdate"]);



	Route::get("/expenseAdd",[amountController::class,"expenseAdd"]);
	Route::get("/incomeAdd",[amountController::class,"incomeAdd"]);
	Route::get("/incomelist",[amountController::class,"incomelist"]);
	Route::get("/expenselist",[amountController::class,"expenselist"]);
	Route::post("/expenseInsert",[amountController::class,"expenseInsert"]);
	Route::post("/insertInsert",[amountController::class,"insertInsert"]);
	Route::get("/amountGetupdatedata",[amountController::class,"amountGetupdatedata"]);
	Route::post("/creditamountUpdate",[amountController::class,"creditamountUpdate"]);
	Route::post("/debitamountUpdate",[amountController::class,"debitamountUpdate"]);



	Route::get("/memberAdd",[memberController::class,"memberAdd"]);
	Route::post("/memberInsert",[memberController::class,"memberInsert"]);
	Route::get("/memberlist",[memberController::class,"memberlist"]);
	Route::get("/memberDelete",[memberController::class,"memberDelete"]);
	Route::get("/memberAction",[memberController::class,"memberAction"]);
	Route::get("/memberGetupdatedata",[memberController::class,"memberGetupdatedata"]);
	Route::post("/memberUpdate",[memberController::class,"memberUpdate"]);







	Route::get("/roleadd",[roleController::class,"roleAdd"]);
	Route::post("/roleInsert",[roleController::class,"roleInsert"]);
	Route::get("/roleassign",[roleController::class,"roleAssign"]);
	Route::post("/roleassingInsert",[roleController::class,"roleassingInsert"]);
	Route::get("/rolelist",[roleController::class,"rolelist"]);
	Route::get("/roleAction",[roleController::class,"roleAction"]);
	Route::get("/roleDelete",[roleController::class,"roleDelete"]);
	Route::post("/roleUpdate",[roleController::class,"roleUpdate"]);
	Route::get("/roleGetupdatedata",[roleController::class,"roleGetupdatedata"]);



	Route::get("/getwayadd",[paymentGetwayController::class,"getwayAdd"]);
	Route::post("/getwayInsert",[paymentGetwayController::class,"getwayInsert"]);
	Route::get("/getwaylist",[paymentGetwayController::class,"getwaylist"]);
	Route::get("/getwayDelete",[paymentGetwayController::class,"getwayDelete"]);
	Route::get("/getwayAction",[paymentGetwayController::class,"getwayAction"]);
	Route::get("/getwayGetupdatedata",[paymentGetwayController::class,"getwayGetupdatedata"]);
	Route::post("/getwayUpdate",[paymentGetwayController::class,"getwayUpdate"]);





	Route::get("/getRoleassingdata",[roleassignController::class,"getRoleassingdata"]);









});