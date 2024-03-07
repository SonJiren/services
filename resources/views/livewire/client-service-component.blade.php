<div>
    <div class="mb-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center"
            wire:click="openClientServiceModal">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Agregar servicio
        </button>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 ">

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3 ">Cliente</th>
                <th scope="col" class="px-6 py-3">Trabajo</th>
                <th scope="col" class="px-6 py-3">Costo</th>
                <th scope="col" class="px-6 py-3">Pais</th>
                <th scope="col" class="px-6 py-3">Ciudad</th>
                <th scope="col" class="px-6 py-3">Domicilio</th>
                <th scope="col" class="px-6 py-3">Fecha</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>

        <tbody >
            @foreach ($clientservices as $clientservice)
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $clientservice->client->name }}</td>
                    <td class="px-6 py-4">{{ $clientservice->job->name}}</td>
                    <td class="px-6 py-4">{{ $clientservice->job->cost }}</td>
                    <td class="px-6 py-4">{{ $clientservice->country }}</td>
                    <td class="px-6 py-4">{{ $clientservice->city }}</td>
                    <td class="px-6 py-4">{{ $clientservice->address }}</td>
                    <td class="px-6 py-4">{{ $clientservice->date }}</td>

                    <td class="px-6 py-4">
                        <button wire:click="openEditModal({{ $clientservice->id }})"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                            Editar
                        </button>
                        <button wire:click="confirmDeleteClientService({{ $clientservice->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            Borrar
                        </button>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

        <x-dialog-modal wire:model="ClientServiceModal" >
            <x-slot name="title">{{ !$clientservice_id ? 'Pendiente ' : 'Editar pendiente' }}</x-slot>
            <x-slot name="content">
                <div class="space-y-4" style="background-image: url('{{ asset('storage/images/th.jpg') }}'); background-size: cover;">
                    <x-label>Cliente</x-label>
                    <select wire:model="client_id" wire:change="updateCountryAndCity" class="w-full  bg-transparent border border-gray-300 rounded-md">
                        <option value="">Selecciona un cliente</option>
                        @foreach ($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->name }}</option>
                        @endforeach
                    </select>

                    <x-label>Pais</x-label>
                    <select wire:model="selectedCountry" wire:change="updateCities" class="w-full  bg-transparent border border-gray-300 rounded-md">
                        <option value="">Selecciona un país</option>
                        @foreach ($countries as $country)
                            <option value="{{ $country }}">{{ $country }}</option>
                        @endforeach
                    </select>

                    <x-label>Ciudad</x-label>
                    <select wire:model="city" class="w-full  bg-transparent border border-gray-300 rounded-md">
                        <option value="">Selecciona una ciudad</option>
                        @foreach ($cities[$selectedCountry] as $city)
                            <option value="{{ $city }}">{{ $city }}</option>
                        @endforeach
                    </select>

                    <div class="flex flex-col">
                        <x-label>Trabajo</x-label>
                        <select wire:model="job_id" wire:model="selectedJob" class="w-full  bg-transparent border border-gray-300 rounded-md">
                            <option value="">Selecciona un trabajo</option>
                            @foreach ($jobs as $job)
                                <option value="{{ $job->id }}">{{ $job->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <x-label>Costo</x-label>
                        <x-input wire:model="cost" class="w-full border border-gray-300 rounded-md" style="background-color: rgba(0, 0, 0, 0);" />
                        @error('cost')
                            <span>
                                {{ $message }}
                            </span>
                        @enderror
                    </div>

                        <div>
                            <x-label>Dirección:</x-label>
                            <x-input type="text" wire:model="address" value="{{ $this->getClientAddress($client_id) }}" class="w-full bg-transparent border border-gray-300 rounded-md" style="background-color: rgba(0,0,0,0);" />
                            @error('address')
                                <span>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div>
                            <x-label>Fecha</x-label>
                            <x-input type="date" wire:model="date" class="w-full bg-transparent border border-gray-300 rounded-md" style="background-color: rgba(0,0,0,0);"/>
                            @error('date')
                                <span>
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                </div>
            </x-slot>
             <x-slot name="footer">
                <button wire:click="{{ !$clientservice_id ? 'addClientService' : 'updateClientService' }}"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                <button wire:click="closeModal"
                    class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Cancelar
                </button>
            </x-slot>
        </x-dialog-modal>
{{--
        <x-dialog-modal wire:model="openMercadoPagoModal" >
            <x-slot name="title">Mercado Pago</x-slot>
            <x-slot name="content">
                <div class="flex items-center">
                    <img src="{{ asset('ruta/a/la/imagen.jpg') }}" alt="Imagen de Mercado Pago" class="w-32 h-32 mr-4">
                    <div>
                        <x-label>Número de Tarjeta</x-label>
                        <x-input wire:model="numeroTarjeta" class="w-full bg-transparent border border-gray-300 rounded-md" />
                        <!-- Agregar más estilos según necesidad -->
                        @error('numeroTarjeta')
                            <span class="w--full text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="flex items-center mt-4">
                    <div>
                        <x-label>Vencimiento</x-label>
                        <x-input wire:model="vencimiento" class="w-full bg-transparent border border-gray-300 rounded-md" />
                        <!-- Agregar más estilos según necesidad -->
                        @error('vencimiento')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="ml-4">
                        <x-label>Código CVV</x-label>
                        <x-input wire:model="cvv" class="w-full bg-transparent border border-gray-300 rounded-md" />
                        <!-- Agregar más estilos según necesidad -->
                        @error('cvv')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <x-label>Fecha de Nacimiento</x-label>
                    <x-input type="date" wire:model="fechaNacimiento" class="w-full bg-transparent border border-gray-300 rounded-md" />
                    <!-- Agregar más estilos según necesidad -->
                    @error('fechaNacimiento')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </x-slot>
            <x-slot name="footer">
                @if ($edad >= 18)
                    <button wire:click="{{ !$clientservice_id ? 'addClientService' : 'updateClientService' }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Guardar</button>
                @else
                    <span class="text-red-500">Debes tener 18 años o más para realizar el pago.</span>
                @endif
                <button wire:click="closeModal"
                    class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-4 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    Cancelar
                </button>
            </x-slot>
        </x-dialog-modal> --}}



    <x-dialog-modal wire:model="confirmDeleteClientServiceModal">
        <x-slot name="title">Confirmar eliminación</x-slot>
        <x-slot name="content">
            ¿Estás seguro de que quieres eliminar este pendiente?
        </x-slot>
        <x-slot name="footer">
            <button wire:click="deleteClientService({{ $clientservice_id }})"
                class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 12.75 6 6 9-13.5" />
                </svg>
                Sí
            </button>
            <button wire:click="closeModal"
                class="bg-gray-400 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded ml-4 flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-6 h-6 mr-2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                </svg>
                No
            </button>
        </x-slot>
    </x-dialog-modal>
</div>
