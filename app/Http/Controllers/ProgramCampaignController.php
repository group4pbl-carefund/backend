<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProgramCampaign\StoreProgramCampaignRequest;
use App\Http\Requests\ProgramCampaign\UpdateProgramCampaignRequest;
use App\Http\Resources\ProgramCampaignResource;
use App\Models\ProgramCampaign;
use App\Services\ProgramCampaignService;
use Illuminate\Http\Request;

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
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        return $this->successResponse(ProgramCampaignResource::collection($this->campaignService->getAllCampaigns($userId)));
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
        return $this->successResponse(new ProgramCampaignResource($programCampaign->load('program')));
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

    /**
     * Memperpanjang durasi kampanye.
     *
     * Menambahkan 7 hari ke end_date program terkait.
     */
    public function extend(ProgramCampaign $programCampaign)
    {
        $updatedCampaign = $this->campaignService->extendCampaign($programCampaign);
        return $this->successResponse(new ProgramCampaignResource($updatedCampaign));
    }
}