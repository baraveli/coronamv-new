<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Resource;

/**
 * Class ResourceFilter
 * @package App\Models
 * @version April 17, 2020, 11:38 pm UTC
 *
 * @property string name
 * @property string sub
 */
class ResourceFilter extends Model
{
    public $table = 'resource_filters';
    




    public $fillable = [
        'name',
        'sub'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'sub' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'sub' => 'required'
    ];

    
}
