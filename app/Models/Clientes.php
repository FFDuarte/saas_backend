<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Clientes extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Database table
     */
    protected $table = 'ordem_de_servico';


    protected $fillable = [
        'id',
        'nome',
        'cpf',
        'data_nascimento',
        'rua',
        'numero',
        'cep',
        'cidade',
        'uf',
        'pais',
        'email',
        'telefone',
        'tenant_id'
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
