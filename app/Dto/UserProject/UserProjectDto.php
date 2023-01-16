<?php 

namespace App\Dto\UserProject;

class UserProjectDto
{
    private $user_id;
    private $acceptedLanguage;

    public function __construct(int $user_id, string $acceptedLanguage)
    {
        $this->user_id = $user_id;
        $this->acceptedLanguage = $acceptedLanguage;
    }

    public function getUserId(): int
    {
        return $this->user_id;
    }

    public function getAcceptedLanguage(): string
    {
        return $this->acceptedLanguage;
    }
}

?>