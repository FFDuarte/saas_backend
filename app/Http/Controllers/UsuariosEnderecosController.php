<?php

namespace App\Http\Controllers;

use App\Services\UsuariosEnderecosService;
use Illuminate\Http\Request;

class UsuariosEnderecosController extends Controller
{

    private $usuariosEnderecosService;

    public function __construct(UsuariosEnderecosService $usuariosEnderecosService)
    {
        $this->usuariosEnderecosService = $usuariosEnderecosService;
    }

    public function ListarEnderecos($id_usuario, Request $request)
    {
        return $this->usuariosEnderecosService->ListarEnderecos($id_usuario, $request);
    }

    public function ObterUsuarioEndereco($id_usuario, $id_endereco, Request $request)
    {
        return $this->usuariosEnderecosService->ObterUsuarioEndereco($id_usuario, $id_endereco, $request);
    }

    public function AdicionarUsuarioEndereco($id_usuario, Request $request)
    {
        return $this->usuariosEnderecosService->AdicionarUsuarioEndereco($id_usuario, $request);
    }

    public function AtualizarUsuarioEndereco($id_usuario, $id_endereco, Request $request)
    {
        return $this->usuariosEnderecosService->AtualizarUsuarioEndereco($id_usuario, $id_endereco, $request);
    }

    public function ApagarUsuarioEndereco($id_usuario, $id_endereco, Request $request)
    {
        return $this->usuariosEnderecosService->ApagarUsuarioEndereco($id_usuario, $id_endereco, $request);
    }

}
