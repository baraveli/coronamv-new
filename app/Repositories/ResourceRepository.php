<?php

namespace App\Repositories;

use App\Models\Resource;
use App\Repositories\BaseRepository;

/**
 * Class ResourceRepository
 * @package App\Repositories
 * @version April 17, 2020, 11:35 pm UTC
*/

class ResourceRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'title',
        'body',
        'resource_embed_image',
        'resource_link',
        'resources_filter_id',
        'contact'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Resource::class;
    }
}
