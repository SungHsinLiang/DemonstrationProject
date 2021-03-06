<?php

namespace App\Providers;

use App\Events\NewUserHasRegisteredEvent;
use App\Events\NewOrderHasCreatedEvent;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
  /**
   * The event listener mappings for the application.
   *
   * @var array
   */
  protected $listen = [
    Registered::class => [
      SendEmailVerificationNotification::class,
    ],
    NewUserHasRegisteredEvent::class => [
      \App\Listeners\WelcomeNewUserListener::class,
    ],
    NewOrderHasCreatedEvent::class => [
	    \App\Listeners\NotifyTheCustomerThatTheOrderHasBeenCreatedSuccessfully::class,
    ]
  ];

  /**
   * Register any events for your application.
   *
   * @return void
   */
  public function boot()
  {
    parent::boot();

    //
  }
}
