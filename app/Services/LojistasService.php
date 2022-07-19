<?php

namespace App\Services;

use App\Models\Tenant;
use Exception;
use App\Validations\ProdutosValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class LojistasService
{

    public function __construct(Tenant $lojistas)
    {
        $this->model = $lojistas;
    }

    public function ListarTodos(Request $request)
    {
        try {

            $limit = intVal($request->get('limit') ? $request->get('limit') : 100);
            $page  = intVal($request->get('page') ? $request->get('page') : 1);
            $search = strval($request->get('search') ? $request->get('search') : false);

            $orderBy        = strval($request->get('orderBy') ? $request->get('orderBy') : 'empresa');
            $orderDirection = strval($request->get('orderDirection') ? $request->get('orderDirection') : 'ASC');

            $results = $this->model;

            // GET DATA
            if (!$search) {
                $results = $results;
            } else {
                $search = str_replace(' ', '%', $search);

                $results = $results
                    ->where(function ($qry) use ($search) {
                        $qry->orWhere('fantasia', 'ilike', "%$search%");
                        $qry->orWhere('empresa', 'ilike', "%$search%");
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

    public function Lojista( $tenant_id)
    {
        try {

            $lojista =  Tenant::find($tenant_id);

            if($lojista){

            return response()->json($lojista, Response::HTTP_OK);
            } else {
                    return response()->json(['Loja não encontrada'], Response::HTTP_NOT_FOUND);
            }

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

}
