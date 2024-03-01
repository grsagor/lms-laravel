<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $body;
    public $subject;
    public function __construct($body, $subject)
    {
        $this->body = $body;
        $this->subject = $subject;
    }

    public function build()
    {
        return $this->subject($this->subject)
        ->view('shared.mail.default')
            ->with(['body' => $this->body]);
    }

}
