<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    private $email;
    private $name;
    private $contents;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inputs)
    {
        $this->email = $inputs['email'];
        $this->name = $inputs['name'];
        $this->contents  = $inputs['contents'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->view('view.name');
        return $this
            ->from('example@gmail.com')
            ->subject('自動送信メール')
            ->view('mails.contact')
            ->with([
                'email' => $this->email,
                'name' => $this->name,
                'contents'  => $this->contents,
            ]);
    }
}
