<?php

namespace App\Listeners;

use App\Mail\PlaceAnOrderSuccessfully;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class NotifyTheCustomerThatTheOrderHasBeenCreatedSuccessfully implements ShouldQueue
{
  /**
   * Create the event listener.
   *
   * @return void
   */
  public function __construct()
  {
    //
  }

  /**
   * Handle the event.
   *
   * @param  object  $event
   * @return void
   */
  public function handle($event)
  {
    Mail::to($event->user->email)->send(new PlaceAnOrderSuccessfully());
  }
}
