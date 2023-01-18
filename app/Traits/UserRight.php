<?php

namespace App\Traits;

use Illuminate\Support\Facades\Auth;


trait UserRight
{
    use HttpResponse;
    public function validateRight($ability)
    {
        $user = Auth::user();

        if (!$user->tokenCan($ability)) {
            return $this->error(null, 'Permission Error.Insufficient user right', 403);
        }
    }
}
