<?php
namespace App\Validations;

class UsuariosEnderecosValidation
{
    public static function ValidateAdd()
    {
        return [
            'complemento' => 'nullable | min:4 | max:100',
            'logradouro'  => 'required | min:4 | max:100',
            'municipio'   => 'required | min:2 | max:100',
            'numero'      => 'required | min:1 | max:10',
            'bairro'      => 'required | min:2 | max:40',
            'cep'         => 'required | min:1 | max:20',
            'uf'          => 'required | min:2 | max:2',
        ];
    }

    public static function ValidateUpdate($id)
    {
        return [
            'complemento' => 'nullable | min:4 | max:100',
            'logradouro'  => 'required | min:4 | max:100',
            'municipio'   => 'required | min:2 | max:100',
            'numero'      => 'required | min:1 | max:10',
            'bairro'      => 'required | min:2 | max:40',
            'cep'         => 'required | min:1 | max:20',
            'uf'          => 'required | min:2 | max:2',
        ];
    }

}
