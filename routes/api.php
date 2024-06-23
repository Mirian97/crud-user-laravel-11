<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/**
 * Retorna uma lista de todos os usuários.
 *
 * @return \Illuminate\Http\Response
 */
Route::get("/users", [UserController::class, "index"]);

/**
 * Exibe os detalhes de um usuário específico.
 *
 * @param int $user Id do usuário
 * @return \Illuminate\Http\Response
 */
Route::get("/users/{user}", [UserController::class, "show"]);

/**
 * Cria um novo usuário com os dados fornecidos.
 *
 * @return \Illuminate\Http\Response
 */
Route::post("/users", [UserController::class, "store"]);

/**
 * Atualiza os dados de um usuário específico.
 *
 * @param int $user Id do usuário
 * @return \Illuminate\Http\Response
 */
Route::put("/users/{user}", [UserController::class, "update"]);

/**
 * Exclui um usuário específico.
 *
 * @param int $user Id do usuário
 * @return \Illuminate\Http\Response
 */
Route::delete("/users/{user}", [UserController::class, "destroy"]);

