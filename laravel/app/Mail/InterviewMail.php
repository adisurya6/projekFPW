<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class InterviewMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $user;
    protected $job;
    protected $company;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $job, $company)
    {
        $this->user = $user;
        $this->job =$job;
        $this->company =$company;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Job Finder Interview',
            from: new Address('adisuryaputra875@gmail.com', 'Adi Surya Putra'),
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'sendinterview',
            with: [
               'user' => $this->user,
               'company' => $this->company,
               'job' => $this->job
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
