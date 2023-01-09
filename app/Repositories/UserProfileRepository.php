<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserProfileRepositoryInterface;
use App\Models\UserProfile;

class UserProfileRepository extends BaseRepository implements UserProfileRepositoryInterface
{
    /**
     * UserProfileRepository constructor.
     *
     * @param UserProfile $model
     */
    public function __construct(UserProfile $model)
    {
        parent::__construct($model);
    }

    /**
     * @param int $id member id
     *
     * @return array
     */
    public function findUserProfile(int $id): object
    {
        return $this->model->find($id);
    }
}
