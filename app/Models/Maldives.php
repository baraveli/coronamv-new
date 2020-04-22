<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Maldives
 * @package App\Models
 * @version April 19, 2020, 5:40 pm UTC
 *
 * @property string name
 * @property string administrative_atoll
 * @property unsignedInteger confirmed
 * @property unsignedInteger recovered
 * @property unsignedInteger deaths
 * @property unsignedInteger active
 * @property number lat
 * @property number long
 */
class Maldives extends Model
{
    use SoftDeletes;

    public $table = 'maldives';
    

    protected $dates = ['deleted_at'];



    public $fillable = [
        'name',
        'div_name',
        'administrative_atoll',
        'confirmed',
        'recovered',
        'deaths',
        'active',
        'lat',
        'long'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'div_name' => 'string',
        'name' => 'string',
        'administrative_atoll' => 'string',
        'lat' => 'float',
        'long' => 'float'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'div_name' => 'required',
        'administrative_atoll' => 'required',
        'confirmed' => 'required',
        'recovered' => 'required',
        'deaths' => 'required',
        'active' => 'required'
    ];

    
}
