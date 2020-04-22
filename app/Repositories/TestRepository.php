<?php

namespace App\Repositories;

use App\Models\Test;
use App\Repositories\BaseRepository;

/**
 * Class TestRepository
 * @package App\Repositories
 * @version April 19, 2020, 5:26 pm UTC
*/

class TestRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'total_tested',
        'total_positive',
        'total_negative',
        'total_pending'
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
        return Test::class;
    }
}
