<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class SendCodeDocument extends Notification
{
    use Queueable;

    protected $codeDocument;
    protected $namaBerkas;
    public function __construct($codeDocument,$namaBerkas)
    {
        $this->codeDocument = $codeDocument;
        $this->namaBerkas = $namaBerkas;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                ->subject('Siberta')
                ->greeting('KODE BERKAS ' . strtoupper($this->namaBerkas) )
                ->line($this->codeDocument)
                ->line('Gunakan Kode Berkas Ini Untuk Melakukan Pelacakan Berkas Anda.');
    }

    public function toArray($notifiable)
    {
        return [
            // Data tambahan jika diperlukan
        ];
    }
}

