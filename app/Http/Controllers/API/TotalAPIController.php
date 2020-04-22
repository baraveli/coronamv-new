<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateTotalAPIRequest;
use App\Http\Requests\API\UpdateTotalAPIRequest;
use App\Models\Total;
use App\Repositories\TotalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class TotalController
 * @package App\Http\Controllers\API
 */

class TotalAPIController extends AppBaseController
{
    /** @var  TotalRepository */
    private $totalRepository;

    public function __construct(TotalRepository $totalRepo)
    {
        $this->totalRepository = $totalRepo;
    }

    /**
     * Display a listing of the Total.
     * GET|HEAD /totals
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $totals = $this->totalRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($totals->toArray(), 'Totals retrieved successfully');
    }

    /**
     * Store a newly created Total in storage.
     * POST /totals
     *
     * @param CreateTotalAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateTotalAPIRequest $request)
    {
        $input = $request->all();

        $total = $this->totalRepository->create($input);

        return $this->sendResponse($total->toArray(), 'Total saved successfully');
    }

    /**
     * Display the specified Total.
     * GET|HEAD /totals/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Total $total */
        $total = $this->totalRepository->find($id);

        if (empty($total)) {
            return $this->sendError('Total not found');
        }

        return $this->sendResponse($total->toArray(), 'Total retrieved successfully');
    }

    /**
     * Update the specified Total in storage.
     * PUT/PATCH /totals/{id}
     *
     * @param int $id
     * @param UpdateTotalAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateTotalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Total $total */
        $total = $this->totalRepository->find($id);

        if (empty($total)) {
            return $this->sendError('Total not found');
        }

        $total = $this->totalRepository->update($input, $id);

        return $this->sendResponse($total->toArray(), 'Total updated successfully');
    }

    /**
     * Remove the specified Total from storage.
     * DELETE /totals/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Total $total */
        $total = $this->totalRepository->find($id);

        if (empty($total)) {
            return $this->sendError('Total not found');
        }

        $total->delete();

        return $this->sendSuccess('Total deleted successfully');
    }
}
