<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\VendasService;
use Illuminate\Http\Request;

class VendasController extends Controller
{

    private $vendasService;

    public function __construct(VendasService $vendasService){
        $this->vendasService = $vendasService;
    }

    public function ListarVendas(Request $request){
        return $this->vendasService->ListarVendas($request);
    }

    public function AdicionarVenda(Request $request){
        return $this->vendasService->AdicionarVenda($request);
    }

    public function AtualizarVenda($id_venda, Request $request){
        return $this->vendasService->AtualizarVenda($id_venda,$request);
    }

    public function DeletarVenda($id_venda, Request $request){
        return $this->vendasService->DeletarVenda($id_venda,$request);
    }

}
