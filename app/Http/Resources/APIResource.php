<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class APIResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => [
                $this->getKeyName() => $this->getKey(),
                'type' => $this->type(),
                'attributes' => $this->allowedAttributes(),
            ],
        ];
    }
}
