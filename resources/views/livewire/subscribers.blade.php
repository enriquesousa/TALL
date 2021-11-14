<div class="p-6 bg-white border-b border-gray-200">
    <p class="text-2xl text-gray-600 font-bold mb-6 underline">
        Subscriptores 
    </p>

    <div class="px-8">

        {{-- Agregamos un campo de busqueda         --}}
        <x-input type="text"
                 class="rounded-lg border float-right border-gray-300 mb-4 w-1/3 pl-8" 
                 placeholder="Buscar"
                 wire:model="search">
                 
        </x-input>

        @if ($subscribers->isEmpty())
            <div class="flex w-full bg-red-100 p-5 rounded-lg">
                <p class="text-red-400">No se encontraron subscriptores</p>
            </div>
        @else
            <table class="w-full">
                {{-- @dd($subscribers) --}}

                <thead class="border-b-2 border-gray-300 text-indigo-600">
                    <tr class="px-6 py-3 text-left">
                        <th>
                            Correo
                        </th>
                        <th>
                            Verificado
                        </th>
                        <th>
                            Acción
                        </th>
                    </tr>
                </thead>
                
                <tbody>
                    @foreach ($subscribers as $subscriber)
                    <tr class="text-sm text-indigo-900 border-b border-gray-400">
                        <td class="px-6 py-4">
                            {{ $subscriber->email }} 
                        </td>
                        <td class="px-6 py-4">
                            {{ optional($subscriber->email_verified_at)->diffForHumans() ?? 'Nunca' }}
                        </td>
                        <td class="px-6 py-4">
                            <x-button class="border border-red-500 text-red-500 bg-red-50 hover:bg-red-100"
                                    wire:click="delete({{ $subscriber->id }})">
                                Borrar
                            </x-button>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>  
        @endif

    </div>

</div>