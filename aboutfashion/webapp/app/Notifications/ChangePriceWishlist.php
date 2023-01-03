<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ChangePriceWishlist extends Notification
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
        $product = Product::find($notifiable['id']);
        return (new MailMessage)
                    ->subject('Product '. $product->name .' has changed price')
                    ->line('The product '.$product->name.' in your wishlist has changed its price to '.$product->price)
                    ->action('View Product', url('/products/'.$product->id))
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
        $product = Product::find($notifiable['id']);
        return [
            'title' => 'Changed Product Price',
            'text' => 'The product '.$product->name.' in your wishlist has changed its price to '.$product->price,
        ];
    }
}