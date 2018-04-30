<?php

namespace Nepbaycloudservices\Plugins\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EticketMail extends Mailable
{
    use Queueable, SerializesModels;

    
    protected $details;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->details = $details;     
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

          return $this->subject('Your Ticket has been issued.')->view('plugins::Domflight.eticket-mail-template');

       /* $passangerDetils = json_decode($this->details['orderDetails']->order_passanger_details, true);  
       
        return $this->subject('Your Ticket has been issued.')
        ->view('plugins::Domflight.eticket-mail-template')
        ->attach('ticket-'.$this->details['order']->order_id.'.pdf', [
                'as' => 'Ticket.pdf',
                'mime' => 'application/pdf',
            ])
        ->with(['passangerDetils' => $passangerDetils]);*/

        /*$site= config('app.name');
        return $this->subject("Welcome to $site")
        ->view('packagebridge::.Email.activation')       
        ->with(['activationlink' => $this->activationlink, 'user'=> $this->user]);*/

        //->markdown('frontend.emails.usercreated');
    }
}
