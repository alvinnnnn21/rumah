<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MemberController;
use App\Http\Controllers\AdminController;

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

Route::group(["middleware" => "auth:admin"], function(){
    Route::get("/admin", [AdminController::class, "index"]);
    Route::get("/bukti", [AdminController::class, "getBukti"]);
    Route::get("/rumah", [AdminController::class, "getRumah"]);
    Route::get("/kriteria", [AdminController::class, "getKriteria"]);
    
    Route::put("/bukti/{id}", [AdminController::class, "updateBukti"]);
    Route::put("/konfirmasi/{id}", [AdminController::class, "updateKonfirmasi"]);

    Route::delete("/user/{id}", [AdminController::class, "destroyUser"]);
    Route::delete("/rumah/{id}", [AdminController::class, "destroyRumah"]);

    Route::post("/kriteria", [AdminController::class, "storeKriteria"]);

});

Route::group(["middleware" => "auth:member"], function(){

    Route::get("/chat/{id}/{lawan}", [MemberController::class, "getChat"]);
    Route::get("/chat", [MemberController::class, "getChatAll"]);
    Route::get("/detailchat/{id}", [MemberController::class, "getDetailChat"]); 
    Route::get("/rumahsaya", [MemberController::class, "getRumahSaya"]);
    Route::get("/akun", [MemberController::class, "getAkun"]);
    Route::get("/reminder", [MemberController::class, "getReminder"]);
    Route::get("/favorit", [MemberController::class, "getFavorit"]);
    Route::get("/tambahrumah", [MemberController::class, "createRumah"]);
    Route::get("/tambahreminder", [MemberController::class, "createReminder"]);
    Route::get("/tambahrumah", [MemberController::class, "createRumah"]);
    Route::get("/transaksi", [MemberController::class, "getTransaksi"]);
    Route::get("/notifikasi/{id}", [MemberController::class, "getNotifikasi"]);
    Route::get("/sukses-sewa/{id}", [MemberController::class, "suksesSewa"])->name("sukes-sewa");

    Route::post("/chat", [MemberController::class, "storeChat"]);
    Route::post("/reminder", [MemberController::class, "storeReminder"]);
    Route::post("/rumah", [MemberController::class, "storeRumah"]);
    Route::post("/favorite", [MemberController::class, "storeFavorite"]);
    Route::post("/sewa", [MemberController::class, "storeSewa"]);
    Route::post("/bukti", [MemberController::class, "storeBukti"]);
    Route::get("/ahp", [MemberController::class, "storeAHP"]);

    Route::put("/akun", [MemberController::class, "updateAkun"]);
    Route::put("/reminder/{id}", [MemberController::class, "updateReminder"]);
    Route::put("/rumah/{id}", [MemberController::class, "updateRumah"]);

    Route::delete("/reminder/{id}", [MemberController::class, "destroyReminder"]);
    Route::delete("/favorite/{id}", [MemberController::class, "destroyFavorite"]);
});

Route::get("/", [MemberController::class, "index"]);
Route::get("/rumah/{id}", [MemberController::class, "getDetailRumah"]);

Route::post("/ahp", [MemberController::class, "storeAHP"]);
Route::post("/search", [MemberController::class, "storeSearch"]);
Route::get("/tutorial", [MemberController::class, "getTutorial"]);


require __DIR__.'/auth.php';
