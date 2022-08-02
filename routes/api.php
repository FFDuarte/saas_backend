<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByPath;

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


/**
 * Rotas usadas pelos admins do sistema
 */
Route::group([
    'prefix' => '/admin',
], function () {
    Route::post('/login',  [AuthAdminController::class, 'Login']);
    Route::post('/registrar', [AuthAdminController::class, 'Registrar']);

    Route::group(['middleware' => ['assign.guard:admin', 'jwt.protected:admin']], function () {
        Route::get('usuarios', [UserAdminController::class, 'index']);
    });
});

/**
 * Rotas usadas pelos tenants
 */
Route::group([
    'prefix' => '/dashboard',
], function () {

    Route::post('/login',  [AuthTenantController::class, 'Login']);
    Route::post('/registrar', [AuthTenantController::class, 'Registrar']);
});

/*
 * Rotas podem ser acessadas apenas por (tenant) inquilinos logados
 */
Route::group([
    'prefix' => '/dashboard/{tenant}',
    'middleware' => [InitializeTenancyByPath::class],
], function () {

    Route::group(['middleware' => ['assign.guard:tenant', 'jwt.protected:tenant']], function () {

        /**
         * Usuários
         */
        Route::prefix('/associados')->group(function () {
            Route::get('/', [AssociadosController::class, 'index']);
            Route::post('/add', [AssociadosController::class, 'store']);

        });
    });
});
