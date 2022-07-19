<?php
namespace App\Validations;

use Illuminate\Validation\Rule;

class ProdutosValidation
{

    public static function MensagensErros()
    {

        return $messages = [
            'descricao.required'   => 'O campo descrição é obrigatório.',
            'und_saida.required'   => 'O campo und_saida é obrigatório.',
            'qtd.required'         => 'O campo qtd é obrigatório.',
            'preco_custo.required' => 'O campo preco_custo é obrigatório.',
            'preco_venda.required' => 'O campo preco_venda é obrigatório.',
        ];

    }

    public static function ValidateAdd()
    {
        return [

            'descricao'   => ['required' ],
            'und_saida'   => ['required' ],
            'qtd'         => ['required' ],
            'preco_custo' => ['required' ],
            'preco_venda' => ['required' ],

        ];
    }

    public static function ValidateUpdate()
    {
        return [

            'descricao'   => ['required' ],
            'und_saida'   => ['required' ],
            'qtd'         => ['required' ],
            'preco_custo' => ['required' ],
            'preco_venda' => ['required' ],

        ];

    }

}
