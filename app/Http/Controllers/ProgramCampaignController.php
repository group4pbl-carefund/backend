<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramCampaign\StoreProgramCampaignRequest;
use App\Http\Requests\ProgramCampaign\UpdateProgramCampaignRequest;
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

    /**
     * Menampilkan daftar data.
     *
     * Endpoint ini mengembalikan semua record yang tersedia.
     */
    public function index()
    {
        return $this->successResponse(ProgramCampaignResource::collection($this->campaignService->getAllCampaigns()));
    }

    /**
     * Menambahkan data baru.
     *
     * Endpoint ini digunakan untuk membuat record baru di database.
     */
    public function store(StoreProgramCampaignRequest $request)
    {
        $campaign = $this->campaignService->createCampaign($request->validated());
        return $this->successResponse(new ProgramCampaignResource($campaign));
    }

    /**
     * Menampilkan detail data.
     *
     * Endpoint ini mengembalikan detail spesifik dari sebuah record berdasarkan ID.
     */
    public function show(ProgramCampaign $programCampaign)
    {
        return $this->successResponse(new ProgramCampaignResource($programCampaign));
    }

    /**
     * Memperbarui data.
     *
     * Endpoint ini digunakan untuk mengupdate record yang sudah ada di database.
     */
    public function update(UpdateProgramCampaignRequest $request, ProgramCampaign $programCampaign)
    {
        $updatedCampaign = $this->campaignService->updateCampaign($programCampaign, $request->validated());
        return $this->successResponse(new ProgramCampaignResource($updatedCampaign));
    }

    /**
     * Menghapus data.
     *
     * Endpoint ini digunakan untuk menghapus record dari database secara permanen.
     */
    public function destroy(ProgramCampaign $programCampaign)
    {
        $this->campaignService->deleteCampaign($programCampaign);
        return $this->deletedResponse();
    }
}