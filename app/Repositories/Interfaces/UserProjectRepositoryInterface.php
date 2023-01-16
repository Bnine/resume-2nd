<?php

namespace App\Repositories\Interfaces;

/**
 * Interface MainRepositoryInterface
 */
interface UserProjectRepositoryInterface
{
   public function getUserProjects(int $user_id): object;

   public function getUserProjectDetails(int $user_project_id): object;

   public function getUserProjectImages(int $user_project_id): object;
}
