<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyAccountNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        //
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Verificar cuenta Cubikar')
                    ->from('cubikarsystems@gmail.com', '[Notificación Cubikar]')
                    ->view('mail.auth.verify-account-notification')
                    ->with([
                        'token' => $this->token,
                    ]);
    }
}
