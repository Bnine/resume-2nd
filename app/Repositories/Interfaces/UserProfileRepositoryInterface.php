<?php

namespace App\Repositories\Interfaces;

/**
 * Interface MainRepositoryInterface
 */
interface UserProfileRepositoryInterface
{
   public function findUserProfile(int $id);
}
