<?php

namespace App\Services\UserProfile;

use App\Repositories\Interfaces\UserProfileRepositoryInterface;
use App\Dto\UserProfile\UserProfileDto;

class UserProfileService
{
    private $userProfileRepository;
    private $isKo = 'ko';
    private $isEn = 'en';
    private $isJp = 'jp';

    public function __construct(UserProfileRepositoryInterface $userProfileRepository)
    {
        $this->userProfileRepository = $userProfileRepository;
    }

    public function getUserProfileData(UserProfileDto $userProfileDto): array
    {
        $userProfileData = $this->userProfileRepository->findUserProfile($userProfileDto->getId());

        return $this->setResponseData($userProfileData, $userProfileDto->getAcceptedLanguage());
    }

    private function setResponseData(object $data, string $acceptedLanguage): array
    {
        $returnData = array();

        if ($acceptedLanguage === $this->isKo) {
            $returnData = $this->responseStructrue(
                $data->name_ko,
                $data->university_ko,
                $data->comment_ko,
                $data->birth,
                $data->profile_photo,
                $data->email
            );
        } elseif ($acceptedLanguage === $this->isEn) {
            $returnData = $this->responseStructrue(
                $data->name_en,
                $data->university_en,
                $data->comment_en,
                $data->birth,
                $data->profile_photo,
                $data->email
            );
        } elseif ($acceptedLanguage === $this->isJp) {
            $returnData = $this->responseStructrue(
                $data->name_jp,
                $data->university_jp,
                $data->comment_jp,
                $data->birth,
                $data->profile_photo,
                $data->email
            );
        } else {
            $returnData = $this->responseStructrue(
                $data->name_ko,
                $data->university_ko,
                $data->comment_ko,
                $data->birth,
                $data->profile_photo,
                $data->email
            );
        } 

        return $returnData;
    }

    private function responseStructrue(
        string $name,
        string $university,
        string $comment,
        string $birth,
        string $profilePhoto,
        string $email
    ): array {
        return array(
            'name' => $name,
            'university' => $university,
            'comment' => $comment,
            'birth' => $birth,
            'profilePhoto' => config('images.host').$profilePhoto,
            'email' => $email
        );
    }
}

?>