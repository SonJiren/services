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

/*
public function updateClientService()
    {
        $this->validate([
            'client_id' => 'required',
            'job_id' => 'required',
            'cost' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'date' => 'required',
        ]);

        $clientservice = ClientService::findOrFail($this->clientservice_id);
        $clientservice->update([
            'client_id' => $this->client_id,
            'job_id' => $this->job_id,
            'cost' => $this->cost,
            'country' => $this->selectedCountry,
            'city' => $this->city,
            'address' => $this->address,
            'date' => $this->date,
        ]);
        Notification::route('mail', 'liderthragg@gmail.com')
        ->notify(new PaymentNotification($clientservice->job_id, $clientservice->cost));

        $this->closeModal();
    }
*/