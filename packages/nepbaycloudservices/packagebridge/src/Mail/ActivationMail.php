<?php

namespace Nepbaycloudservices\PackageBridge\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivationMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $activationlink;
    protected $user;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($activationlink,$user)
    {
        $this->activationlink = $activationlink; 
        $this->user = $user;      
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $site= config('app.name');
        return $this->subject("Welcome to $site")
        ->view('packagebridge::.Email.activation')       
        ->with(['activationlink' => $this->activationlink, 'user'=> $this->user]);

        //->markdown('frontend.emails.usercreated');
    }
}
