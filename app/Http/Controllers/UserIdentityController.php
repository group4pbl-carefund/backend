<?php
namespace App\Http\Controllers;

use App\Http\Requests\UserIdentity\StoreUserIdentityRequest;
use App\Http\Requests\UserIdentity\UpdateUserIdentityRequest;
use App\Http\Resources\UserIdentityResource;
use App\Models\UserIdentity;

class UserIdentityController extends Controller
{

    /**
     * Menampilkan daftar identitas pengguna.
     *
     * Mengambil semua data identitas (KTP/Passport) yang telah diunggah pengguna.
     */
    public function index()
    {
        return $this->successResponse(UserIdentityResource::collection(UserIdentity::all()));
    }

    /**
     * Mengunggah identitas baru.
     *
     * Menambahkan dokumen identitas baru untuk verifikasi akun pengguna.
     */
    public function store(StoreUserIdentityRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('identity_image')) {
            $path = $request->file('identity_image')->store('identities', 'public');
            $data['identity_image'] = '/storage/' . $path;
        }

        return $this->successResponse(new UserIdentityResource(UserIdentity::create($data)));
    }

    /**
     * Menampilkan detail identitas.
     *
     * Mengambil informasi lengkap dari satu dokumen identitas berdasarkan ID.
     */
    public function show(UserIdentity $userIdentity)
    {
        return $this->successResponse(new UserIdentityResource($userIdentity));
    }

    /**
     * Memperbarui data identitas.
     *
     * Mengubah informasi pada dokumen identitas yang sudah ada.
     */
    public function update(UpdateUserIdentityRequest $request, UserIdentity $userIdentity)
    {
        $userIdentity->update($request->validated());
        return $this->successResponse(new UserIdentityResource($userIdentity));
    }

    /**
     * Menghapus identitas.
     *
     * Menghapus record dokumen identitas dari database secara permanen.
     */
    public function destroy(UserIdentity $userIdentity)
    {
        $userIdentity->delete();
        return $this->deletedResponse();
    }
}