<?php

namespace App\Payments;

class PaymentGateway
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
