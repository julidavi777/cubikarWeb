<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class commercialOfferAssignedNotification extends Mailable
{
    use Queueable, SerializesModels;
    public $consecutivo;
    public $company_name;
    public $responsable_type;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($consecutivo, $company_name, $responsable_type)
    {
        $this->consecutivo = $consecutivo;
        $this->company_name =  $company_name;
        $this->responsable_type =  $responsable_type;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Notificación de asignación Cubikar')
                    ->from('cubikarsystems@gmail.com', '[Notificación Cubikar]')
                    ->view('mail.commercialOffer.commercialoffer-assigned-notification')
                    ->with([
                        "consecutivo" => $this->consecutivo,
                        "company_name" => $this->company_name,
                        "responsabletype" => $this->responsable_type == "responsable_comercial" ? "responsable comercial" : "responsable operativo",
                    ]);
    }
}
