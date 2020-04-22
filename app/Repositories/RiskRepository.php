<?php

namespace App\Repositories;

use App\Models\Risk;
use App\Repositories\BaseRepository;

/**
 * Class RiskRepository
 * @package App\Repositories
 * @version April 19, 2020, 5:43 pm UTC
*/

class RiskRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'en_name',
        'alert',
        'level',
        'class'
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
        return Risk::class;
    }
}
