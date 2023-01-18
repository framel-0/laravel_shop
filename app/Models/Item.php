<?php

namespace App\Models;

use App\Models\Common\AuditableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends AuditableModel
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'items';
    protected $fillable = [
        'description',
        'category_id',
        'unit_of_measure_id',
        'location_id',
        'sale_price',
        'cost_price',
        'quantity',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit_of_measure()
    {
        return $this->belongsTo(UnitOfMeasure::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
