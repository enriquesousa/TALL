<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <p class="text-2xl text-gray-600 font-bold mb-6 underline">
                        Acciones
                        <ul class="list-disc pl-5">
                            <li class="text-blue-500 hover:underline">
                                <a href="{{ route('subscriber.all') }}">Manejar Subscriptores</a>
                            </li>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
