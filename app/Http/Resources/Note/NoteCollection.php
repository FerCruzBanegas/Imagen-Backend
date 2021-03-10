<?php

namespace App\Http\Resources\Note;

use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Http\Resources\Note\NoteResource;

class NoteCollection extends ResourceCollection
{
    public function toArray($request)
    {
        return [
            'data' => $this->collection->transform(function($note){
                return new NoteResource($note);
            }),
        ];
    }
}
