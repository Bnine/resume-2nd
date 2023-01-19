<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserProfileRepositoryInterface;
use App\Models\UserProfile;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public function __construct()
    {

    }

    public function findUserProfile(int $id): object
    {
        return UserProfile::find($id);
    }
}
