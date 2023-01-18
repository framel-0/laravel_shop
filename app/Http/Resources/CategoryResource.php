<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'type' => 'Category',
            'id' => $this->id,
            'attributes' => [
                'description' => $this->description,
            ],
            'relationships' => [],
            'links' => [
                'self' => route('apiv1categories.show', $this->id),
                'parent' => route('apiv1categories.index'),
            ],
        ];
    }
}
