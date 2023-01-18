<?php

namespace App\Models;

use App\Models\Common\AuditableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnitOfMeasure extends AuditableModel
{
    use HasFactory;

    protected $table = 'unit_of_measures';

    protected $fillable = [
        'description'
    ];

     public function items()
     {
       return $this->hasMany(Item::class);
     }
}
