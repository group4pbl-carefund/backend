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
     * Menampilkan daftar kampanye program.
     *
     * Mengambil semua data kampanye yang sedang berjalan untuk program donasi.
     */
    public function index()
    {
        return $this->successResponse(ProgramCampaignResource::collection($this->campaignService->getAllCampaigns()));
    }

    /**
     * Membuat kampanye baru.
     *
     * Mendaftarkan kampanye penggalangan dana baru untuk sebuah program.
     */
    public function store(StoreProgramCampaignRequest $request)
    {
        $campaign = $this->campaignService->createCampaign($request->validated());
        return $this->successResponse(new ProgramCampaignResource($campaign));
    }

    /**
     * Menampilkan detail kampanye.
     *
     * Mengambil informasi lengkap dari sebuah kampanye berdasarkan ID.
     */
    public function show(ProgramCampaign $programCampaign)
    {
        return $this->successResponse(new ProgramCampaignResource($programCampaign));
    }

    /**
     * Memperbarui data kampanye.
     *
     * Mengubah detail informasi pada kampanye yang sudah ada.
     */
    public function update(UpdateProgramCampaignRequest $request, ProgramCampaign $programCampaign)
    {
        $updatedCampaign = $this->campaignService->updateCampaign($programCampaign, $request->validated());
        return $this->successResponse(new ProgramCampaignResource($updatedCampaign));
    }

    /**
     * Menghapus kampanye.
     *
     * Menghapus data kampanye dari database secara permanen.
     */
    public function destroy(ProgramCampaign $programCampaign)
    {
        $this->campaignService->deleteCampaign($programCampaign);
        return $this->deletedResponse();
    }
}