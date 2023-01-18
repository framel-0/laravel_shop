<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Repository\ICategoryRepository;

class CategoryRepository extends BaseRepository implements ICategoryRepository
{
    /**
     * @var model
     */
    protected $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }
}
