<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class ProdutosFotos extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Database table
     */
    protected $table = 'produtos_fotos';


    protected $fillable = [
        'id',
        'id_produto',
        'principal',
        'foto_small',
        'foto_red',
        'foto_orig'
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
