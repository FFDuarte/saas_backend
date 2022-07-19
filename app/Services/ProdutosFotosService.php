<?php

namespace App\Services;

use App\Models\ProdutosFotos;
use App\Models\Produtos;
use Gumlet\ImageResize;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProdutosFotosService
{
    /**
     * Mensagem padrão de não encontrado.
     */
    const ERROR_MESSAGE_NOT_FOUND = 'Produto não encontrado';

    private $model;

    public function __construct(ProdutosFotos $produtosFotos, Produtos $produto)
    {
        $this->model = $produtosFotos;
        $this->model_produtos = $produto;
    }

    /**
     * Redimensiona a foto para o tamanho padrão.
     * Largura máxima: 500px
     */
    protected function RedimensionarPadrao($foto)
    {
        $foto = str_replace('data:image/png;base64,', '', $foto);

        $image = ImageResize::createFromString(base64_decode($foto));

        $image->resizeToWidth(500);

        return base64_encode($image->getImageAsString());
    }

    /**
     * Redimensiona a miniatura.
     * Largura máxima: 200px
     */
    protected function RedimensionarMiniatura($foto)
    {
        $foto = str_replace('data:image/png;base64,', '', $foto);

        $image = ImageResize::createFromString(base64_decode($foto));

        $image->resizeToWidth(200);

        return base64_encode($image->getImageAsString());
    }

    /**
     * Atualiza foto, envia para o Google e atualiza no banco a url.
     */
    public function AdicionarFoto($id_produto, Request $request)
    {
        try {

            $foto64_small = $this->RedimensionarMiniatura($request->foto);
            $foto64_red   = $this->RedimensionarPadrao($request->foto);
            $foto64_orig  = str_replace('data:image/png;base64,', '', $request->foto);

            $produto = $this->model_produtos->find($id_produto);

            if ($produto) {
                $this->model->create([
                    "id_produto" => $id_produto,
                    "foto_small" => $foto64_small,
                    "foto_red"   => $foto64_red,
                    "foto_orig"  => $foto64_orig,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
