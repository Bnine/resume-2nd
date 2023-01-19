<?php
namespace App\Repositories;

use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Models\UserProject;
use App\Models\UserProjectDetail;
use App\Models\UserProjectImage;


class UserProjectRepository implements UserProjectRepositoryInterface
{
    public function __construct()
    {
        
    }

    public function getUserProjects(int $user_id): object
    {
        return UserProject::where('user_id', $user_id)
            ->orderByDesc('id')
            ->get();
    }

    public function getUserProjectDetails(int $user_project_id): object
    {
        return UserProjectDetail::where('user_project_id', $user_project_id)
            ->orderByDesc('order')
            ->get();
    }

    public function getUserProjectImages(int $user_project_id): object
    {
        return UserProjectImage::with('projectimage')
            ->where('user_project_id', $user_project_id)
            ->orderBy('order')
            ->get();
    }
}
