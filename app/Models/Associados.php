<?php

namespace App\Models;


use Stancl\Tenancy\Database\Concerns\BelongsToTenant;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;


class Associados extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Tem que usar para identificar campos fixos na tabela
     */
    protected $fillable = [
            'id',
            'nome',
            'nome_artistico',
            'cnpf_cnpj',
            'data_nascimento',
            'email',
            'email2',

            'rua',
            'numero',
            'cep',
            'cidade',
            'uf',
            'pais',

            'telefone1',
            'telefone2',
         
            'data_cobranca',

            'tenant_id',



        ];
    
}
