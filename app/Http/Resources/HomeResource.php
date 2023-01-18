<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeResource extends JsonResource
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
            'info' => [
                'title' => 'Laravel',
                'version' => 'v1',
                'license' => [
                    'name' => '',
                    'url' => '',
                ],
            ],

            // 'paths' => [
            //     'categories' => [
            //         'get' => 'api/v1/categories',
            //         'post' => 'api/v1/categories',
            //         'get' => 'api/v1/categories/{category_id}',
            //     ],
            //     'api/v1/categories' => [
            //         'post' => [
            //             'tag' => 'categories'
            //         ]
            //     ],
            //     'api/v1/categories/{category_id}' => [
            //         'get' => [
            //             'tag' => 'categories'
            //         ]
            //     ],
            //     'api/v1/items' => [
            //         'get' => [
            //             'tag' => 'items'
            //         ]
            //     ],
            //     'api/v1/items' => [
            //         'post' => [
            //             'tag' => 'items'
            //         ]
            //     ],
            //     'api/v1/items/{item_id}' => [
            //         'get' => [
            //             'tag' => 'items'
            //         ]
            //     ],
            //     'api/v1/locations' => [
            //         'get' => [
            //             'tag' => 'locations'
            //         ]
            //     ],
            //     'api/v1/locations' => [
            //         'post' => [
            //             'tag' => 'locations'
            //         ]
            //     ],
            //     'api/v1/locations/{location_id}' => [
            //         'get' => [
            //             'tag' => 'locations'
            //         ]
            //     ],
            //     'api/v1/unitofmeasures' => [
            //         'get' => [
            //             'tag' => 'unit_of_measures'
            //         ]
            //     ],
            //     'api/v1/unitofmeasures' => [
            //         'post' => [
            //             'tag' => 'unit_of_measures'
            //         ]
            //     ],
            //     'api/v1/unitofmeasures/{unit_of_measures_id}' => [
            //         'get' => [
            //             'tag' => 'unit_of_measures'
            //         ]
            //     ],
            //     'api/v1/users' => [
            //         'get' => [
            //             'tag' => 'users'
            //         ]
            //     ],
            // ],

        ];
    }
}
