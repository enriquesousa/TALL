<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use Illuminate\Auth\Notifications\VerifyEmail;

class LandingPage extends Component
{
    public $email;
    //Ej. para tener un email por default
    // public $email = 'email@email.com';

    // enlazar las variable con Alpine
    public $showSubscribe = false;
    public $showSuccess = false;

    protected $rules = [
        'email' => 'required|email:filter|unique:subscribers,email',
    ];

        
    public function mount(Request $request)
    {
        if ($request->has('verified') && $request->verified == 1) {
            $this->showSuccess = true;
        }
    }  

    public function subscribe()
    {
        // para guardar variable al log file que esta en storage/log/laravel.log
        // Log::debug('log-debug');
        // Log::debug($this->email);

        // En caso de haber un error de validacion laravel se brinca directo a renderizar la livewire.landing-page
        $this->validate();

        // Esta prueba de DB es para si falla la verificacion el email que se registro no se guarde en la DB
        DB::transaction(function() {
            $subscriber = Subscriber::create([
                  'email' => $this->email,
            ]);
            $notification = new VerifyEmail;
            $notification::createUrlUsing(function($notifiable) {
                    return URL::temporarySignedRoute(
                    'subscribers.verify',
                    now()->addMinutes(30),
                    [
                        'subscriber' => $notifiable->getKey(),
                    ]
                    );
            });
            $subscriber->notify($notification);
         }, $deadlockRetries = 5);

        // para poner en blanco em email
        // $this->email = "";
        // otra forma mejor es con un reset por si tenemos que restablecer un email por default
        $this->reset('email');

        $this->showSubscribe = false;
        $this->showSuccess = true;
        
    }   

    public function render()
    {
        return view('livewire.landing-page');
    }
}
