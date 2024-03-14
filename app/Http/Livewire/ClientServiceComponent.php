<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ClientService;
use App\Models\Client;
use App\Models\Job;
use App\Notifications\PaymentNotification;
use Illuminate\Support\Facades\Notification;



class ClientServiceComponent extends Component
{
    public $ClientServiceModal = false;
    public $confirmDeleteClientServiceModal = false;
    public $openMercadoPagoModal= false;
    public $searchCity = '';
    public $selectedCountry = 'Mexico';
    public $clientservice_id, $client_id, $job_id, $country, $city, $address, $date,$cost;
    public $jobs;

    public $edad;
    public $numeroTarjeta;
    public $vencimiento;
    public $cvv;
    public $cantidadPagar;
    public $fechaNacimiento;

    public $selectedJob;
    public $clients;
    public $countries = ['Mexico', 'Estados Unidos', 'Canadá','Rusia'];
    public $cities = [
        'Mexico' => ['Ciudad de México', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana', 'Matamoros', 'Reynosa', 'Ciudad Juárez', 'Tampico', 'Altamira', 'Ciudad Victoria', 'León', 'Zapopan', 'Mérida', 'San Luis Potosí', 'Aguascalientes', 'Hermosillo', 'Saltillo', 'Mexicali', 'Culiacán', 'Cancún', 'Chihuahua', 'Durango', 'Toluca', 'Querétaro', 'Morelia', 'Tuxtla Gutiérrez', 'Tlaxcala', 'Zacatecas', 'Victoria', 'Colima', 'La Paz', 'Cuernavaca', 'Campeche', 'Chilpancingo', 'Hidalgo', 'Oaxaca', 'Tabasco', 'Nayarit', 'Sonora', 'Yucatán', 'Chiapas', 'Guanajuato', 'Veracruz', 'Sinaloa', 'Jalisco', 'Nuevo León', 'Coahuila', 'Quintana Roo', 'Tamaulipas', 'San Luis Potosí', 'Aguascalientes', 'Durango', 'Zacatecas', 'Querétaro', 'Hidalgo', 'Tlaxcala', 'Nayarit', 'Colima', 'Quintana Roo', 'Baja California Sur', 'Campeche', 'Sonora', 'Yucatán', 'Chiapas', 'Guanajuato', 'Veracruz', 'Sinaloa', 'Jalisco', 'Nuevo León', 'Coahuila', 'Michoacán'],
        'Canadá' => ['Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Ottawa', 'Edmonton', 'Winnipeg', 'Québec', 'Hamilton', 'Victoria', 'London', 'Kitchener', 'St. Catharines', 'Halifax', 'Oshawa', 'Windsor', 'Saskatoon', 'Regina', 'Sherbrooke', 'Barrie', 'Saint John', 'Kelowna', 'Abbotsford', 'Sudbury', 'Kingston', 'Trois-Rivières', 'Chicoutimi', 'Thunder Bay', 'Moncton', 'Brantford', 'Nanaimo', 'Fredericton', 'Saint John', 'Drummondville', 'Newmarket', 'Peterborough', 'Chilliwack', 'Red Deer', 'Prince George', 'Sault Ste. Marie', 'North Bay', 'Norfolk', 'Brampton', 'Saint-Jérôme', 'Granby', 'Red Deer', 'Peterborough', 'Belleville', 'Chatham-Kent', 'Saint-Hyacinthe', 'Lethbridge', 'Moose Jaw', 'Medicine Hat', 'Granby', 'Belleville', 'Saint-Hyacinthe', 'North Bay', 'Drummondville', 'Saint-Jérôme', 'Belleville', 'Drummondville', 'North Bay', 'Granby', 'Timmins', 'Rimouski', 'Prince Albert', 'Pembroke', 'Saint-Georges', 'Rouyn-Noranda', 'Owen Sound', 'Woodstock', 'Corner Brook', 'Leamington', 'St. Thomas', 'Courtenay', 'Campbell River', 'Stratford', 'Orillia', 'New Glasgow', 'Bradford West Gwillimbury', 'Grande Prairie', 'Terrace', 'Stratford', 'Orillia', 'Cobourg', 'Amos',  'Baie-Comeau',  'Powell River', 'Sylvan Lake', 'Lloydminster', 'Kenora', 'Swift Current', 'Whitecourt', 'Estevan', 'Williams Lake', 'North Battleford', 'Wasaga Beach', 'Canmore', 'Dryden', 'Cochrane', 'Camrose', 'Innisfail', 'Wetaskiwin', 'Selkirk', 'Steinbach', 'Dauphin', 'The Pas', 'Flin Flon', 'Thompson', 'Norway House', 'Churchill', 'Yorkton', 'Melfort', 'Humboldt', 'La Ronge', 'Meadow Lake', 'Esterhazy', 'Kindersley', 'Nipawin', 'La Loche', 'Assiniboia', 'Carlyle', 'Weyburn', 'Moose Jaw', 'Swift Current', 'Estevan', 'Humboldt', 'Melville', 'Tisdale', 'Rosetown', 'Maple Creek', 'Shaunavon', 'Biggar', 'Watrous', 'Balgonie', 'Caronport', 'Eston', 'Grenfell', 'Indian Head', 'Kerrobert', 'Kipling', 'Langham', 'Lumsden', 'Manor', 'Maple Creek', 'Moosomin', 'Nokomis', 'Pilot Butte', 'Preeceville', 'Regina Beach', 'Rosthern', 'Shaunavon', 'Shellbrook', 'Unity', 'Wilkie', 'Wolseley', 'Wynyard', 'Carnduff', 'Creighton', 'Dalmeny', 'Duck Lake', 'Gull Lake', 'Lashburn', 'Macklin', 'Marsden', 'Porcupine Plain', 'Raymore', 'Redvers', 'Stoughton', 'Wadena', 'Watrous', 'Wolseley', 'Arcola', 'Balgonie', 'Bengough', 'Bredenbury', 'Burstall', 'Canora', 'Carrot River', 'Choiceland', 'Craik', 'Creelman', 'Cupar', 'Davidson', 'Dysart', 'Edenwold', 'Emerald Park', 'Esterhazy', 'Fleming', 'Foam Lake', 'Francis', 'Grenfell', 'Gull Lake', 'Hanley', 'Hepburn', 'Hudson Bay', 'Imperial', 'Indian Head', 'Ituna', 'Kamsack', 'Kelliher', 'Kelvington', 'Kenaston', 'Kerrobert', 'Kinistino', 'Kyle', 'Lampman', 'Lang', 'Lashburn', 'Lemberg', 'Leroy', 'Lumsden', 'Luseland', 'Maidstone', 'Maple Creek', 'Meacham', 'Milestone', 'Montmartre', 'Montrose', 'Mortlach', 'Mossbank', 'Naicam', 'Nipawin', 'Osler', 'Outlook', 'Oxbow', 'Pangman', 'Pense', 'Pierceland', 'Pilot Butte', 'Prince Albert', 'Radisson', 'Regina Beach', 'Rocanville', 'Rose Valley', 'Rosetown', 'Rosthern', 'Saltcoats', 'Saskatoon', 'Shaunavon', 'Shellbrook', 'Spiritwood', 'St. Louis', 'St. Walburg', 'Stewart Valley', 'Stockholm', 'Storthoaks', 'Stoughton', 'Strasbourg', 'Sturgis', 'Swift Current', 'Tisdale', 'Turtleford', 'Unity', 'Vanscoy', 'Vibank', 'Viscount', 'Wadena', 'Wakaw', 'Waldheim', 'Warman', 'Watrous', 'Watson', 'Wawota', 'Weyburn', 'White City', 'Wilkie', 'Willow Bunch', 'Windthorst', 'Wiseton', 'Wolseley', 'Wood Mountain', 'Yorkton', 'Young', 'Humboldt'],
        'Estados Unidos' => ['Nueva York', 'Los Ángeles', 'Chicago', 'Houston', 'Phoenix', 'Filadelfia', 'San Antonio', 'San Diego', 'Dallas', 'San José', 'Austin', 'Indianapolis', 'Jacksonville', 'San Francisco', 'Columbus', 'Fort Worth', 'Charlotte', 'Detroit', 'El Paso', 'Memphis', 'Seattle', 'Denver', 'Washington D.C.', 'Boston', 'Nashville', 'Baltimore', 'Oklahoma City', 'Portland', 'Las Vegas', 'Milwaukee', 'Albuquerque', 'Tucson', 'Fresno', 'Sacramento', 'Mesa', 'Kansas City', 'Atlanta', 'Long Beach', 'Colorado Springs', 'Raleigh', 'Miami', 'Virginia Beach', 'Omaha', 'Oakland', 'Minneapolis', 'Tulsa', 'Wichita', 'New Orleans', 'Arlington', 'Cleveland', 'Bakersfield', 'Tampa', 'Aurora', 'Honolulu', 'Anaheim', 'Santa Ana', 'Corpus Christi', 'Riverside', 'Lexington', 'Stockton', 'St. Louis', 'Saint Paul', 'Henderson', 'Pittsburgh', 'Cincinnati', 'Anchorage', 'Greensboro', 'Plano', 'Newark', 'Lincoln', 'Toledo', 'Orlando', 'Chula Vista', 'Irvine', 'Fort Wayne', 'Jersey City', 'Durham', 'Laredo', 'Madison', 'Buffalo', 'Lubbock', 'Gilbert', 'Winston-Salem', 'Glendale', 'Hialeah', 'Garland', 'Scottsdale', 'Irving', 'Chesapeake', 'North Las Vegas', 'Fremont', 'Baton Rouge', 'Richmond', 'Boise', 'San Bernardino', 'Spokane', 'Montgomery', 'Des Moines', 'Modesto', 'Tacoma', 'Shreveport', 'Fontana', 'Oxnard', 'Aurora', 'Moreno Valley', 'Akron', 'Yonkers', 'Columbus', 'Augusta', 'Little Rock', 'Amarillo', 'Glendale', 'Huntington Beach', 'Grand Rapids', 'Mobile', 'Salt Lake City', 'Tallahassee'],
        'Rusia' => ['Moscú', 'San Petersburgo', 'Novosibirsk', 'Ekaterimburgo', 'Nizhni Nóvgorod', 'Kazán', 'Cheliábinsk', 'Omsk', 'Samara', 'Rostov del Don', 'Ufá', 'Krasnoyarsk', 'Perm', 'Volgogrado', 'Vorónezh', 'Saratov', 'Krasnodar', 'Toliatti', 'Barnaul', 'Uliánovsk'],

    ];


    protected $rules = [
        'client_id' => 'required|max:30',
        'job_id' => 'required|max:100',
        'country' => 'required',
        'city' => 'required',
        'address' => 'required|max:100',
        'date' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }


    public function render()
    {
        $this->edad = 18;
        $clientservices = ClientService::all();
        $this->jobs = Job::all();
        $this->clients = Client::all();
        return view('livewire.client-service-component', compact('clientservices'));
    }

    public function filterCities()
    {
        $filteredCities = [];
        $allCities = $this->getCities();

        foreach ($allCities as $city) {
            if (stripos($city, $this->searchCity) !== false) {
                $filteredCities[] = $city;
            }
        }

        return $filteredCities;
    }

    public function openClientServiceModal()
    {

        $this->reset();
         $this->cantidadPagar = 0;
         $this->fechaNacimiento = null;
        $this->ClientServiceModal = true;
    }
    public function openEditModal($id)
    {
        $clientservice = ClientService::findOrFail($id);
        $this->clientservice_id = $id;
        $this->client_id = $clientservice->client_id;
        $this->job_id = $clientservice->job_id;
        $this->cost = $clientservice->cost;
        $this->selectedCountry = $clientservice->country;
        $this->city = $clientservice->city;
        $this->address = $clientservice->address;
        $this->date = $clientservice->date;

        $client = Client::findOrFail($this->client_id);
        $this->selectedCountry = $client->country;
        $this->city = $client->city;

        $this->ClientServiceModal = true;
    }


    public function updateCountryAndCity()
    {
        // Buscar el cliente
        $client = Client::findOrFail($this->client_id);
        // Asignar valores
        $this->selectedCountry = $client->country;
        $this->city = $client->city;

        $clientAddress = $this->getClientAddress($this->client_id);
        $this->address = $clientAddress;

    }

    public function updateCities()
    {
        // Actualizar las ciudades
        $this->cities = $this->getCities();
    }

    public function addClientService()
    {
       if ($this->edad < 18) {
            session()->flash('error', 'Debes tener 18 años o más para realizar el pago.');
            return;
        }
        $this->country = $this->selectedCountry;
        $this->city = $this->city;

        $this->validate([
            'client_id' => 'required',
            'job_id' => 'required',
            'cost' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'date' => 'required',

        ]);

        $clientservice = ClientService::create([
            'client_id' => $this->client_id,
            'job_id' => $this->job_id,
            'cost' => $this->cost,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'date' => $this->date,
        ]);
    
        Notification::route('mail', 'liderthragg@gmail.com')
            ->notify(new PaymentNotification($clientservice->job_id, $clientservice->cost));
    
        $this->closeModal();
    }

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

    public function confirmDeleteClientService($id)
    {
        $this->clientservice_id = $id;
        $this->confirmDeleteClientServiceModal = true;
    }

    public function deleteClientService()
    {
        $clientservice = ClientService::findOrFail($this->clientservice_id);
        $clientservice->delete();

        $this->confirmDeleteClientServiceModal = false;
    }


    public function closeModal()
    {
        $this->reset();
        $this->confirmDeleteClientServiceModal = false;

        $this->ClientServiceModal = false;
    }

    public function getClientAddress($clientId)
    {
        $client = Client::find($clientId);

        if ($client) {
            return $client->address;
        } else {
            return '';
        }
    }

    public function getJobCost($jobId)
    {

        $job = Job::find($jobId);
        if ($job) {
            $this->cost = $this->cost;
        } else {
            $this->cost = null;
        }

    }

    public function openMercadoPagoModal()
{
    $this->openMercadoPagoModal = true;
}
public function validarNumeroTarjeta()
{
    $numeroTarjeta = str_replace([' ', '-'], '', $this->numeroTarjeta);

    if (!preg_match('/^\d{13,19}$/', $numeroTarjeta) || !$this->luhn($numeroTarjeta)) {
        $this->addError('numeroTarjeta', 'El número de tarjeta es inválido.');
    }
}

public function validarFechaVencimiento()
{
    $fechaActual = now();
    $fechaVencimiento = \Carbon\Carbon::createFromFormat('m/y', $this->vencimiento);

    if (!$fechaVencimiento || $fechaVencimiento->lt($fechaActual)) {
        $this->addError('vencimiento', 'La fecha de vencimiento es inválida o ha expirado.');
    }
}

public function validarCVV()
{
    if (!preg_match('/^\d{3,4}$/', $this->cvv)) {
        $this->addError('cvv', 'El código CVV es inválido.');
    }
}

public function luhn($numero)
{
    $numero = (string)$numero;
    $sum = 0;
    for ($i = strlen($numero) - 1; $i >= 0; $i--) {
        $digit = (int)$numero[$i];
        if (($i % 2) == (strlen($numero) % 2)) {
            $digit *= 2;
            if ($digit > 9) {
                $digit -= 9;
            }
        }
        $sum += $digit;
    }
    return ($sum % 10 == 0);
}

    public function updatedSelectedCountry()
    {
        $this->reset(['city', 'searchCity']);
    }

}
