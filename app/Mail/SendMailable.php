<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailable extends Mailable
{
    use Queueable, SerializesModels;
    
     public $mailData;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($mailData)
    {
         $this->mailData = $mailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $input = array(
                      'name'     => $this->mailData['name'],
                      'email'     => $this->mailData['email'],
                      'message'     => $this->mailData['message'],
                  );
        return $this->markdown('mails.mail')
        ->with([
                    'inputs' => $input,
                  ]);
     
    }



}
