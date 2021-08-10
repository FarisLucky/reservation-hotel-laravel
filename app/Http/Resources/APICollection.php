<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class APICollection extends ResourceCollection
{

    public $collects = APIResource::class;

    public function toArray($request)
    {
        return [
            'data' => $this->collection
        ];
    }
}
