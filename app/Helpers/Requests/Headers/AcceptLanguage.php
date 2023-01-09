<?php
namespace App\Helpers\Requests\Headers;

class AcceptLanguage
{
    private $acceptedLanguage;
    private $allowedLanguages = ['ko', 'en', 'jp'];
    private $defaultAcceptedLanguage = 'ko';

    public function __construct($acceptedLanguage)
    {
        $this->acceptedLanguage = strtolower($acceptedLanguage);
    }

    public function getAcceptedLanguage()
    {
        if (in_array($this->acceptedLanguage, $this->allowedLanguages)) {
            return $this->acceptedLanguage;
        } else {
            return $this->defaultAcceptedLanguage;
        }
    }
}


