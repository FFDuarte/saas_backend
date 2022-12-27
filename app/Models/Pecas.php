<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Pecas extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Database table
     */
    protected $table = 'pecas';


    protected $fillable = [
        'id',
        'nome',
        'marca',
        'aplicacao',
        'categoria',
        'preco',
        'material',
        'descricao',
        'tenant_id',
    ];

    protected $casts = [
        'preco' => 'float'
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
