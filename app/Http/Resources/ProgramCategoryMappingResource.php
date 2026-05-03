<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramCategoryMappingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
<<<<<<< HEAD
            'id' => $this->id,
=======
            'id' => $this->id, // Asumsi tabel mapping ini menggunakan default 'id' auto-increment
>>>>>>> dev-nada
            'program_id' => $this->program_id,
            'category_id' => $this->category_id,
        ];
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> dev-nada
