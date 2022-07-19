<?php

namespace App\Services;

use App\Models\Vendas;
use App\Models\VendasItens;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class VendasService
{

    public function __construct(Vendas $vendas, VendasItens $vendas_itens)
    {
        $this->model       = $vendas;
        $this->model_itens = $vendas_itens;
    }

    public function ListarVendas(Request $request)
    {
        try {

            $limit = intVal($request->get('limit') ? $request->get('limit') : 100);
            $page  = intVal($request->get('page') ? $request->get('page') : 1);
            $search = strval($request->get('search') ? $request->get('search') : false);

            $orderBy        = strval($request->get('orderBy') ? $request->get('orderBy') : 'id');
            $orderDirection = strval($request->get('orderDirection') ? $request->get('orderDirection') : 'DESC');

            $results = $this->model->with('endereco', 'usuario');

            if (!$search) {
                $results = $results;
            } else {
                $search = str_replace(' ', '%', $search);

                $results = $results
                    ->where(function ($qry) use ($search) {

                        if (is_numeric($search)) {
                            $qry->where('codigo', '=', "$search");
                            $qry->orWhere('codigo', 'ilike', "%$search%");
                        }

                        $qry->orWhere('descricao', 'ilike', "%$search%");
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

    public function AdicionarVenda(Request $request)
    {
        try {

            DB::beginTransaction();

            $venda = $this->model->create($request->all());

            if($venda->id){

                for ($i = 0; $i < count($request['itens']); $i++) {
                    $item = $request['itens'][$i];

                    $this->model_itens->create(
                        array_merge([
                            'venda_id'       => $venda->id,
                        ], $item)
                    );

                }
            }
            // $venda->usuario;
            // $venda->endereco;

            DB::commit();

            return response()->json($venda, Response::HTTP_INTERNAL_SERVER_ERROR);

        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function AtualizarVenda($id_venda, Request $request)
    {
        try {

        $itens = $this->model_itens->where('venda_id','=',$id_venda)->get();


        return response()->json($itens);

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function DeletarVenda($id_venda, Request $request)
    {
        try {


        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
