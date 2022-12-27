<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Ordem_de_Servico extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Database table
     */
    protected $table = 'ordem_de_servico';


    protected $fillable = [
        'id',
        'cliente',
        'carro',
        'peca',
        'tenant_id',
        'valor_servico',
        'descricao_servico',
        'tenant_id',
    ];

    protected $casts = [
        'valor_servico' => 'float'
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
 
}
