<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Model;
use Stancl\Tenancy\Database\Concerns\BelongsToTenant;

class Carros extends Model
{

    use SoftDeletes;
    use BelongsToTenant;

    /**
     * Database table
     */
    protected $table = 'carros';


    protected $fillable = [
        'id',
        'placa',
        'ano',
        'modelo',
        'fabricante',
        'cliente',
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
