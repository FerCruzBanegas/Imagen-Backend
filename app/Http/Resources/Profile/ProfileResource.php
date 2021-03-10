<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'action_list' => $this->action_list,
            'created' => $this->created_at,
            'updated' => $this->updated_at,
        ];
    }
}
