<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;

class UsuarioEndereco extends Model
{

    use SoftDeletes;

    /**
     * Database table
     */
    protected $table = 'usuarios_enderecos';


    protected $fillable = [

        'usuario_id',
        'complemento',
        'logradouro',
        'municipio',
        'numero',
        'bairro',
        'cep',
        'uf',
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
