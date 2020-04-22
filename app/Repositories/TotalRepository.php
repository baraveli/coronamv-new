<?php

namespace App\Repositories;

use App\Models\Total;
use App\Repositories\BaseRepository;

/**
 * Class TotalRepository
 * @package App\Repositories
 * @version April 17, 2020, 11:21 pm UTC
*/

class TotalRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'total_confirmed',
        'total_recovered',
        'total_active',
        'total_death',
        'local_confirmed'
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
        return Total::class;
    }
}
