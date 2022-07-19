<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Produtos extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Database table
     */
    protected $table = 'produtos';


    protected $fillable = [
        'id',
        'codigo',
        'descricao',
        'und_saida',
        'qtd',
        'preco_custo',
        'preco_venda',
        'categoria',
        'tenant_id',
    ];

    protected $casts = [
        'preco_custo' => 'float',
        'preco_venda' => 'float',
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
    public function fotos()
    {
        /**
         * Relacionamento de tenant com usuário principal
         */
        return $this->hasOne('App\Models\ProdutosFotos', 'id', 'id');
    }
}
