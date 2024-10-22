<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MeuEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $dados;


    public function __construct($dados)
    {
        $this->dados = $dados;
    }


    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->dados['assunto'] ?? 'Assunto Padrão',
        );
    }


    public function content(): Content
    {
        return new Content(
            view: $this->dados['view'],
            with: $this->dados,
        );
    }


    public function attachments(): array
    {
        return [];
    }

}