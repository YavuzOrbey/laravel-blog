<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ContactMe extends Mailable
{
    use Queueable, SerializesModels;


    //public properties 
    public $email, $name, $subject, $message_text, $ip;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data, $request)
    {
        $this->email = $data['email'];
        $this->name = $data['fullname'];
        $this->subject = $data['subject'];
        $this->message_text = $data['message'];
        $this->ip = $request->ip();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->email)->view('emails.contact');
    }
}
