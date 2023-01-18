<?php

namespace App\Repository\Eloquent;

use App\Models\Item;
use App\Repository\IItemRepository;

class ItemRepository extends BaseRepository implements IItemRepository
{
    /**
     * @var model
     */
    protected $model;

    public function __construct(Item $model)
    {
        $this->model = $model;
    }
}
