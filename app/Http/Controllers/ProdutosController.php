<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\ProdutosService;
use Illuminate\Http\Request;

class ProdutosController extends Controller
{

    private $produtosService;

    public function __construct(ProdutosService $produtosService){
        $this->produtosService = $produtosService;
    }

    public function ListarTodos(Request $request){
        return $this->produtosService->ListarTodos($request);
    }

    public function ObterProduto($id_produto, Request $request)
    {
        return $this->produtosService->ObterProduto($id_produto, $request);
    }

    public function AdicionarProduto(Request $request){
        return $this->produtosService->AdicionarProduto($request);
    }

    public function AtualizarProduto($id_produto, Request $request){
        return $this->produtosService->AtualizarProduto($id_produto,$request);
    }

    public function DeletarProduto($id_produto, Request $request){
        return $this->produtosService->DeletarProduto($id_produto,$request);
    }



}
