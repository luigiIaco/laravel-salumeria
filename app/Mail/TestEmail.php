<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TestEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $userName;

    public function __construct() {}

    public function build()
    {
        return $this->subject('Benvenuto su Laravel!')
            ->view('auth.confirm');
    }
}
