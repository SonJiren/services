<?php

namespace App\Notifications;

use App\Models\Job;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PaymentNotification extends Notification
{
    use Queueable;

    protected $job_id;
    protected $cost;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Job $job, $amount)
    {
        $this->job_id = $job;
        $this->cost = $amount;
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
                    ->subject('¡Pago completado!')
                    ->line('Se ha realizado un pago por el servicio: ' . $this->job_id->name)
                    ->line('Cantidad: $' . $this->cost)
                    ->action('Ver detalles del servicio', url('/'))
                    ->line('Gracias por utilizar nuestro servicio.');
    }
}
