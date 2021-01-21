<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class MensajeRecibido extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Envio de documento';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       
        if (file_exists('./documentos/propuesta.pdf'))
        {
          
            $contents = file_get_contents('./documentos/propuesta.pdf');
    
           
            Log::debug("Existe el archivo en ./documentos/propuesta.pdf");
            
        }

        return $this->view('emails.envio-documento')
        ->attachData(file_get_contents('./documentos/propuesta.pdf'),'documento.pdf',[
            'mime' => 'application/pdf',
        ]);
    }
}
