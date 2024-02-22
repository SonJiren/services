<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ClientService;
use App\Models\Client;
use App\Models\Job;


class ClientServiceComponent extends Component
{
    public $ClientServiceModal = false;
    public $confirmDeleteClientServiceModal = false;
    public $searchCity = '';
    public $selectedCountry = 'Mexico';
    public $clientservice_id, $name, $trabajo, $country, $city, $address, $date;
    public $jobs;
    public $clients;
    public $countries = ['Mexico', 'Estados Unidos', 'Canadá'];
    public $cities = [
        'Mexico' => ['Ciudad de México', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana', 'Matamoros', 'Reynosa', 'Ciudad Juárez', 'Tampico', 'Altamira', 'Ciudad Victoria', 'León', 'Zapopan', 'Mérida', 'San Luis Potosí', 'Aguascalientes', 'Hermosillo', 'Saltillo', 'Mexicali', 'Culiacán', 'Cancún', 'Chihuahua', 'Durango', 'Toluca', 'Querétaro', 'Morelia', 'Tuxtla Gutiérrez', 'Tlaxcala', 'Zacatecas', 'Victoria', 'Colima', 'La Paz', 'Cuernavaca', 'Campeche', 'Chilpancingo', 'Hidalgo', 'Oaxaca', 'Tabasco', 'Nayarit', 'Sonora', 'Yucatán', 'Chiapas', 'Guanajuato', 'Veracruz', 'Sinaloa', 'Jalisco', 'Nuevo León', 'Coahuila', 'Quintana Roo', 'Tamaulipas', 'San Luis Potosí', 'Aguascalientes', 'Durango', 'Zacatecas', 'Querétaro', 'Hidalgo', 'Tlaxcala', 'Nayarit', 'Colima', 'Quintana Roo', 'Baja California Sur', 'Campeche', 'Sonora', 'Yucatán', 'Chiapas', 'Guanajuato', 'Veracruz', 'Sinaloa', 'Jalisco', 'Nuevo León', 'Coahuila', 'Michoacán'],
        'Canadá' => ['Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Ottawa', 'Edmonton', 'Winnipeg', 'Québec', 'Hamilton', 'Victoria', 'London', 'Kitchener', 'St. Catharines', 'Halifax', 'Oshawa', 'Windsor', 'Saskatoon', 'Regina', 'Sherbrooke', 'Barrie', 'Saint John', 'Kelowna', 'Abbotsford', 'Sudbury', 'Kingston', 'Trois-Rivières', 'Chicoutimi', 'Thunder Bay', 'Moncton', 'Brantford', 'Nanaimo', 'Fredericton', 'Saint John', 'Drummondville', 'Newmarket', 'Peterborough', 'Chilliwack', 'Red Deer', 'Prince George', 'Sault Ste. Marie', 'North Bay', 'Norfolk', 'Brampton', 'Saint-Jérôme', 'Granby', 'Red Deer', 'Peterborough', 'Belleville', 'Chatham-Kent', 'Saint-Hyacinthe', 'Lethbridge', 'Moose Jaw', 'Medicine Hat', 'Granby', 'Belleville', 'Saint-Hyacinthe', 'North Bay', 'Drummondville', 'Saint-Jérôme', 'Belleville', 'Drummondville', 'North Bay', 'Granby', 'Timmins', 'Rimouski', 'Prince Albert', 'Pembroke', 'Saint-Georges', 'Rouyn-Noranda', 'Owen Sound', 'Woodstock', 'Corner Brook', 'Leamington', 'St. Thomas', 'Courtenay', 'Campbell River', 'Stratford', 'Orillia', 'New Glasgow', 'Bradford West Gwillimbury', 'Grande Prairie', 'Terrace', 'Stratford', 'Orillia', 'Cobourg', 'Amos',  'Baie-Comeau',  'Powell River', 'Sylvan Lake', 'Lloydminster', 'Kenora', 'Swift Current', 'Whitecourt', 'Estevan', 'Williams Lake', 'North Battleford', 'Wasaga Beach', 'Canmore', 'Dryden', 'Cochrane', 'Camrose', 'Innisfail', 'Wetaskiwin', 'Selkirk', 'Steinbach', 'Dauphin', 'The Pas', 'Flin Flon', 'Thompson', 'Norway House', 'Churchill', 'Yorkton', 'Melfort', 'Humboldt', 'La Ronge', 'Meadow Lake', 'Esterhazy', 'Kindersley', 'Nipawin', 'La Loche', 'Assiniboia', 'Carlyle', 'Weyburn', 'Moose Jaw', 'Swift Current', 'Estevan', 'Humboldt', 'Melville', 'Tisdale', 'Rosetown', 'Maple Creek', 'Shaunavon', 'Biggar', 'Watrous', 'Balgonie', 'Caronport', 'Eston', 'Grenfell', 'Indian Head', 'Kerrobert', 'Kipling', 'Langham', 'Lumsden', 'Manor', 'Maple Creek', 'Moosomin', 'Nokomis', 'Pilot Butte', 'Preeceville', 'Regina Beach', 'Rosthern', 'Shaunavon', 'Shellbrook', 'Unity', 'Wilkie', 'Wolseley', 'Wynyard', 'Carnduff', 'Creighton', 'Dalmeny', 'Duck Lake', 'Gull Lake', 'Lashburn', 'Macklin', 'Marsden', 'Porcupine Plain', 'Raymore', 'Redvers', 'Stoughton', 'Wadena', 'Watrous', 'Wolseley', 'Arcola', 'Balgonie', 'Bengough', 'Bredenbury', 'Burstall', 'Canora', 'Carrot River', 'Choiceland', 'Craik', 'Creelman', 'Cupar', 'Davidson', 'Dysart', 'Edenwold', 'Emerald Park', 'Esterhazy', 'Fleming', 'Foam Lake', 'Francis', 'Grenfell', 'Gull Lake', 'Hanley', 'Hepburn', 'Hudson Bay', 'Imperial', 'Indian Head', 'Ituna', 'Kamsack', 'Kelliher', 'Kelvington', 'Kenaston', 'Kerrobert', 'Kinistino', 'Kyle', 'Lampman', 'Lang', 'Lashburn', 'Lemberg', 'Leroy', 'Lumsden', 'Luseland', 'Maidstone', 'Maple Creek', 'Meacham', 'Milestone', 'Montmartre', 'Montrose', 'Mortlach', 'Mossbank', 'Naicam', 'Nipawin', 'Osler', 'Outlook', 'Oxbow', 'Pangman', 'Pense', 'Pierceland', 'Pilot Butte', 'Prince Albert', 'Radisson', 'Regina Beach', 'Rocanville', 'Rose Valley', 'Rosetown', 'Rosthern', 'Saltcoats', 'Saskatoon', 'Shaunavon', 'Shellbrook', 'Spiritwood', 'St. Louis', 'St. Walburg', 'Stewart Valley', 'Stockholm', 'Storthoaks', 'Stoughton', 'Strasbourg', 'Sturgis', 'Swift Current', 'Tisdale', 'Turtleford', 'Unity', 'Vanscoy', 'Vibank', 'Viscount', 'Wadena', 'Wakaw', 'Waldheim', 'Warman', 'Watrous', 'Watson', 'Wawota', 'Weyburn', 'White City', 'Wilkie', 'Willow Bunch', 'Windthorst', 'Wiseton', 'Wolseley', 'Wood Mountain', 'Yorkton', 'Young', 'Humboldt'],
        'Estados Unidos' => ['Nueva York', 'Los Ángeles', 'Chicago', 'Houston', 'Phoenix', 'Filadelfia', 'San Antonio', 'San Diego', 'Dallas', 'San José', 'Austin', 'Indianapolis', 'Jacksonville', 'San Francisco', 'Columbus', 'Fort Worth', 'Charlotte', 'Detroit', 'El Paso', 'Memphis', 'Seattle', 'Denver', 'Washington D.C.', 'Boston', 'Nashville', 'Baltimore', 'Oklahoma City', 'Portland', 'Las Vegas', 'Milwaukee', 'Albuquerque', 'Tucson', 'Fresno', 'Sacramento', 'Mesa', 'Kansas City', 'Atlanta', 'Long Beach', 'Colorado Springs', 'Raleigh', 'Miami', 'Virginia Beach', 'Omaha', 'Oakland', 'Minneapolis', 'Tulsa', 'Wichita', 'New Orleans', 'Arlington', 'Cleveland', 'Bakersfield', 'Tampa', 'Aurora', 'Honolulu', 'Anaheim', 'Santa Ana', 'Corpus Christi', 'Riverside', 'Lexington', 'Stockton', 'St. Louis', 'Saint Paul', 'Henderson', 'Pittsburgh', 'Cincinnati', 'Anchorage', 'Greensboro', 'Plano', 'Newark', 'Lincoln', 'Toledo', 'Orlando', 'Chula Vista', 'Irvine', 'Fort Wayne', 'Jersey City', 'Durham', 'Laredo', 'Madison', 'Buffalo', 'Lubbock', 'Gilbert', 'Winston-Salem', 'Glendale', 'Hialeah', 'Garland', 'Scottsdale', 'Irving', 'Chesapeake', 'North Las Vegas', 'Fremont', 'Baton Rouge', 'Richmond', 'Boise', 'San Bernardino', 'Spokane', 'Montgomery', 'Des Moines', 'Modesto', 'Tacoma', 'Shreveport', 'Fontana', 'Oxnard', 'Aurora', 'Moreno Valley', 'Akron', 'Yonkers', 'Columbus', 'Augusta', 'Little Rock', 'Amarillo', 'Glendale', 'Huntington Beach', 'Grand Rapids', 'Mobile', 'Salt Lake City', 'Tallahassee'],

    ];


    protected $rules = [
        'name' => 'required|max:30',
        'trabajo' => 'required|max:100',
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
        $clientservices = ClientService::all();
        $this->jobs = Job::pluck('name');
        $this->clients = Client::pluck('name');
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
        $this->ClientServiceModal = true;
    }

    public function openEditClientServiceModal($id)
    {
        $clientservice = ClientService::findOrFail($id);
        $this->clientservice_id = $id;
        $this->name = $clientservice->name;
        $this->trabajo = $clientservice->trabajo;
        $this->selectedCountry = $clientservice->country;
        $this->city = $clientservice->city;
        $this->address = $clientservice->address;
        $this->date = $clientservice->date;
        $this->ClientServiceModal = true;
    }

    public function addClientService()
    {
        $this->country = $this->selectedCountry;
        $this->city = $this->city;

        $this->validate([
            'name' => 'required',
            'trabajo' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'date' => 'required',
        ]);

        ClientService::create([
            'name' => $this->name,
            'trabajo' => $this->trabajo,
            'country' => $this->country,
            'city' => $this->city,
            'address' => $this->address,
            'date' => $this->date,
        ]);

        $this->closeModal();
    }

    public function updateClientService()
    {
        $this->validate([
            'name' => 'required',
            'trabajo' => 'required',
            'country' => 'required',
            'city' => 'required',
            'address' => 'required',
            'date' => 'required',
        ]);

        $clientservice = ClientService::findOrFail($this->clientservice_id);
        $clientservice->update([
            'name' => $this->name,
            'trabajo' => $this->trabajo,
            'country' => $this->selectedCountry,
            'city' => $this->city,
            'address' => $this->address,
            'date' => $this->date,
        ]);

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
        $this->ClientServiceModal = false;
    }


    public function updatedSelectedCountry()
    {
        $this->reset(['city', 'searchCity']);
    }
}
