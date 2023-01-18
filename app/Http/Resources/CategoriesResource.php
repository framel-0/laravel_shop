<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriesResource extends JsonResource
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
            'type' => 'Category',
            'id' => $this->id,
            'attributes' => [
                'description' => $this->description,
            ],
            'links' => [
                'self' => route('apiv1categories.show', $this->id),
                'parent' => route('apiv1categories.index'),
            ],
        ];
    }
}
