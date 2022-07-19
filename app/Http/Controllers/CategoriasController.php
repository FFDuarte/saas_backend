<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CategoriasService;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{

    private $categoriasService;

    public function __construct(CategoriasService $categoriasService){
        $this->categoriasService = $categoriasService;
    }

    public function ListarCategorias(Request $request){
        return $this->categoriasService->ListarCategorias($request);
    }

    public function ObterCategoria($id_categoria, Request $request){
        return $this->categoriasService->ObterCategoria($id_categoria, $request);
    }

    public function AdicionarCategoria(Request $request){
        return $this->categoriasService->AdicionarCategoria($request);
    }

    public function AtualizarCategoria($id_categoria, Request $request){
        return $this->categoriasService->AtualizarCategoria($id_categoria,$request);
    }

    public function DeletarCategorias($id_categoria, Request $request){
        return $this->categoriasService->DeletarCategoria($id_categoria,$request);
    }

}
