<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProject extends Model
{
    public function userProjectDetail()
    {
        return $this->hasMany(UserProjectDetail::class);
    }

    public function userProjectImage()
    {
        return $this->hasMany(UserProjectImage::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
