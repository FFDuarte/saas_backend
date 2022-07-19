<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Vendas extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Database table
     */
    protected $table = 'vendas';


    protected $fillable = [
        'id',
        'usuario_id',
        'tenant_id',
        'observacoes',
        'entrega_id',
        'forma_pagamento',
        'forma_pagamento_id',
        'cupom_id',
        'cupom_desconto_valor',
        'status',
        'valor_total_produtos',
        'valor_total_descontos',
        'valor_total_pedido',
        'data_hora_faturamento'
    ];

    protected $casts = [
        'valor_total_produtos'  => 'float',
        'valor_total_descontos' => 'float',
        'valor_total_pedido'    => 'float',
    ];

    protected $dates = [];

    /**
     * Validation rules for fields.
     */
    public static $rules = [];

    /**
     * Enable Timestamps.
     */
    public $timestamps = true;

    // Relationships
    public function usuario()
    {
        /**
         * Relacionamento do usuario e sua compra
         */
        return $this->hasOne('App\Models\UserApp', 'id', 'usuario_id');
    }

    public function endereco()
    {
        /**
         * Relacionamento da venda com endereco do usuario
         */
        return $this->hasOne('App\Models\UsuarioEndereco', 'id', 'entrega_id');
    }
}
