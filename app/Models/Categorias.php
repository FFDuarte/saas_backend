<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Categorias extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Database table
     */
    protected $table = 'categorias';


    protected $fillable = [
        'id',
        'nome',
        'tenant_id',
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

}
