<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class VendasItens extends Model
{

    use SoftDeletes;

    /**
     * Database table
     */
    protected $table = 'vendas_itens';


    protected $fillable = [
        'id',
        'venda_id',
        'codigo',
        'descricao',
        'und',
        'observacoes',
        'foto_orig',
        'foto_red',
        'foto_small',
        'qtd',
        'valor_custo_unitario',
        'valor_custo_total',
        'valor_desconto_unitario',
        'valor_desconto_total',
        'valor_unitario',
        'valor_total'
    ];

    protected $casts = [
        'valor_unitario'  => 'float',
        'valor_total' => 'float',
        'valor_custo_unitario'    => 'float',
        'valor_custo_total'    => 'float',
        'valor_desconto_unitario'    => 'float',
        'valor_desconto_total'    => 'float',
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


}
