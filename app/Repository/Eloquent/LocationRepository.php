<?php

namespace App\Repository\Eloquent;

use App\Models\Location;
use App\Repository\ILocationRepository;

class LocationRepository extends BaseRepository implements ILocationRepository
{
    /**
     * @var model
     */
    protected $model;

    public function __construct(Location $model)
    {
        $this->model = $model;
    }
}
