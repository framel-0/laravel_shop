<?php

namespace App\Models\Common;

use App\Traits\CreatedBy;
use App\Traits\DeletedBy;
use App\Traits\UpdatedBy;
use Illuminate\Database\Eloquent\Model;


class AuditableModel extends Model
{
    use CreatedBy;
    use UpdatedBy;
    use DeletedBy;
}
