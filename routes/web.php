<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;



Route::middleware("auth")->group(function () {

Route::get('/', [MainController::class, "home"])->name("home");

Route::post("/create_project", [MainController::class, "create_project"])->name("create_project");

Route::post("/delete_cliente", [MainController::class, "delete_cliente"])->name("delete_cliente");

Route::get("/logout", [AuthController::class, "logout"])->name("logout");

});

Route::middleware("guest")->group(function () {

Route::get("/login", [AuthController::class, "view_login"])->name("view_login");
Route::post("/login", [AuthController::class, "authenticate"])->name("login");
Route::get("/registro", [AuthController::class, "view_registro"])->name("view_registro");
Route::post("/registro", [AuthController::class, "create_user"])->name("registro");



});