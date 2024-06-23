<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controlador que gerencia as operações relacionadas a usuários.
 */
class UserController extends Controller
{
     /**
     * Exibe uma lista paginada de usuários.
     *
     * @return JsonResponse Lista de usuários com paginação
     */
    public function index() : JsonResponse
    {
        // $users = User::orderBy("id", "DESC")->get();
        $users = User::orderBy("id", "DESC")->paginate(2);
         return response()->json([
            "status" => true,
            "users" => $users
         ]);
    }

    /**
     * Exibe detalhes de um usuário específico.
     *
     * @param User $user Identificador do usuário
     * @return JsonResponse Detalhes do usuário
     */
    public function show(User $user) : JsonResponse
    {
        return response()->json([
            "status" => true,
            "user" => $user
        ]);
    }

     /**
     * Cria um novo usuário com as informações fornecidas.
     *
     * @param UserRequest $request Dados do usuário provenientes da requisição
     * @return JsonResponse Mensagem de sucesso ou falha
     */
    public function store(UserRequest $request) : JsonResponse
    {
        $connection = DB::connection();
        $connection->beginTransaction();

        try {
            $user = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password
            ]);

            $connection->commit();

            return response()->json([
                "status" => true,
                "user"=> $user,
                "message" => "Usuário cadastrado com sucesso!"
            ]);

        } catch (Exception $e) {
            $connection->rollBack();

            return response()->json([
                "status" => false,
                "message" => "Usuário não cadastrado"
            ],400);
        }
    }

    /**
     * Atualiza os dados de um usuário existente.
     *
     * @param UserRequest $request Dados do usuário atualizados
     * @param User $user Usuário a ser atualizado
     * @return JsonResponse Mensagem de sucesso ou falha
     */
    public function update(UserRequest $request, User $user) : JsonResponse
    {
        $connection = DB::connection();
        $connection->beginTransaction();

        try {
            $user->update([
                "name" => $request->name,
                "email" => $request->email,
                "password" => $request->password
            ]);

            $connection->commit();

            return response()->json([
                "status" => true,
                "user"=> $user,
                "message" => "Usuário editado com sucesso!"
            ]);

        } catch (Exception $e) {
            $connection->rollBack();

            return response()->json([
                "status" => false,
                "message" => "Usuário não editado"
            ],400);
        }
    }

     /**
     * Exclui um usuário.
     *
     * @param User $user Usuário a ser deletado
     * @return JsonResponse Mensagem de sucesso ou falha
     */
    public function destroy(User $user) : JsonResponse
    {
        try {
            $user->delete();

            return response()->json([
                "status" => true,
                "user"=> $user,
                "message" => "Usuário deletado com sucesso!"
            ]);

        } catch (Exception $e) {

            return response()->json([
                "status" => false,
                "message" => "Usuário não deletado!"
            ], 400);
        }
    }
}
