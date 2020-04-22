<?php

namespace App\Http\Controllers\API;

use App\Exports\ResourceExport;
use App\Http\Requests\API\CreateResourceAPIRequest;
use App\Http\Requests\API\UpdateResourceAPIRequest;
use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Models\ResourceFilter;
use Maatwebsite\Excel\Facades\Excel;

/**
 * Class ResourceController
 * @package App\Http\Controllers\API
 */

class ResourceAPIController extends AppBaseController
{
    /** @var  ResourceRepository */
    private $resourceRepository;

    public function __construct(ResourceRepository $resourceRepo)
    {
        $this->resourceRepository = $resourceRepo;
    }

    /**
     * Display a listing of the Resource.
     * GET|HEAD /resources
     *
     * @param Request $request
     * @return Response
     */
    public function index(Resource $resource, ResourceFilter $filters)
    {
        $resources = collect(
            [
                "resources" => $resource->orderBy('created_at', 'desc')->get(),
                "filters" => $filters->all()->toArray()
            ]
        );


        return $this->sendResponse($resources->toArray(), 'Resources retrieved successfully');
    }

    /**
     * Store a newly created Resource in storage.
     * POST /resources
     *
     * @param CreateResourceAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateResourceAPIRequest $request)
    {
        $input = $request->all();

        $resource = $this->resourceRepository->create($input);

        return $this->sendResponse($resource->toArray(), 'Resource saved successfully');
    }

    /**
     * Display the specified Resource.
     * GET|HEAD /resources/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Resource $resource */
        $resource = $this->resourceRepository->find($id);

        if (empty($resource)) {
            return $this->sendError('Resource not found');
        }

        return $this->sendResponse($resource->toArray(), 'Resource retrieved successfully');
    }

    /**
     * Update the specified Resource in storage.
     * PUT/PATCH /resources/{id}
     *
     * @param int $id
     * @param UpdateResourceAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateResourceAPIRequest $request)
    {
        $input = $request->all();


        /** @var Resource $resource */
        $resource = $this->resourceRepository->find($id);

        if (empty($resource)) {
            return $this->sendError('Resource not found');
        }

        if (!empty($request->get('image'))) {
            //Delete the already attached image
            $image_path = public_path('images/resources/') . $resource->image;
            if (file_exists($image_path)) {
                unlink($image_path);
            }
        }

        if (empty($request->get('image'))) {
            //Set to existing image
            $input[0]["image"] = $resource->image;
        }



        $resource = $this->resourceRepository->update($input, $id);

        return $this->sendResponse($resource->toArray(), 'Resource updated successfully');
    }

    /**
     * Remove the specified Resource from storage.
     * DELETE /resources/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Resource $resource */
        $resource = $this->resourceRepository->find($id);

        if (empty($resource)) {
            return $this->sendError('Resource not found');
        }

        //Delete the image file from storage
        $image_path = public_path('images/resources/') . $resource->image;
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        $resource->delete();

        return $this->sendSuccess('Resource deleted successfully');
    }


        
    /**
     * export
     * 
     *  Export the model to csv
     *
     * @return void
     */
    public function export()
    {
        return Excel::download(new ResourceExport, 'resources.csv');
    }
}
