<?php

namespace App\Http\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'forename' => $this->forename,
            'surname' => $this->surname,
            'phone' => $this->phone,
            'email' => $this->email,
            'state' => $this->state,
            'office_id' => $this->office_id,
            'profile_id' => $this->profile_id,
        ];
    }
}
