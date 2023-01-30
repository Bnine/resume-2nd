<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class Contact extends Mailable
{
    use Queueable, SerializesModels;

    private $emailAddress;
    public $subject;
    private $name;
    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
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
        Log::debug(__METHOD__.' emailAddress -> '.$this->emailAddress);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)
                ->from($this->emailAddress, $this->name)
                ->with([
                    'emailAddress' => $this->emailAddress,
                    'content' => $this->content,
                ])
                ->view('emails.contact');
    }
}
