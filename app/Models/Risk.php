<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Risk
 * @package App\Models
 * @version April 19, 2020, 5:43 pm UTC
 *
 * @property string name
 * @property string en_name
 * @property string alert
 * @property unsignedInteger level
 * @property string class
 */
class Risk extends Model
{
    use SoftDeletes;

    public $table = 'risks';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'en_name',
        'alert',
        'level',
        'class'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'name' => 'string',
        'en_name' => 'string',
        'alert' => 'string',
        'class' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'en_name' => 'required',
        'alert' => 'required',
        'level' => 'required',
        'class' => 'required'
    ];

    
}
