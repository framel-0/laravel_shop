<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait DeletedBy
{
    public static function bootDeletedBy()
    {
        static::deleting(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'deleted_by')) {
                if (!$model->isDirty('deleted_by')) {
                    $model->deleted_by = auth()->user()->id;
                }
            }
        });
    }
}
