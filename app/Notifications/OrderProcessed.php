<?php

namespace App\Notifications;

use App\Http\Controllers\Api\WhatsAppApi\WhatsAppMessage;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Http\Controllers\Api\WhatsAppApi\WhatsAppChannel;

class OrderProcessed extends Notification
{
    use Queueable;


    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    public function toWhatsApp($notifiable)
    {
        $distributor = $this->order->distributor;

        $listOfProducts = '';

        $currency = $this->order->branch->address->country->id == 1 ? "MXN" : "US";

        foreach ($this->order->products as $product){

            $listOfProducts .= $product->pivot->quantity." ".$product->name." ".$currency.number_format($product->pivot->price,2)."\n";

        }

        $message = $distributor->name." ".$distributor->tonic_life_id."\n".
                   "\n".
                    $listOfProducts.
                   "\n".
                   "Total:\n".
                   "Precio distribuidor: ".$currency.number_format($this->order->total_price,2)."\n".
                   "Tax: ".$currency.number_format($this->order->total_taxes,2)."\n".
                   "Puntos: ".$this->order->total_accumulated_points;

        return (new WhatsAppMessage)
            ->content("{$message}");
    }
}
