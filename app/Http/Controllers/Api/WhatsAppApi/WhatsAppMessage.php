<?php


namespace App\Http\Controllers\Api\WhatsAppApi;


class WhatsAppMessage
{
    public $content;

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }
}
