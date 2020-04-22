<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Test
 * @package App\Models
 * @version April 19, 2020, 5:26 pm UTC
 *
 * @property integer total_tested
 * @property integer total_positive
 * @property integer total_negative
 * @property integer total_pending
 */
class Test extends Model
{
    use SoftDeletes;

    public $table = 'tests';


    protected $dates = ['deleted_at'];



    public $fillable = [
        'total_tested',
        'total_positive',
        'total_negative',
        'total_pending'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'total_tested' => 'integer',
        'total_positive' => 'integer',
        'total_negative' => 'integer',
        'total_pending' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'total_tested' => 'required',
        'total_positive' => 'required',
        'total_negative' => 'required',
        'total_pending' => 'required'
    ];


    public function GetLatestTest()
    {
        return $this->latest('created_at')->first();
    }
}
