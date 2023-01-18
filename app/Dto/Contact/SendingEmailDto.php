<?php 

namespace App\Dto\Contact;

class SendingEmailDto
{
    private $emailAddress;
    private $subject;
    private $name;
    private $content;

    public function __construct(
        string $emailAddress,
        string $subject,
        string $name,
        string $content
    ) {
        $this->emailAddress = $emailAddress;
        $this->subject = $subject;
        $this->name = $name;
        $this->content = $content;
    }

    public function getEmailAddress(): string
    {
        return $this->emailAddress;
    }

    public function getSubject(): string
    {
        return $this->subject;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getContent(): string
    {
        return $this->content;
    }
}

?>