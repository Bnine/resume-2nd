<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProjectDetail extends Model
{
    public function userProject()
    {
        return $this->belongsTo(UserProject::class);
    }
}
