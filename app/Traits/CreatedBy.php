<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait CreatedBy
{
    public static function bootCreatedBy()
    {
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'created_by')) {
                if (!$model->isDirty('created_by')) {
                    $model->created_by = auth()->user()->id;
                }
            }
            if (Schema::hasColumn($model->getTable(), 'updated_by')) {
                if (!$model->isDirty('updated_by')) {
                    $model->updated_by = auth()->user()->id;
                }
            }
        });
    }
}
