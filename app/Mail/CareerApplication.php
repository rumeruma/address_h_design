<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CareerApplication extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('career@addresshelp360.com', 'Career')
            ->markdown('mail.application')
            ->with('content', $this->content)
            ->attach($this->content['file']['path'], ['as' => $this->content['file']['name'], 'mime' => $this->content['file']['mime']]);
    }
}
