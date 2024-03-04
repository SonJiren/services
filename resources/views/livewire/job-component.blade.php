<div>
    <div class="mb-4">
        <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded flex items-center"
            wire:click="$toggle('jobModal')">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="w-6 h-6 mr-2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
            </svg>
            Agregar Trabajo
        </button>
    </div>
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">Nombre</th>
                <th scope="col" class="px-6 py-3">Descripción</th>
                <th scope="col" class="px-6 py-3">Imagen</th>
                <th scope="col" class="px-6 py-3">Costo</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($jobs as $job)
                <tr
                    class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $job->name }}</td>
                    <td class="px-6 py-4">{{ $job->description }}</td>
                    <td class="px-6 py-4">
                        @if ($job->image)
                            <img src="{{ Storage::url('images/' . $job->image) }}" alt="Imagen"
                                class="w-80 h-40 object-cover" />
                        @endif
                    </td>
                    <td class="px-6 py-4">{{ $job->cost }}</td>
                    <td class="px-6 py-4">
                        <button wire:click="openEditModal({{ $job->id }})"
                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                            Editar
                        </button>
                        <button wire:click="confirmDeleteJob({{ $job->id }})"
                            class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mr-2">
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
    <x-dialog-modal wire:model="jobModal">
        <x-slot name="title">{{ !$job_id ? 'Nuevo trabajo' : 'Editar trabajo' }}</x-slot>
        <x-slot name="content">
            <div class="space-y-4">
                <div>
                    <x-label>Nombre</x-label>
                    <x-input wire:model="name" class="w-full" />
                    @error('name')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div>
                    <x-label>Descripción</x-label>
                    <x-input type="text" wire:model="description" class="w-full" />
                    @error('description')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
                <div>
                    <x-label>Imagen</x-label>
                    <input type="file" wire:model="image" class="w-full" />
                    @error('image')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>

                <div>
                    <x-label>Costo</x-label>
                    <x-input wire:model="cost" class="w-full" />
                    @error('cost')
                        <span>
                            {{ $message }}
                        </span>
                    @enderror
                </div>
             </div>
        </x-slot>
        <x-slot name="footer">
            <button wire:click="{{ !$job_id ? 'addJob' : 'updateJob' }}"
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

    <x-dialog-modal wire:model="confirmDeleteModal">
        <x-slot name="title">Confirmar eliminación</x-slot>
        <x-slot name="content">
            ¿Estás seguro de que quieres eliminar este trabajo?
        </x-slot>
        <x-slot name="footer">
            <button wire:click="delete({{ $job_id }})"
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
