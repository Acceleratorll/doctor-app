<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class StatusEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $reservation;

    public function __construct($reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this->view('emails.reservation.status')
            ->subject('Reservasi Anda')
            ->with([
                'reservation' => $this->reservation,
            ]);
    }
}