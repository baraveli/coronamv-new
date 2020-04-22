<?php

namespace App\Repositories;

use App\Models\ResourceFilter;
use App\Repositories\BaseRepository;

/**
 * Class ResourceFilterRepository
 * @package App\Repositories
 * @version April 17, 2020, 11:38 pm UTC
*/

class ResourceFilterRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'sub'
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
        return ResourceFilter::class;
    }
}
