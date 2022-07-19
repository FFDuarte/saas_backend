<?php

namespace App\Services;

use App\Models\Categorias;
use Gumlet\ImageResize;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CategoriasFotosService
{
    /**
     * Mensagem padrão de não encontrado.
     */
    const ERROR_MESSAGE_NOT_FOUND = 'Categoria não encontrada';

    private $model;

    public function __construct(Categorias $categoriasFotos)
    {
        $this->model = $categoriasFotos;
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
     * Atualiza foto da categoria
     */
    public function AtualizarFoto($id_categoria, Request $request)
    {
        try {

            $foto64_small = $this->RedimensionarMiniatura($request->foto);
            $foto64_red   = $this->RedimensionarPadrao($request->foto);
            $foto64_orig  = str_replace('data:image/png;base64,', '', $request->foto);

            $categoria = $this->model->find($id_categoria);

            if ($categoria) {
                $categoria->update([
                    "foto_small" => $foto64_small,
                    "foto_red"   => $foto64_red,
                    "foto_orig"  => $foto64_orig,
                ]);
            }

            return response()->json($categoria, Response::HTTP_OK);

        } catch (\Exception $e) {
            return response()->json([$e->getMessage()], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
