<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\DepartementController;
use App\Http\Controllers\RessourceController;
use App\Http\Controllers\RoleController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users',[UserController::class,'getUsers']);
Route::get('users/{id}',[UserController::class,'getUser']);
Route::post('users',[UserController::class,'addUser']);
Route::put('users/{id}',[UserController::class,'updateUser']);
Route::delete('users/{id}',[UserController::class,'deleteUser']);

// categories 
Route::get('categories',[CategorieController::class,'getCategories']);
Route::get('categories/{id}',[CategorieController::class,'getCategorie']);
Route::post('categories',[CategorieController::class,'addCategorie']);
Route::put('categories/{id}',[CategorieController::class,'updateCategorie']);
Route::delete('categories/{id}',[CategorieController::class,'deleCategorie']);

//departements 
Route::get('departements',[DepartementController::class,'getDepartements']);
Route::get('departements/{id}',[DepartementController::class,'getDepartement']);
Route::post('departements',[DepartementController::class,'addDepartement']);
Route::put('departements/{id}',[DepartementController::class,'updateDepartement']);
Route::delete('departements/{id}',[DepartementController::class,'deleteDepartement']);

//ressources
Route::get('ressources',[RessourceController::class,'getRessources']);
Route::get('ressources/{id}',[RessourceController::class,'getRessource']);
Route::post('ressources',[RessourceController::class,'addRessource']);
Route::put('ressources/{id}',[RessourceController::class,'updateRessource']);
Route::delete('ressources/{id}',[RessourceController::class,'deleteRessource']);

//roles
Route::get('roles',[RoleController::class,'getRoles']);
Route::get('roles/{id}',[RoleController::class,'getRole']);
Route::post('roles',[RoleController::class,'addRole']);
Route::put('roles/{id}',[RoleController::class,'updateRole']);
Route::delete('roles/{id}',[RoleController::class,'deleteRole']);