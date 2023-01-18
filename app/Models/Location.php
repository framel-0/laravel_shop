<?php

namespace App\Models;

use App\Models\Common\AuditableModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Location extends AuditableModel
{
    use HasFactory;

    protected $table = 'locations';

    protected $fillable = [
        'name', 'address', 'phone_number', 'mobile_number'
    ];

    public function items()
    {
        return $this->hasMany(Item::class);
    }
}
