<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Invocie;

class AddInvoicesNotification extends Notification
{
    use Queueable;
    private $invoices_id;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Invocie $invoices_id)
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
//        return ['mail'];
        return ['database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
    public function toDatabase($notifiable)
    {
        return [
            //'project_id' => $this->project['id']
            'id' => $this->invoices_id->id,
            'title' => 'تم اضافة فاتورة جديدة بواسطة:',
            'user' => auth()->user()->name,
        ];
    }
}
