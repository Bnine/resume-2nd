<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProjectImage extends Model
{
    public function userProject()
    {
        return $this->belongsTo(UserProject::class);
    }

    public function projectImage()
    {
        return $this->belongsTo(ProjectImage::class);
    }
}
