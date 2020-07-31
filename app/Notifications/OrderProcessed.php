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
        $distributorName = $this->order->distributor->name;

        return (new WhatsAppMessage)
            ->content("Tu orden ha sido procesada, {$distributorName}");
    }
}
