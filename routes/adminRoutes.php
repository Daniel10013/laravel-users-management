<?php

use App\Http\Controllers\CreateUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\ValidateUserRole;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

Route::middleware([ValidateUserRole::class])->group(function(){
    Route::get("/dashboard", [DashboardController::class, "render"])->name("dashboard");
    
    Route::get("/details-user/{id}", [ProfileController::class, "getUserDetails"])->name("render-details-page");
    Route::patch("/details-user/{id}/unlock", [ProfileController::class, "unlockAccount"])->name("details-page.activateUser");
    Route::delete("/delete-user/{id}", [ProfileController::class, "deleteUserById"])->name("details-page.deleteUser");

    Route::get("/create-user", [CreateUserController::class, "render"])->name("create-page");
    Route::post("/create-user", [CreateUserController::class, "createUser"])->name("admin.create-user");
});
