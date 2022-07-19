<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CategoriasFotosService;
use Illuminate\Http\Request;

class CategoriasFotosController extends Controller
{

    private $categoriasFotosService;

    public function __construct(CategoriasFotosService $categoriasFotosService){
        $this->categoriasFotosService = $categoriasFotosService;
    }

    public function AtualizarFoto($id_categoria, Request $request){
        return $this->categoriasFotosService->AtualizarFoto($id_categoria, $request);
    }

}
