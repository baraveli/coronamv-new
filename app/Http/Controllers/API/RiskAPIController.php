<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateRiskAPIRequest;
use App\Http\Requests\API\UpdateRiskAPIRequest;
use App\Models\Risk;
use App\Repositories\RiskRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use Response;

/**
 * Class RiskController
 * @package App\Http\Controllers\API
 */

class RiskAPIController extends AppBaseController
{
    /** @var  RiskRepository */
    private $riskRepository;

    public function __construct(RiskRepository $riskRepo)
    {
        $this->riskRepository = $riskRepo;
    }

    /**
     * Display a listing of the Risk.
     * GET|HEAD /risks
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $risks = $this->riskRepository->all(
            $request->except(['skip', 'limit']),
            $request->get('skip'),
            $request->get('limit')
        );

        return $this->sendResponse($risks->toArray(), 'Risks retrieved successfully');
    }

    /**
     * Store a newly created Risk in storage.
     * POST /risks
     *
     * @param CreateRiskAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateRiskAPIRequest $request)
    {
        $input = $request->all();

        $risk = $this->riskRepository->create($input);

        return $this->sendResponse($risk->toArray(), 'Risk saved successfully');
    }

    /**
     * Display the specified Risk.
     * GET|HEAD /risks/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Risk $risk */
        $risk = $this->riskRepository->find($id);

        if (empty($risk)) {
            return $this->sendError('Risk not found');
        }

        return $this->sendResponse($risk->toArray(), 'Risk retrieved successfully');
    }

    /**
     * Update the specified Risk in storage.
     * PUT/PATCH /risks/{id}
     *
     * @param int $id
     * @param UpdateRiskAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateRiskAPIRequest $request)
    {
        $input = $request->all();

        /** @var Risk $risk */
        $risk = $this->riskRepository->find($id);

        if (empty($risk)) {
            return $this->sendError('Risk not found');
        }

        $risk = $this->riskRepository->update($input, $id);

        return $this->sendResponse($risk->toArray(), 'Risk updated successfully');
    }

    /**
     * Remove the specified Risk from storage.
     * DELETE /risks/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Risk $risk */
        $risk = $this->riskRepository->find($id);

        if (empty($risk)) {
            return $this->sendError('Risk not found');
        }

        $risk->delete();

        return $this->sendSuccess('Risk deleted successfully');
    }
}
