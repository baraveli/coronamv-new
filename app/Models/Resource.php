<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Class Resource
 * @package App\Models
 * @version April 17, 2020, 11:35 pm UTC
 *
 * @property string title
 * @property string body
 * @property string resource_embed_image
 * @property string resource_link
 * @property integer resources_filter_id
 * @property string contact
 */
class Resource extends Model
{

    public $table = 'resources';



    public $fillable = [
        'title',
        'body',
        'image',
        'resource_link',
        'resource_tag',
        'contact'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'body' => 'string',
        'image' => 'string',
        'resource_link' => 'string',
        'resource_tag' => 'string',
        'contact' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'title' => 'required',
        'body' => 'required',
        'resource_link' => 'required',
        'resource_tag' => 'required'
    ];

    public function setImageAttribute($file)
    {
        if ($file) {
            // perform the store here

            $name = time() . '.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];

            \Image::make($file)->save(public_path('images/resources/') . $name);

            // save the file path to the database field
            $this->attributes['image'] = $name;
        }
    }
}
