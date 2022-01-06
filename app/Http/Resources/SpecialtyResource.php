<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SpecialtyResource extends JsonResource
{

    public function toArray($request)
    {
        return
        [
          'name' => $this->name,
          'description' => $this->description,
          'status' => $this->status,
            'doctors' => UserResource::collection($this->users)
        ];
    }
}
