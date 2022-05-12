<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ModelEmail extends Mailable
{

    use Queueable,
        SerializesModels;

    public $vars;
//    public $theme = 'my-theme';
    private $template = 'mail.register';

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vars, $template = 'mail.register')
    {
        $this->vars = $vars;
        $this->template = $template;
    }

    public function setTheme($param)
    {
        $this->theme = $param;
        return $this;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->theme = 'funky_table';
        return $this->from('loftphp@yandex.ru')
                        ->text($this->template);
    }

}
