<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Service;
class ServiceComponent extends Component
{
    public $services;
    public $serviceModal =false;
    public $confirmDeleteServiceModal = false;


    public $name;
    public $phone;
    public $home;
    public $date;
    public $service;
    public $pay;


    public $searchCity = '';
    public $selectedCountry;
    public $city;
    public $country;
    public $service_id;

    public function editService($serviceId)
    {
        $this->resetValidation();
        $this->resetFields();

        $service = Service::findOrFail($serviceId);
        $this->service_id = $serviceId;
        $this->name = $service->name;
        $this->phone = $service->phone;
        $this->selectedCountry = $service->country;
        $this->city = $service->city;
        $this->home = $service->home;
        $this->date = $service->date;
        $this->service = $service->service;
        $this->pay = $service->pay;
    }

    public function openEditModal($serviceId)
    {
        $this->editService($serviceId);
        $this->serviceModal = true;
    }

    public function confirmDeleteService($serviceId)
    {
        $this->service_id = $serviceId;
        $this->confirmDeleteServiceModal = true;
    }

    public function updateService()
    {
        $this->validate();

        Service::findOrFail($this->service_id)->update([
            'name' => $this->name,
            'phone' => $this->phone,
            'country' => $this->selectedCountry,
            'city' => $this->city,
            'home' => $this->home,
            'date' => $this->date,
            'service' => $this->service,
            'pay' => $this->pay,
        ]);


        $this->resetFields();
        $this->service_id = null;
        $this->serviceModal = false;
    }

    public function deleteService($serviceId)
    {
        Service::findOrFail($this->service_id)->delete();
        $this->confirmDeleteServiceModal = false;
    }


    protected $rules = [
        'name' => 'required|max:30',
        'phone' => 'required|max:10',
        'home' => 'required|max:50',
        'date' => 'required|max:10',
        'service' => 'required|max:100',
        'pay' => 'required',
    ];

    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->services = Service::all();
        return view('livewire.service-component', [
            'countries' => ['Mexico', 'Canadá', 'Estados Unidos'],
            'cities' => $this->filterCities(),
        ]);
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

