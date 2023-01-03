<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PendingConfirmationPayment extends Notification
{
    use Queueable;

    protected $fillable = ['id']; 

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
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $order = Order::find($notifiable['id']);
        $address = (is_null($order->address)) ? 'Not Defined' : ($order->address->street . ', nº' . $order->address->number);
        $card = (is_null($order->card)) ? 'Not Defined' : ($order->card->number);

        return (new MailMessage)
                    ->subject('Order nº'. $notifiable['id'])
                    ->line('Hello ' . $order->user->first_name . '! Your Order nº'. $notifiable['id'] . ' is waiting for payment approval!')
                    ->action('View your order', url('/order/'.$notifiable['id']))
                    ->line('Address: ' . $address)
                    ->line('Card: '.  $card)
                    ->line('Thank you for shopping on our website!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $order = Order::find($notifiable['id']);
        return [
            'title' => 'Pending payment approval!',
            'text' => 'Your Order '. $notifiable['id'] . ' is waiting for payment approval!',
        ];
    }
}