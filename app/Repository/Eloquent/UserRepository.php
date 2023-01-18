<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\IUserRepository;

class UserRepository extends BaseRepository implements IUserRepository
{
    /**
     * @var model
     */
    protected $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }
}
