<?php

namespace App\Notifications;

use App\Http\Controllers\Api\WhatsAppApi\WhatsAppMessage;
use App\Models\NewDistributor;
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
    public $newDistributor;

    public function __construct(Order $order, NewDistributor $newDistributor)
    {
        $this->order = $order;
        $this->newDistributor = $newDistributor;
    }

    public function via($notifiable)
    {
        return [WhatsAppChannel::class];
    }

    public function toWhatsApp($notifiable)
    {

        $message = "";

        if($this->order->id != null){
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
        } else if ($this->newDistributor->id != null) {
            $message = "Datos de inscripción de nuevo distribuidor\n".
                "\n".
                "Datos personales\n".
                "\n".
                "Nombre del distribuidor: ".$this->newDistributor->name."\n".
                "Correo electrónico: ".$this->newDistributor->email."\n".
                "Estado civil: ".$this->newDistributor->marital_status."\n".
                "Fecha de nacimiento: ".$this->newDistributor->birthday."\n".
                "Lugar de nacimiento: ".$this->newDistributor->birth_place."\n".
                "Nacionalidad: ".$this->newDistributor->nationality."\n".
                "RFC: ".$this->newDistributor->rfc_or_itin."\n".
                "CURP: ".$this->newDistributor->curp_or_ssn."\n".
                "Teléfono 1: ".$this->newDistributor->phone_1."\n".
                "Teléfono 2: ".$this->newDistributor->phone_2."\n".
                "Número de identificación: ".$this->newDistributor->no_official_identification."\n".
                "\n".
                "Domicilio\n".
                "\n".
                "Calle: ".$this->newDistributor->address->street."\n".
                "Cógigo Postal: ".$this->newDistributor->address->zip_code."\n".
                "Número exterior: ".$this->newDistributor->address->ext_num."\n".
                "Número interior: ".$this->newDistributor->address->int_num."\n".
                "Colonia: ".$this->newDistributor->address->colony."\n".
                "Ciudad: ".$this->newDistributor->address->city."\n".
                "Estado: ".$this->newDistributor->address->state."\n".
                "País: ".$this->newDistributor->address->country->name."\n".
                "\n".
                "Datos bancarios\n".
                "\n".
                "Nombre del banco: ".$this->newDistributor->dataBank->bank_name."\n".
                "Nombre del propietario: ".$this->newDistributor->dataBank->account_name."\n".
                "Número de cuenta: ".$this->newDistributor->dataBank->bank_account_number."\n".
                "CLABE: ".$this->newDistributor->dataBank->clabe_routing_bank."\n";
        }

        return (new WhatsAppMessage)
            ->content("{$message}");
    }
}
