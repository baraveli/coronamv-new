<?php

namespace App\Repositories;

use App\Models\Maldives;
use App\Repositories\BaseRepository;

/**
 * Class MaldivesRepository
 * @package App\Repositories
 * @version April 19, 2020, 5:40 pm UTC
*/

class MaldivesRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'administrative_atoll',
        'confirmed',
        'recovered',
        'deaths',
        'active',
        'lat',
        'long'
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
        return Maldives::class;
    }
}
