<?php

namespace App\Models;

use Stancl\Tenancy\Database\Models\Tenant as BaseTenant;
use Stancl\Tenancy\Contracts\TenantWithDatabase;
use Stancl\Tenancy\Database\Concerns\HasDatabase;
use Stancl\Tenancy\Database\Concerns\HasDomains;

class Tenant extends BaseTenant implements TenantWithDatabase
{
    use HasDatabase, HasDomains;

    protected $fillable = [
        'id',
        'empresa',
        'cnpf_cnpj',
        'fantasia',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'cep',
        'complemento',
        'observacoes',
        'telefone1',
        'telefone2',
        'telefone3'
    ];

    /**
     * Tem que usar para identificar campos fixos na tabela
     */
    public static function getCustomColumns(): array
    {
        return [
            'id',
            'empresa',
            'cnpf_cnpj',
            'fantasia',
            'logradouro',
            'numero',
            'bairro',
            'cidade',
            'uf',
            'cep',
            'complemento',
            'observacoes',
            'telefone1',
            'telefone2',
            'telefone3'
        ];
    }
}
