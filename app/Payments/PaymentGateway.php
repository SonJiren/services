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
        return true; //Pago exitoso
    }
}
