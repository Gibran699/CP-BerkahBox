<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReminderEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $donatur;
    public $program;

    public function __construct($donatur, $program)
    {
        $this->donatur = $donatur;
        $this->program = $program;
    }

    public function build()
    {
        return $this->subject('Pengingat Donasi Sedekah Jum\'at')
                    ->view('emails.reminder');
    }
}