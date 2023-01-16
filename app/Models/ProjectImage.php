<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    public function userProjectImage()
    {
        return $this->hasMany(UserProjectImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
