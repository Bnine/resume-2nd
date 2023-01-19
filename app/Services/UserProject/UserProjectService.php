<?php

namespace App\Services\UserProject;

use App\Repositories\Interfaces\UserProjectRepositoryInterface;
use App\Dto\UserProject\UserProjectDto;

class UserProjectService
{
    private $userProjectRepository;
    private $isKo = 'ko';
    private $isEn = 'en';
    private $isJp = 'jp';

    public function __construct(UserProjectRepositoryInterface $userProjectRepository)
    {
        $this->userProjectRepository = $userProjectRepository;
    }

    public function getUserProjectData(UserProjectDto $userProjectDto): array
    {
        $returnData = array();
        $userProfileData = $this->userProjectRepository->getUserProjects($userProjectDto->getUserId());

        foreach ($userProfileData as $val) {
            $returnData[] = array(
                'projectInfo' => $this->setResponseData($val, $userProjectDto->getAcceptedLanguage()),
                'skills' => $this->setSkillsResponseData($val->id),
                'details' => $this->setProjectDetailResponseData($val->id, $userProjectDto->getAcceptedLanguage()),
            );
        }

        return $returnData;
    }

    private function setResponseData(object $data, string $acceptedLanguage): array
    {
        $returnData = array();

        if ($acceptedLanguage === $this->isKo) {
            $returnData = $this->responseStructrue(
                $data->company_ko,
                $data->rank_ko,
                $data->position_ko,
                $data->location_ko,
                $data->period_st,
                $data->period_ed,
                $data->country_photo
            );
        } elseif ($acceptedLanguage === $this->isEn) {
            $returnData = $this->responseStructrue(
                $data->company_en,
                $data->rank_en,
                $data->position_en,
                $data->location_en,
                $data->period_st,
                $data->period_ed,
                $data->country_photo
            );
        } elseif ($acceptedLanguage === $this->isJp) {
            $returnData = $this->responseStructrue(
                $data->company_jp,
                $data->rank_jp,
                $data->position_jp,
                $data->location_jp,
                $data->period_st,
                $data->period_ed,
                $data->country_photo
            );
        } else {
            $returnData = $this->responseStructrue(
                $data->company_ko,
                $data->rank_ko,
                $data->position_ko,
                $data->location_ko,
                $data->period_st,
                $data->period_ed,
                $data->country_photo
            );
        } 

        return $returnData;
    }

    private function setSkillsResponseData(int $userProjectId): array
    {
        $returnData = array();

        foreach ($this->userProjectRepository->getUserProjectImages($userProjectId) as $val) {
            $returnData[] = $this->responseSkillsStructrue(
                $val->projectimage->id,
                $val->projectimage->image_name,
                $val->projectimage->image_path
            );
        }

        return $returnData;
    }

    private function setProjectDetailResponseData(int $userProjectId, string $acceptedLanguage): array
    {
        $returnData = array();

        foreach ($this->userProjectRepository->getUserProjectDetails($userProjectId) as $val) {
            if ($acceptedLanguage === $this->isKo) {
                $returnData[] = $this->responseProjectDetailStructrue(
                    $val->id,
                    $val->project_name_ko,
                    $val->project_detail_ko
                );
            /*
            } elseif ($acceptedLanguage === $this->isEn) {
                $returnData[] = $this->responseProjectDetailStructrue(
                    $val->id,
                    $val->project_name_en,
                    $val->project_detail_en
                );
            } elseif ($acceptedLanguage === $this->isJp) {
                $returnData[] = $this->responseProjectDetailStructrue(
                    $val->id,
                    $val->project_name_jp,
                    $val->project_detail_jp
                );
            */
            } else {
                $returnData[] = $this->responseProjectDetailStructrue(
                    $val->id,
                    $val->project_name_ko,
                    $val->project_detail_ko
                );
            } 
        }

        return $returnData;
    }

    private function responseSkillsStructrue(
        string $imageId,
        string $imageName,
        string $imagePath
    ): array {
        return array(
            'imageId' => $imageId,
            'imageName' => $imageName,
            'imagePath' => config('images.host').$imagePath,
        );
    }

    private function responseProjectDetailStructrue(
        int $projectId,
        string $projectName,
        string $projectDetail
    ): array {
        return array(
            'projectId' => $projectId,
            'projectName' => $projectName,
            'projectDetail' => $projectDetail,
        );
    }

    private function responseStructrue(
        string $company,
        string $rank,
        string $position,
        string $location,
        string $periodStart,
        string $periodEnd,
        string $country
    ): array {
        return array(
            'company' => $company,
            'rank' => $rank,
            'position' => $position,
            'location' => $location,
            'periodStart' => $periodStart,
            'periodEnd' => $periodEnd,
            'country' => config('images.host').$country,
        );
    }
}