    public function addService()
    {
        $this->validate();

        $this->country = $this->selectedCountry;
        $this->city = $this->city;

        Service::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'country' =>$this->country,
            'city' =>$this->city,
            'home' => $this->home,
            'date' => $this->date,
            'service' => $this->service,
            'pay' => $this->pay,
        ]);

        $this->resetFields();

        $this->serviceModal = false;
    }

    public function resetFields()
    {
        $this->name = '';
        $this->phone = '';
        $this->country ='';
        $this->city ='';
        $this->home = '';
        $this->date = '';
        $this->service = '';
        $this->pay = '';
    }

    public function closeModal()
    {
        $this->serviceModal = false;
        $this->confirmDeleteServiceModal = false;
        $this->resetFields();
    }

    public function getCities()
    {
        if ($this->selectedCountry === 'Mexico') {
            return ['Ciudad de México', 'Guadalajara', 'Monterrey', 'Puebla', 'Tijuana', 'Matamoros','Reynosa','Ciudad Juárez','Tampico','Altamira','Ciudad Victoria', 'León', 'Zapopan', 'Mérida', 'San Luis Potosí', 'Aguascalientes', 'Hermosillo', 'Saltillo', 'Mexicali', 'Culiacán', 'Cancún', 'Chihuahua', 'Durango', 'Toluca', 'Querétaro', 'Morelia', 'Tuxtla Gutiérrez', 'Tlaxcala', 'Zacatecas', 'Victoria', 'Colima', 'La Paz', 'Cuernavaca', 'Campeche', 'Chilpancingo', 'Hidalgo', 'Oaxaca', 'Tabasco', 'Nayarit', 'Sonora', 'Yucatán', 'Chiapas', 'Guanajuato', 'Veracruz', 'Sinaloa', 'Jalisco', 'Nuevo León', 'Coahuila', 'Quintana Roo', 'Tamaulipas', 'San Luis Potosí', 'Aguascalientes', 'Durango', 'Zacatecas', 'Querétaro', 'Hidalgo', 'Tlaxcala', 'Nayarit', 'Colima', 'Quintana Roo', 'Baja California Sur', 'Campeche', 'Sonora', 'Yucatán', 'Chiapas', 'Guanajuato', 'Veracruz', 'Sinaloa', 'Jalisco', 'Nuevo León', 'Coahuila', 'Michoacán'];
        } elseif ($this->selectedCountry === 'Canadá') {
            return ['Toronto', 'Montreal', 'Vancouver', 'Calgary', 'Ottawa', 'Edmonton', 'Winnipeg', 'Québec', 'Hamilton', 'Victoria', 'London', 'Kitchener', 'St. Catharines', 'Halifax', 'Oshawa', 'Windsor', 'Saskatoon', 'Regina', 'Sherbrooke', 'Barrie', 'Saint John', 'Kelowna', 'Abbotsford', 'Sudbury', 'Kingston', 'Trois-Rivières', 'Chicoutimi', 'Thunder Bay', 'Moncton', 'Brantford', 'Nanaimo', 'Fredericton', 'Saint John', 'Drummondville', 'Newmarket', 'Peterborough', 'Chilliwack', 'Red Deer', 'Prince George', 'Sault Ste. Marie', 'North Bay', 'Norfolk', 'Brampton', 'Saint-Jérôme', 'Granby', 'Red Deer', 'Peterborough', 'Belleville', 'Chatham-Kent', 'Saint-Hyacinthe', 'Lethbridge', 'Moose Jaw', 'Medicine Hat', 'Granby', 'Belleville', 'Saint-Hyacinthe', 'North Bay', 'Drummondville', 'Saint-Jérôme', 'Belleville', 'Drummondville', 'North Bay', 'Granby', 'Timmins', 'Rimouski', 'Prince Albert', 'Pembroke', 'Saint-Georges', 'Rouyn-Noranda', 'Owen Sound', 'Woodstock', 'Corner Brook', 'Leamington', 'St. Thomas', 'Courtenay', 'Campbell River', 'Stratford', 'Orillia', 'New Glasgow', 'Bradford West Gwillimbury', 'Grande Prairie', 'Terrace', 'Stratford', 'Orillia', 'Cobourg', 'Amos', 'Val-d\'Or', 'Baie-Comeau', 'Sept-Îles', 'Powell River', 'Sylvan Lake', 'Lloydminster', 'Kenora', 'Swift Current', 'Whitecourt', 'Estevan', 'Williams Lake', 'North Battleford', 'Wasaga Beach', 'Canmore', 'Dryden', 'Cochrane', 'Camrose', 'Innisfail', 'Wetaskiwin', 'Selkirk', 'Steinbach', 'Dauphin', 'The Pas', 'Flin Flon', 'Thompson', 'Norway House', 'Churchill', 'Yorkton', 'Melfort', 'Humboldt', 'La Ronge', 'Meadow Lake', 'Esterhazy', 'Kindersley', 'Nipawin', 'La Loche', 'Assiniboia', 'Carlyle', 'Weyburn', 'Moose Jaw', 'Swift Current', 'Estevan', 'Humboldt', 'Melville', 'Tisdale', 'Rosetown', 'Maple Creek', 'Shaunavon', 'Biggar', 'Watrous', 'Balgonie', 'Caronport', 'Eston', 'Grenfell', 'Indian Head', 'Kerrobert', 'Kipling', 'Langham', 'Lumsden', 'Manor', 'Maple Creek', 'Moosomin', 'Nokomis', 'Pilot Butte', 'Preeceville', 'Regina Beach', 'Rosthern', 'Shaunavon', 'Shellbrook', 'Unity', 'Wilkie', 'Wolseley', 'Wynyard', 'Carnduff', 'Creighton', 'Dalmeny', 'Duck Lake', 'Gull Lake', 'Lashburn', 'Macklin', 'Marsden', 'Porcupine Plain', 'Raymore', 'Redvers', 'Stoughton', 'Wadena', 'Watrous', 'Wolseley', 'Arcola', 'Balgonie', 'Bengough', 'Bredenbury', 'Burstall', 'Canora', 'Carrot River', 'Choiceland', 'Craik', 'Creelman', 'Cupar', 'Davidson', 'Dysart', 'Edenwold', 'Emerald Park', 'Esterhazy', 'Fleming', 'Foam Lake', 'Francis', 'Grenfell', 'Gull Lake', 'Hanley', 'Hepburn', 'Hudson Bay', 'Imperial', 'Indian Head', 'Ituna', 'Kamsack', 'Kelliher', 'Kelvington', 'Kenaston', 'Kerrobert', 'Kinistino', 'Kyle', 'Lampman', 'Lang', 'Lashburn', 'Lemberg', 'Leroy', 'Lumsden', 'Luseland', 'Maidstone', 'Maple Creek', 'Meacham', 'Milestone', 'Montmartre', 'Montrose', 'Mortlach', 'Mossbank', 'Naicam', 'Nipawin', 'Osler', 'Outlook', 'Oxbow', 'Pangman', 'Pense', 'Pierceland', 'Pilot Butte', 'Prince Albert', 'Radisson', 'Regina Beach', 'Rocanville', 'Rose Valley', 'Rosetown', 'Rosthern', 'Saltcoats', 'Saskatoon', 'Shaunavon', 'Shellbrook', 'Spiritwood', 'St. Louis', 'St. Walburg', 'Stewart Valley', 'Stockholm', 'Storthoaks', 'Stoughton', 'Strasbourg', 'Sturgis', 'Swift Current', 'Tisdale', 'Turtleford', 'Unity', 'Vanscoy', 'Vibank', 'Viscount', 'Wadena', 'Wakaw', 'Waldheim', 'Warman', 'Watrous', 'Watson', 'Wawota', 'Weyburn', 'White City', 'Wilkie', 'Willow Bunch', 'Windthorst', 'Wiseton', 'Wolseley', 'Wood Mountain', 'Yorkton', 'Young', 'Humboldt'];
        } elseif ($this->selectedCountry === 'Estados Unidos') {
            return ['Nueva York', 'Los Ángeles', 'Chicago', 'Houston', 'Phoenix', 'Filadelfia', 'San Antonio', 'San Diego', 'Dallas', 'San José', 'Austin', 'Indianapolis', 'Jacksonville', 'San Francisco', 'Columbus', 'Fort Worth', 'Charlotte', 'Detroit', 'El Paso', 'Memphis', 'Seattle', 'Denver', 'Washington D.C.', 'Boston', 'Nashville', 'Baltimore', 'Oklahoma City', 'Portland', 'Las Vegas', 'Milwaukee', 'Albuquerque', 'Tucson', 'Fresno', 'Sacramento', 'Mesa', 'Kansas City', 'Atlanta', 'Long Beach', 'Colorado Springs', 'Raleigh', 'Miami', 'Virginia Beach', 'Omaha', 'Oakland', 'Minneapolis', 'Tulsa', 'Wichita', 'New Orleans', 'Arlington', 'Cleveland', 'Bakersfield', 'Tampa', 'Aurora', 'Honolulu', 'Anaheim', 'Santa Ana', 'Corpus Christi', 'Riverside', 'Lexington', 'Stockton', 'St. Louis', 'Saint Paul', 'Henderson', 'Pittsburgh', 'Cincinnati', 'Anchorage', 'Greensboro', 'Plano', 'Newark', 'Lincoln', 'Toledo', 'Orlando', 'Chula Vista', 'Irvine', 'Fort Wayne', 'Jersey City', 'Durham', 'Laredo', 'Madison', 'Buffalo', 'Lubbock', 'Gilbert', 'Winston-Salem', 'Glendale', 'Hialeah', 'Garland', 'Scottsdale', 'Irving', 'Chesapeake', 'North Las Vegas', 'Fremont', 'Baton Rouge', 'Richmond', 'Boise', 'San Bernardino', 'Spokane', 'Montgomery', 'Des Moines', 'Modesto', 'Tacoma', 'Shreveport', 'Fontana', 'Oxnard', 'Aurora', 'Moreno Valley', 'Akron', 'Yonkers', 'Columbus', 'Augusta', 'Little Rock', 'Amarillo', 'Glendale', 'Huntington Beach', 'Grand Rapids', 'Mobile', 'Salt Lake City', 'Tallahassee'];
        } else {
            return [];
        }

    }

    public function updatedSelectedCountry()
    {
        $this->reset(['city', 'searchCity']);
    }


}
