<?php

namespace App\Payments;

class PaymentGateway
{
    protected $amount;
    protected $token;

    public function __construct($amount, $token)
    {
        $this->amount = $amount;
        $this->token = $token;
    }

    public function processPayment()
    {
        //Insertar más cosas si se desea...
        return true; //Pago exitoso
    }
}


