<?php

namespace App\Listeners;

use App\Mail\PlaceAnOrderSuccessfully;
use Illuminate\Support\Facades\mail;
use App\Events\NewOrderHasCreatedEvent;
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
   * @param  NewOrderHasCreatedEvent  $event
   * @return void
   */
  public function handle(NewOrderHasCreatedEvent $event)
  {
    Mail::to($event->user->email)->send(new PlaceAnOrderSuccessfully());
  }
}
