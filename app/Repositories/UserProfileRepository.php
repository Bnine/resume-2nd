<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserProfileRepositoryInterface;
use App\Models\UserProfile;

class UserProfileRepository implements UserProfileRepositoryInterface
{
    public function __construct()
    {

    }

    /**
     * @param int $id member id
     *
     * @return array
     */
    public function findUserProfile(int $id): object
    {
        return UserProfile::find($id);
    }
}
