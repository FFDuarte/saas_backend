<?php

namespace App\Services;

use App\Models\Produtos;
use Exception;
use App\Validations\ProdutosValidation;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Response;

class ProdutosService
{

    public function __construct(Produtos $produtos)
    {
        $this->model = $produtos;
    }

    public function ListarTodos(Request $request)
    {
        try {

            $limit = intVal($request->get('limit') ? $request->get('limit') : 100);
            $page  = intVal($request->get('page') ? $request->get('page') : 1);
            $search = strval($request->get('search') ? $request->get('search') : false);

            $orderBy        = strval($request->get('orderBy') ? $request->get('orderBy') : 'descricao');
            $orderDirection = strval($request->get('orderDirection') ? $request->get('orderDirection') : 'ASC');

            /** Carrega relacionamento com fotos do produto */
            $results = $this->model->with('fotos');

            // GET DATA
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

    public function ObterProduto($id_produto, Request $request)
    {
        try {

                $produto = $this->model->find($id_produto);

                if ($produto) {

                    return response()->json($produto, Response::HTTP_OK);
                } else {
                    return response()->json(['Produto não encontrado'], Response::HTTP_NOT_FOUND);
                }

        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }


    public function AdicionarProduto(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), ProdutosValidation::ValidateAdd(), ProdutosValidation::MensagensErros());

            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST);
            } else {

                /**
                 * Pega último código cadastrado pra incrementar
                 */
                $ultimo_codigo = $this->model->orderBy('id', 'desc')->first();

                if (!$ultimo_codigo) {
                    $codigo = '000001';
                } else {
                    $novo_numero = (int) $ultimo_codigo->codigo  + 1;
                    $codigo = (string) str_pad($novo_numero, 6, "0", STR_PAD_LEFT);
                }

                $produto = array_merge(
                    $request->all(),
                    [
                        "codigo" => $codigo
                    ]
                );

                $add_produto = $this->model->create($produto);

                if ($add_produto) {

                    $busca_produto = $this->model->find($add_produto->id);

                    return response()->json($busca_produto, Response::HTTP_OK);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function AtualizarProduto($id_produto, Request $request)
    {
        try {

            $validator = Validator::make($request->all(), ProdutosValidation::ValidateUpdate(), ProdutosValidation::MensagensErros());

            if ($validator->fails()) {
                return response()->json($validator->errors()->all(), Response::HTTP_BAD_REQUEST);
            } else {


                $produto = $this->model->find($id_produto);

                if ($produto) {

                    $produto->update($request->all());

                    return response()->json($produto, Response::HTTP_OK);
                } else {
                    return response()->json(['Produto não encontrado'], Response::HTTP_NOT_FOUND);
                }
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function DeletarProduto($id_produto, Request $request)
    {
        try {

            $produto = $this->model->find($id_produto);

            if ($produto) {

                $produto->delete();

                return response()->json($produto, Response::HTTP_OK);
            } else {
                return response()->json(['Produto não encontrado'], Response::HTTP_NOT_FOUND);
            }
        } catch (\Throwable $th) {
            return response()->json($th->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
