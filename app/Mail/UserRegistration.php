<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistration extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $html_body = "Your Information has been saved successfully !!!<br><br>";
        $html_body += "Please find below credentials.<br>";
        $html_body += "Email : ,strong>$user->email</strong>";
        $html_body += "$password : $user->original_password<br>";
        $html_body += "localhost/otf_coader/public/login<br>";

        return $this->subject("Registerd")->view('email',['html_body'=>$html_body]);
    }
}
