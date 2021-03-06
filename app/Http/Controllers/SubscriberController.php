<?php

namespace App\Http\Controllers;

use App\Models\Subscriber;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
   
   public function all()
   {
      return view('subscribers.all')->with([
         'subscribers' => Subscriber::all(),
         //'subscribers' => collect(), //enviar una lista vacia
      ]);
   }

   public function verify(Subscriber $subscriber)
   {
      if (! $subscriber->hasVerifiedEmail()){
         $subscriber->markEmailAsVerified();
      }
      return redirect('/?verified=1');
   }
}
