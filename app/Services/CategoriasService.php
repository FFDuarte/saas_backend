<?php

namespace App\Services;

use App\Models\Categorias;
use Exception;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class CategoriasService
{

    const ERROR_MESSAGE_NOT_FOUND = 'Categoria não encontrada';

    public function __construct(Categorias $categorias)
    {
        $this->model = $categorias;
    }

    public function ListarCategorias(Request $request)
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

                        $qry->where('nome', '=', "$search");
                    });
            }

            $count = count($results->get());

            $results = $results
                ->orderBy($orderBy, $orderDirection)
                ->forPage($page, $limit)
                ->get();

            $paginator = new LengthAwarePaginator($results,  $count, $limit, $page);

            return response()->json($paginator, Response::HTTP_OK);
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function ObterCategoria($id_categoria, Request $request)
    {
        try {

                $categoria = $this->model->find($id_categoria);

                if ($categoria) {

                    return response()->json($categoria, Response::HTTP_OK);
                } else {
                    return response()->json(['Categoria não encontrada'], Response::HTTP_NOT_FOUND);
                }

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function AdicionarCategoria(Request $request)
    {
        try {

            $add_categoria = $this->model->create($request->all());

            if ($add_categoria) {

                $busca_categoria = $this->model->find($add_categoria->id);

                return response()->json($busca_categoria, Response::HTTP_OK);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function AtualizarCategoria($id_categoria, Request $request)
    {
        try {

            $categoria = $this->model->find($id_categoria);

            if ($categoria) {

                $categoria->update($request->all());

                return response()->json($categoria, Response::HTTP_OK);
            } else {
                return response()->json([Self::ERROR_MESSAGE_NOT_FOUND], Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function DeletarCategoria($id_categoria, Request $request)
    {
        try {

            $categoria = $this->model->find($id_categoria);

            if ($categoria) {

                $categoria->delete();

                return response()->json($categoria, Response::HTTP_OK);
            } else {
                return response()->json([Self::ERROR_MESSAGE_NOT_FOUND], Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
