<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Total
 * @package App\Models
 * @version April 17, 2020, 11:21 pm UTC
 *
 * @property integer total_confirmed
 * @property integer total_recovered
 * @property integer total_active
 * @property integer total_death
 * @property integer local_confirmed
 */
class Total extends Model
{

    public $table = 'totals';
    



    public $fillable = [
        'total_confirmed',
        'total_recovered',
        'total_active',
        'total_death',
        'local_confirmed'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'total_confirmed' => 'integer',
        'total_recovered' => 'integer',
        'total_active' => 'integer',
        'total_death' => 'integer',
        'local_confirmed' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'total_confirmed' => 'required',
        'total_recovered' => 'required',
        'total_active' => 'required',
        'total_death' => 'required',
        'local_confirmed' => 'required'
    ];

    public function GetLatestTotal()
    {
        return $this->latest('created_at')->first();
    }

    
}
