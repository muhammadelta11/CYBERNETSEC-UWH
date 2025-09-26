<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class UserRejectedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Notifikasi: Akun Anda Ditolak')
                    ->from('22103041067@student.unwahas.ac.id', 'CyberNetSec UWH Admin')
                    ->greeting('Halo ' . $notifiable->name . ',')
                    ->line('Kami informasikan bahwa setelah ditinjau oleh administrator, akun Anda tidak dapat disetujui untuk saat ini.')
                    ->line('Hal ini mungkin disebabkan oleh ketidaksesesuaian dengan persyaratan yang berlaku.')
                    ->line('Untuk informasi lebih lanjut, silakan hubungi administrator kami.')
                    ->action('Hubungi Administrator', 'mailto:22103041067@student.unwahas.ac.id')
                    ->line('Anda dapat mencoba mendaftar ulang dengan data yang benar dan memastikan semua persyaratan terpenuhi.')
                    ->salutation('Salam,')
                    ->salutation('Tim CyberNetSec UWH');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'message' => 'Akun Anda telah ditolak oleh administrator',
            'status' => 'rejected',
            'timestamp' => now()
        ];
    }
}
