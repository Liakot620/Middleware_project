<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\DemoController;
use App\Http\Middleware\DemoMiddleware;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::post('/photo', function (request $request) {
   $photo = $request->file('image');
   $photo-> move(public_path("/images"), $photo->getClientOriginalName());
   return "success";
});

Route::get("/bainary",function (request $request){
     $path = public_path("/images/20211114_124033.jpg");
     return response()->file($path);
});

Route::get("/download",function (request $request){
     $path = public_path("/images/20211114_124033.jpg");
     return response()->download($path);
});

// Route::get("publicMessage",[DemoController::class,"publicMessage"]);
// Route::get("protectedMessage", [DemoController::class, "protectedMessage"])->middleware("auth");


// Route::group(["prefix" => "admin","middleware"=>"auth"], function () {
//     Route::get("publicMessage", [DemoController::class, "publicMessage"]);
//     Route::get("protectedMessage", [DemoController::class, "protectedMessage"]);
// });

// Route::prefix("admin/users")->middleware("auth")->group(function () {
//     Route::get("publicMessage", [DemoController::class, "publicMessage"]);
//     Route::get("protectedMessage", [DemoController::class, "protectedMessage"]);
//     Route::get("secratMessage", [DemoController::class, "secratMessage"]);
// });

// Route::middleware("throttle:3,1")->group(function () {
//     Route::get("publicMessage", [DemoController::class, "publicMessage"]);
//     Route::get("protectedMessage", [DemoController::class, "protectedMessage"]);
//     Route::get("secratMessage", [DemoController::class, "secratMessage"]);
// });

// Route::group(["prefix"=>"admin","middleware"=>"auth"],function(){
//     Route::get("publicMessage", [DemoController::class, "publicMessage"]);
//     Route::get("protectedMessage", [DemoController::class, "protectedMessage"]);
//     Route::get("secratMessage", [DemoController::class, "secratMessage"]);
// });

// Route::get("publicMessage", [DemoController::class, "publicMessage"]);
// Route::get("protectedMessage", [DemoController::class, "protectedMessage"])->middleware(DemoMiddleware::class);

// Route::middleware([DemoMiddleware::class,"throttle:3,1"])->group(function(){
//     Route::get("publicMessage", [DemoController::class, "publicMessage"]);
//     Route::get("protectedMessage", [DemoController::class, "protectedMessage"]);
// });

Route::prefix("dashboard")->middleware(["check", "throttle:3, 1"])->group(function(){
    Route::get("protectedMessage", [DemoController::class, "protectedMessage"]);
    Route::get("secratMessage", [DemoController::class, "secratMessage"]);
    Route::get("loginUser", [DemoController::class, "loginUser"])->middleware("login");
});
// Route::prefix("dashboard")->get("publicMessage", [DemoController::class, "publicMessage"])->middleware("check");

Route::get("loginUser", [DemoController::class, "loginUser"]);
