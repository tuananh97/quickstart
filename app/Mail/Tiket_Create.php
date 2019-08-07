<?php

namespace App\Mail;
use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Tiket_Create extends Mailable
{
    use Queueable, SerializesModels;
    public $ticket;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Ticket $ticket)
    {
        $this->subject('There is a new ticket!');
        $this->ticket = $ticket;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.ticket')
                    ->with([
                        'ticketName' => $this->ticket->title,
                        'ticketID' => $this->ticket->slug,
                    ]);;
    }
}
