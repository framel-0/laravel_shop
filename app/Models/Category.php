<?php

namespace App\Models;

use App\Models\Common\AuditableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends AuditableModel
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'description'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
