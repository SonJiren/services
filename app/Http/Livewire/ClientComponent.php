<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;

class ClientComponent extends Component
{
    public $clients;
    public $clientModal = false;
    public $confirmDeleteClientModal = false;

    public $name;
    public $phone;
    public $country;
    public $city;
    public $home;
    public $client_id;

    protected $rules = [
        'name' => 'required|max:255',
        'phone' => 'required|max:255',
        'country' => 'required|max:255',
        'city' => 'required|max:255',
        'home' => 'required|max:255',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }



    public function render()
    {
        $this->clients = Client::all();
        return view('livewire.client-component');
    }

    public function addClient()
    {
        $this->validate();

        Client::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'country' => $this->country,
            'city' => $this->city,
            'home' => $this->home,
        ]);

        $this->resetFields();

        $this->clientModal = false;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->country = '';
        $this->city = '';
        $this->home = '';
    }

    public function closeModal()
    {
        $this->clientModal = false;
        $this->confirmDeleteClientModal = false;
        $this->resetFields();
    }
}
