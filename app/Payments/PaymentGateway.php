<?php

namespace App\Payments;

class PaymentGateway
{
    protected $amount;
    protected $token;

    public function __construct($amount, $token)
    {
        $this->amount = $amount;
        $this ->token = $token;
    }

    public function processPayment()
    {
        //Insertar más cosas si se desea...
        return true; //Pago exitoso
    }
}


/*class PaymentGateway
{
    public function charge($amount, $token)
    {
        //Retornar respuesta exitosa.
        return [
            'amount' => $amount,
            'confirmation_number' => Str::random(),
            'currency' => 'USD',
        ];
    }
}
*/
