<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailVerifyLinkSender extends Mailable
{
    use Queueable, SerializesModels;

    private $e_subject = "";
    private $e_user_id = "";
    private $e_code = "";

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($e_subject, $e_user_id, $e_code)
    {
        $this->e_subject = $e_subject;
        $this->e_user_id = $e_user_id;
        $this->e_code = $e_code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('components.emailVerify')
            ->with('e_user_id', $this->e_user_id)
            ->with('e_code', $this->e_code)
            ->subject($this->e_subject);
    }
}
