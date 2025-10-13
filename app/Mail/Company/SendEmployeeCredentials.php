<?php

namespace App\Mail\Company;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendEmployeeCredentials extends Mailable
{
    use Queueable, SerializesModels;

    private string $employeeName;
    private string $employeeCpf;
    private string $employeePassword;

    /**
     * Create a new message instance.
     */
    public function __construct(
        $employeeName,
        $employeeCpf,
        $employeePassword
    )
    {
        $this->employeeName = $employeeName;
        $this->employeeCpf = $employeeCpf;
        $this->employeePassword = $employeePassword;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Help Point: Envio de Credenciais',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'company.emails.employee-credentials',
        )->with([
            'employeeName' => $this->employeeName, 
            'employeeCpf' => $this->employeeCpf, 
            'employeePassword' => $this->employeePassword
        ]);
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
