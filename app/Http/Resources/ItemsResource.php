<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'type' => 'Item',
            'id' => $this->id,
            'attributes' => [
                'description' => $this->description,
                'sale_price' => $this->sale_price,
                'cost_price' => $this->cost_price,
                'quantity' => $this->quantity,
            ],
            'relationships' => [
                'category' => new CategoriesResource($this->category),
                'unit_of_measure' => new UnitOfMeasuresResource($this->unit_of_measure),
                'location' => new LocationsResource($this->location),
            ],
            'links' => [
                'self' => route('apiv1items.show', $this->id),
                'parent' => route('apiv1items.index'),
            ],
        ];
    }
}
