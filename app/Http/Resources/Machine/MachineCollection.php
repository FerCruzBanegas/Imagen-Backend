<?php

namespace App\Http\Resources\Machine;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MachineCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($machine){
                return [
                    'id' => $machine->id,
                    'description' => $machine->description,
                    'created' => $machine->created_at,
                    'updated' => $machine->updated_at,
                ];
            }),
        ];
    }
}
