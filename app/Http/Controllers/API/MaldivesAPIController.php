<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateMaldivesAPIRequest;
use App\Http\Requests\API\UpdateMaldivesAPIRequest;
use App\Models\Maldives;
use App\Repositories\MaldivesRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class MaldivesController
 * @package App\Http\Controllers\API
 */

class MaldivesAPIController extends AppBaseController
{
    /** @var  MaldivesRepository */
    private $maldivesRepository;

    public function __construct(MaldivesRepository $maldivesRepo)
    {
        $this->maldivesRepository = $maldivesRepo;
    }

    /**
     * Display a listing of the Maldives.
     * GET|HEAD /maldives
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $maldives = $this->maldivesRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($maldives->toArray(), 'Maldives retrieved successfully');
    }

    /**
     * Store a newly created Maldives in storage.
     * POST /maldives
     *
     * @param CreateMaldivesAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateMaldivesAPIRequest $request)
    {
        $input = $request->all();

        $maldives = $this->maldivesRepository->create($input);

        return $this->sendResponse($maldives->toArray(), 'Maldives saved successfully');
    }

    /**
     * Display the specified Maldives.
     * GET|HEAD /maldives/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Maldives $maldives */
        $maldives = $this->maldivesRepository->find($id);

        if (empty($maldives)) {
            return $this->sendError('Maldives not found');
        }

        return $this->sendResponse($maldives->toArray(), 'Maldives retrieved successfully');
    }

    /**
     * Update the specified Maldives in storage.
     * PUT/PATCH /maldives/{id}
     *
     * @param int $id
     * @param UpdateMaldivesAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateMaldivesAPIRequest $request)
    {
        $input = $request->all();

        /** @var Maldives $maldives */
        $maldives = $this->maldivesRepository->find($id);

        if (empty($maldives)) {
            return $this->sendError('Maldives not found');
        }

        $maldives = $this->maldivesRepository->update($input, $id);

        return $this->sendResponse($maldives->toArray(), 'Maldives updated successfully');
    }

    /**
     * Remove the specified Maldives from storage.
     * DELETE /maldives/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Maldives $maldives */
        $maldives = $this->maldivesRepository->find($id);

        if (empty($maldives)) {
            return $this->sendError('Maldives not found');
        }

        $maldives->delete();

        return $this->sendSuccess('Maldives deleted successfully');
    }
}
