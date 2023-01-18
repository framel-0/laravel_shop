<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UnitOfMeasuresResource extends JsonResource
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
            'type' => 'UnitOfMeasure',
            'id' => $this->id,
            'attributes' => [
                'description' => $this->description,
            ],
            'relationships' => [],
            'links' => [
                'self' => route('apiv1unitofmeasures.show', $this->id),
                'parent' => route('apiv1unitofmeasures.index'),
            ],
        ];
    }
}
