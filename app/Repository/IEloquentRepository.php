<?php


namespace App\Repository;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

interface IEloquentRepository
{

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
        ): Collection;

    /**
     * Get all models
     *
     * @param array $columns
     * @param array $relations
     * @return Collection
     */
    public function allTrashed(array $columns = ['*'], array $relations = []): Collection;


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
        array $appends = []
    ): ?Model;

    /**
     * Find trashed model by id
     *
     * @param $modelId
     * @return Model
     */
    public function findTrashedById(
        $modelId
    ): ?Model;

    /**
     * Find trashed model by id
     *
     * @param $modelId
     * @return Model
     */
    public function findOnlyTrashedById(
        $modelId
    ): ?Model;



    /**
     * Create a model
     *
     * @param array $payload
     * @return Model
     */
    public function create(
        array $payload
    ): ?Model;

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
    ): ?Model;


    /**
     * Delete model by id
     *
     * @param $modelId
     * @return bool
     */
    public function deleteById(
        $modelId
    ): bool;


    /**
     * Restore model by id
     *
     * @param $modelId
     * @return bool
     */
    public function restoreById(
        $modelId
    ): bool;


    /**
     * Permanentlt delete model by id
     *
     * @param $modelId
     * @return bool
     */
    public function permanentlyDeleteById(
        $modelId
    ): bool;
}
