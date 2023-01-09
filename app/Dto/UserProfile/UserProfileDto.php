<?php 

namespace App\Dto\UserProfile;

class UserProfileDto
{
    private $id;
    private $acceptedLanguage;

    public function __construct(int $id, string $acceptedLanguage)
    {
        $this->id = $id;
        $this->acceptedLanguage = $acceptedLanguage;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getAcceptedLanguage(): string
    {
        return $this->acceptedLanguage;
    }
}

?>