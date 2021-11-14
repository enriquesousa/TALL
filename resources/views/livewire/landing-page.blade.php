{{-- capa azul indigo pagina principal --}}
<div 
class="flex flex-col bg-indigo-900 h-screen"
x-data="{
    showSubscribe: @entangle('showSubscribe'),
    showSuccess: @entangle('showSuccess'),
}">
    <nav class="pt-5 flex justify-between container mx-auto text-indigo-200">
        <a href="/" class="text-3xl font-bold">
            <x-application-logo class="w-16 h-16 fill-current"></x-application-logo>
        </a>
        <div class="flex justify-end">
            @auth
                <a href="{{ route('dashboard') }}">Dashboard</a>
            @else
                <a href="{{ route('login') }}">Login</a>
            @endauth 
        </div>
    </nav>

    {{-- ventana pagina landing-page principal capa azul indigo --}}
    <div class="flex container mx-auto items-center h-full">
        <div class="flex w-1/3 flex-col items-start">
            <h1 class="font-bold text-white text-5xl leading-tight mb-4">
                Página simple general para subscribirse
            </h1>
            <p class="text-indigo-200 text-xl mb-10">
                Probando el sistema con <span class="font-bold underline">TALL</span> Stack, te gustaría subscribirte?
            </p>
            <x-button 
                class="py-3 px-8 bg-red-500 hover:bg-red-600"
                x-on:click="showSubscribe = true"
            >
                Subscribirse 
            </x-button>
        </div>
    </div>

    {{-- ventana modal rosa de subscripcion --}}
    <x-modal class="bg-pink-500" trigger="showSubscribe">
        <p class="text-white font-extrabold text-5xl text-center">
            ok! <br>
            vamos a registrarnos
        </p>
        <form   class="flex flex-col items-center p-24"
                wire:submit.prevent="subscribe">

            <x-input class="border-2 rounded-lg border-blue-400 px-5 py-3 w-80"
                     type="email" 
                     name="email" 
                     placeholder="Correo Electrónico"
                     wire:model.defer="email">
            </x-input>

            <span class="text-gray-100 text-sm">
                {{ $errors->has('email') ? $errors->first('email') : 'Te enviaremos un correo de confirmación.' }}
            </span>

            <x-button class="px-5 py-3 mt-5 w-80 bg-blue-500 justify-center">
                <span class="animate-spin" wire:loading wire:target="subscribe">&#9696;</span>
                <span wire:loading.remove wire:target="subscribe">Registrarme</span>
            </x-button>

        </form>    
    </x-modal>

    {{-- ventana modal verde success --}}
    <x-modal class="bg-green-500" trigger="showSuccess">
        <p class="animate-pulse text-white font-extrabold text-9xl text-center">
            &check;
        </p>
        <p class="text-white font-extrabold text-4xl text-center mt-16">
            Perfecto!
        </p>
        @if (request()->has('verified') && request()->verified == 1)
            <p class="text-white text-3xl text-center">
                    Gracias por confirmar!
            </p>
        @else
            <p class="text-white text-2xl text-center">
                    Nos vemos en tu <br>
                    bandeja de entrada
            </p>
        @endif
    </x-modal>


</div>