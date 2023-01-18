<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LocationsResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'Location',
            'id' => $this->id,
            'attributes' => [
                'name' => $this->name,
                'address' => $this->address,
                'phone_number' => $this->phone_number,
                'mobile_number' => $this->mobile_number,
            ],
            'relationships' => [],
            'links' => [
                'self' => route('apiv1locations.show', $this->id),
                'parent' => route('apiv1locations.index'),
            ],

        ];
    }
}
