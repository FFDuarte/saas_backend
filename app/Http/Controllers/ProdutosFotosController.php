<?php

namespace App\Http\Controllers;

use App\Services\ProdutosFotosService;
use Illuminate\Http\Request;

class ProdutosFotosController extends Controller
{

    private $produtosFotosService;

    public function __construct(ProdutosFotosService $produtosFotosService)
    {
        $this->produtosFotosService = $produtosFotosService;
    }

    public function AdicionarFoto($id_produto, Request $request)
    {
        return $this->produtosFotosService->AdicionarFoto($id_produto, $request);
    }

}
