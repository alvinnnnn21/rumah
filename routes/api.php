<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\API\APIController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post("/login", [APIController::class, "login"]);
Route::post("/register", [APIController::class, "register"]);
Route::post("/favorite", [APIController::class, "createFavorite"]);
Route::post("/chat", [APIController::class, "createChat"]);
Route::post("/reminder", [APIController::class, "createReminder"]);
Route::post("/rumah", [APIController::class, "createRumah"]);
Route::post("/search", [APIController::class, "getSearch"]);
Route::post("/sewa", [APIController::class, "createSewa"]);
Route::post("/bukti", [APIController::class, "createBukti"]);
Route::post("/rumah/{id}", [APIController::class, "editRumah"]); 
Route::post("/perbandingan", [APIController::class, "createPerbandingan"]);
Route::post("/ahp", [APIController::class, "createAHP"]);

Route::get("/rumah", [APIController::class, "getRumah"]);
Route::get("/rumah/{id}", [APIController::class, "getDetailRumah"]);
Route::get("/favorite/{id}", [APIController::class, "getFavorite"]);
Route::get("/chat/{id}", [APIController::class, "getChat"]);
Route::get("/detailchat/{id}", [APIController::class, "getDetailChat"]);
Route::get("/rumahsaya/{id}", [APIController::class, "getRumahSaya"]);
Route::get("/reminder/{id}", [APIController::class, "getReminder"]);
Route::get("/user", [APIController::class, "getUser"]);
Route::get("/bukti", [APIController::class, "getBukti"]);
Route::get("/transaksi/{id}", [APIController::class, "getTransaksi"]);
Route::get("/notifikasi/{id}", [APIController::class, "getNotifikasi"]);

Route::delete("/favorite/{id}", [APIController::class, "deleteFavorite"]);
Route::delete("/reminder/{id}", [APIController::class, "deleteReminder"]);

Route::put("/reminder/{id}", [APIController::class, "editReminder"]);
Route::put("/user/{id}", [APIController::class, "editUser"]);
Route::put("/bukti/{id}", [APIController::class, "editBukti"]);



