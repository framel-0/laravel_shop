<?php

namespace App\Repository\Eloquent;

use App\Repository\IEloquentRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements IEloquentRepository
{
    /**
     * @var model
     */
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * Get all models
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function all(
        array $columns = ['*'],
        array $relations = [],
        string $orderBy = null
    ): Collection {
        $entities = $this->model->with($relations);

        if (!is_null($orderBy)) {
            $entities->orderBy($orderBy);
        }
        return $entities->get($columns);
    }

    /**
     * Get all models
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function allTrashed(array $columns = ['*'], array $relations = []): Collection
    {
        return $this->model
            ->onlyTrashed()
            ->with($relations)
            ->get($columns);
    }


    /**
     * Find model by id
     *
     * @param $modelId
     * @param array $relations
     * @param array $appends
     * @return Model
     */
    public function findById(
        $modelId,
        array $columns = ['*'],
        array $relations = [],
        array $appends = [],
    ): ?Model {
        return $this->model
            ->select($columns)
            ->with($relations)
            ->find($modelId);
    }

    /**
     * Find trashed model by id
     *
     * @param $modelId
     * @return Model
     */
    public function findTrashedById(
        $modelId
    ): ?Model {
        return $this->model
            ->withTrashed()
            ->findOrFail($modelId);
    }

    /**
     * Find trashed model by id
     *
     * @param $modelId
     * @return Model
     */
    public function findOnlyTrashedById(
        $modelId
    ): ?Model {
        return $this->model
            ->onlyTrashed()
            ->findOrFail($modelId);
    }



    /**
     * Create a model
     *
     * @param array $payload
     * @return Model
     */
    public function create(
        array $payload
    ): ?Model {
        $model = $this->model->create($payload);
        return $model->fresh();
    }

    /**
     * Update a model
     *
     * @param $modelId
     * @param array $payload
     * @return bool
     */
    public function update(
        $modelId,
        array $payload,
    ): ?Model {
        $model = $this->findById($modelId);
        if (is_null($model)) {
            return null;
        }
        $model->update($payload);
        return $model->fresh();
    }


    /**
     * Delete model by id
     *
     * @param $modelId
     * @return bool
     */
    public function deleteById(
        $modelId
    ): bool {
        $model = $this->findById($modelId);
        return $model->delete();
    }


    /**
     * Restore model by id
     *
     * @param $modelId
     * @return bool
     */
    public function restoreById(
        $modelId
    ): bool {
        $model = $this->findOnlyTrashedById($modelId);
        return $model->restore();
    }


    /**
     * Permanentlt delete model by id
     *
     * @param $modelId
     * @return bool
     */
    public function permanentlyDeleteById(
        $modelId
    ): bool {
        $model = $this->findTrashedById($modelId);
        return $model->forceDelete();
    }
}
