<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AddInvoices extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
     private $invoices_id;
    public function __construct($invoices_id)
    {
        //
        $this->invoices_id = $invoices_id;
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
        $url = "http://127.0.0.1:8000/ar/Details/".$this->invoices_id;
        return (new MailMessage)
//                    ->subject(__('messages.Add invoices'))
                    ->subject(__('Developer_Mohamed'))
                    ->line(__('messages.Add invoices'))
                    ->action('messages.show invoices', $url)
                    ->line(__('messages.Thanks Uses The Developer System Invoices'));
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
            //
        ];
    }
}
