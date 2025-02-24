<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PermintaanKajian extends Notification
{
    use Queueable;

    protected $body;
    protected $file;
    /**
     * Create a new notification instance.
     */
    public function __construct($body, $filePath)
    {
        $this->body = $body;
        $this->file = $filePath;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $mail = (new MailMessage)
            ->subject('Download File Kajian Proyek Investasi')
            ->line($this->body)
            ->line('Thank you for using our application!');
        if ($this->file) {
            $filePath = storage_path('app/public/' . $this->file);
            if (file_exists($filePath)) {
                $mail->attach($filePath, [
                    'as' => 'File_Kajian.pdf',
                    'mime' => 'application/pdf',
                ]);
            }
        }
        return $mail;
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
