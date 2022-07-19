<?php

namespace App\Services;

use App\Models\UserApp;
use App\Models\UsuarioEndereco;
use App\Validations\UsuariosEnderecosValidation;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Response;

class UsuariosEnderecosService
{
    /**
     * Mensagem padrão de não encontrado.
     */
    const ERROR_MESSAGE_NOT_FOUND = 'Usuário não encontrado';

    public function __construct(UserApp $usuario, UsuarioEndereco $usuarioenderecos)
    {
        $this->model_usuario  = $usuario;
        $this->model = $usuarioenderecos;
    }

    public function ListarEnderecos($id_usuario, Request $request)
    {
        try {

            $limit = intVal($request->get('limit') ? $request->get('limit') : 100);
            $page  = intVal($request->get('page') ? $request->get('page') : 1);
            $search = strval($request->get('search') ? $request->get('search') : false);

            $orderBy        = strval($request->get('orderBy') ? $request->get('orderBy') : 'id');
            $orderDirection = strval($request->get('orderDirection') ? $request->get('orderDirection') : 'DESC');

            $results = $this->model;

            if (!$search) {
                $results = $results;
            } else {
                $search = str_replace(' ', '%', $search);

                $results = $results
                    ->where(function ($qry) use ($search) {
                        $qry->orWhere('logradouro', 'ilike', "%$search%");
                        $qry->orWhere('bairro', 'ilike', "%$search%");
                    });
            }

            $count = count($results->get());

            $results = $results
                ->orderBy($orderBy, $orderDirection)
                ->forPage($page, $limit)
                ->get();

            $paginator = new LengthAwarePaginator($results,  $count, $limit, $page);

            return response()->json($paginator, Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function ObterUsuarioEndereco($id_usuario, $id_endereco, Request $request)
    {
        try {

            $usuario = $this->model_usuario
                ->where('id', '=', $id_usuario)
                ->first();

            if ($usuario) {

                $usuario_endereco = $this->model->find($id_endereco);

                if ($usuario_endereco) {
                    return response()->json($usuario_endereco, Response::HTTP_OK);
                } else {
                    return response()->json(['Endereço do Usuário não encontrado'], Response::HTTP_NOT_FOUND);
                }
            } else {
                return response()->json([Self::ERROR_MESSAGE_NOT_FOUND], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function AdicionarUsuarioEndereco($id_usuario, Request $request)
    {

        $validator = Validator::make($request->all(), UsuariosEnderecosValidation::ValidateAdd());

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        } else {

            try {

                $usuario = $this->model_usuario
                    ->where('id', '=', $id_usuario)
                    ->first();

                if ($usuario) {

                    $usuario_inserir = array_merge($request->all(), [
                        'usuario_id' => $id_usuario,
                    ]);

                    $usuario_endereco = $this->model->create($usuario_inserir);

                    $endereco_adicionado = $this->model->find($usuario_endereco->id);

                    $endereco_adicionado->adicionado = true;

                    return response()->json($endereco_adicionado, Response::HTTP_CREATED);
                } else {
                    return response()->json([Self::ERROR_MESSAGE_NOT_FOUND], Response::HTTP_NOT_FOUND);
                }
            } catch (\Exception $e) {
                return response()->json([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function AtualizarUsuarioEndereco($id_usuario, $id_endereco, Request $request)
    {
        $validator = Validator::make($request->all(), UsuariosEnderecosValidation::ValidateUpdate($id_endereco));

        if ($validator->fails()) {
            return response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST);
        } else {

            try {

                $usuario = $this->model_usuario
                    ->where('id', '=', $id_usuario)
                    ->first();

                if ($usuario) {

                    $usuario_endereco = $this->model->find($id_endereco);

                    if ($usuario_endereco) {

                        $usuario_endereco->update($request->all());

                        return response()->json($usuario_endereco, Response::HTTP_OK);
                    } else {
                        return response()->json(['Endereço do Usuário não encontrado'], Response::HTTP_NOT_FOUND);
                    }
                } else {
                    return response()->json([Self::ERROR_MESSAGE_NOT_FOUND], Response::HTTP_NOT_FOUND);
                }
            } catch (\Exception $e) {
                return response()->json([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        }
    }

    public function ApagarUsuarioEndereco($id_usuario, $id_endereco, Request $request)
    {
        try {

            $usuario = $this->model_usuario
                ->where('id', '=', $id_usuario)
                ->first();

            if ($usuario) {

                $usuario_endereco = $this->model->find($id_endereco);

                if ($usuario_endereco) {

                    $usuario_endereco->delete();

                    return response()->json($usuario_endereco, Response::HTTP_OK);
                } else {
                    return response()->json(['Endereço do Usuário não encontrado'], Response::HTTP_NOT_FOUND);
                }
            } else {
                return response()->json([Self::ERROR_MESSAGE_NOT_FOUND], Response::HTTP_NOT_FOUND);
            }
        } catch (\Exception $e) {
            return response()->json([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
