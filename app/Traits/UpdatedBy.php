<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait UpdatedBy
{
    public static function bootUpdatedBy()
    {
        static::updating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                if (!$model->isDirty('updated_by')) {
                    $model->updated_by = auth()->user()->id;
                }
            }
        });
    }
}
