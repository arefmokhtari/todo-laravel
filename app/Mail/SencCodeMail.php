<?php

namespace App\Mail;

use App\Helpers\Traits\HasInitialize;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SencCodeMail extends Mailable
{
    use Queueable, SerializesModels, HasInitialize;

    private mixed $code;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(mixed $code) {
        $this->code = $code;
    }

    public function build(): SencCodeMail {
        return $this->subject('send email')->view('mail', ['otp' => $this->code]);
    }


}
