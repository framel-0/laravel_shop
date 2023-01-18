<?php

namespace App\Repository\Eloquent;

use App\Models\UnitOfMeasure;
use App\Repository\IUnitOfMeasureRepository;

class UnitOfMeasureRepository extends BaseRepository implements IUnitOfMeasureRepository
{
    /**
     * @var model
     */
    protected $model;

    public function __construct(UnitOfMeasure $model)
    {
        $this->model = $model;
    }
}
