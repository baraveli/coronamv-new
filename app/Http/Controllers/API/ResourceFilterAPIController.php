<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateResourceFilterAPIRequest;
use App\Http\Requests\API\UpdateResourceFilterAPIRequest;
use App\Models\ResourceFilter;
use App\Repositories\ResourceFilterRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class ResourceFilterController
 * @package App\Http\Controllers\API
 */

class ResourceFilterAPIController extends AppBaseController
{
    /** @var  ResourceFilterRepository */
    private $resourceFilterRepository;

    public function __construct(ResourceFilterRepository $resourceFilterRepo)
    {
        $this->resourceFilterRepository = $resourceFilterRepo;
    }

    /**
     * Display a listing of the ResourceFilter.
     * GET|HEAD /resourceFilters
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $resourceFilters = $this->resourceFilterRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($resourceFilters->toArray(), 'Resource Filters retrieved successfully');
    }

    /**
     * Store a newly created ResourceFilter in storage.
     * POST /resourceFilters
     *
     * @param CreateResourceFilterAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateResourceFilterAPIRequest $request)
    {
        $input = $request->all();

        $resourceFilter = $this->resourceFilterRepository->create($input);

        return $this->sendResponse($resourceFilter->toArray(), 'Resource Filter saved successfully');
    }

    /**
     * Display the specified ResourceFilter.
     * GET|HEAD /resourceFilters/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var ResourceFilter $resourceFilter */
        $resourceFilter = $this->resourceFilterRepository->find($id);

        if (empty($resourceFilter)) {
            return $this->sendError('Resource Filter not found');
        }

        return $this->sendResponse($resourceFilter->toArray(), 'Resource Filter retrieved successfully');
    }

    /**
     * Update the specified ResourceFilter in storage.
     * PUT/PATCH /resourceFilters/{id}
     *
     * @param int $id
     * @param UpdateResourceFilterAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResourceFilterAPIRequest $request)
    {
        $input = $request->all();

        /** @var ResourceFilter $resourceFilter */
        $resourceFilter = $this->resourceFilterRepository->find($id);

        if (empty($resourceFilter)) {
            return $this->sendError('Resource Filter not found');
        }

        $resourceFilter = $this->resourceFilterRepository->update($input, $id);

        return $this->sendResponse($resourceFilter->toArray(), 'ResourceFilter updated successfully');
    }

    /**
     * Remove the specified ResourceFilter from storage.
     * DELETE /resourceFilters/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var ResourceFilter $resourceFilter */
        $resourceFilter = $this->resourceFilterRepository->find($id);

        if (empty($resourceFilter)) {
            return $this->sendError('Resource Filter not found');
        }

        $resourceFilter->delete();

        return $this->sendSuccess('Resource Filter deleted successfully');
    }
}
