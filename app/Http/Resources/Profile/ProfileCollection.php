<?php

namespace App\Http\Resources\Profile;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ProfileCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($profile){
                return [
                    'id' => $profile->id,
                    'description' => $profile->description,
                    'created' => $profile->created_at,
                    'updated' => $profile->updated_at,
                ];
            }),
        ];
    }
}
