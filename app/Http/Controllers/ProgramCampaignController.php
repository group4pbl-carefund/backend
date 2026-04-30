<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProgramCampaignRequest;
use App\Http\Requests\UpdateProgramCampaignRequest;
use App\Http\Resources\ProgramCampaignResource;
use App\Models\ProgramCampaign;
use App\Services\ProgramCampaignService;

class ProgramCampaignController extends Controller
{
    protected $campaignService;

    public function __construct(ProgramCampaignService $campaignService)
    {
        $this->campaignService = $campaignService;
    }

    public function index()
    {
        return ProgramCampaignResource::collection($this->campaignService->getAllCampaigns());
    }

    public function store(StoreProgramCampaignRequest $request)
    {
        $campaign = $this->campaignService->createCampaign($request->validated());
        return new ProgramCampaignResource($campaign);
    }

    public function show(ProgramCampaign $programCampaign)
    {
        return new ProgramCampaignResource($programCampaign);
    }

    public function update(UpdateProgramCampaignRequest $request, ProgramCampaign $programCampaign)
    {
        $updatedCampaign = $this->campaignService->updateCampaign($programCampaign, $request->validated());
        return new ProgramCampaignResource($updatedCampaign);
    }

    public function destroy(ProgramCampaign $programCampaign)
    {
        $this->campaignService->deleteCampaign($programCampaign);
        return response()->noContent();
    }
}