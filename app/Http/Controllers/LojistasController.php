<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\LojistasService;
use Illuminate\Http\Request;

class LojistasController extends Controller
{

    private $lojistasService;

    public function __construct(LojistasService $lojistasService){
        $this->lojistasService = $lojistasService;
    }

    public function ListarTodos(Request $request){
        return $this->lojistasService->ListarTodos($request);
    }

    public function ObterLoja($id_produto, Request $request)
    {
        return $this->lojistasService->Lojista($id_produto, $request);
    }

}
