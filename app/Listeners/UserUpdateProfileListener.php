<?php

namespace App\Listeners;

use App\Events\UserUpdateProfile;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserUpdateProfileListener
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
     * @param  UserUpdateProfile  $event
     * @return void
     */
    public function handle(UserUpdateProfile $event)
    {
        print_r('<pre>'.(__FILE__).':'.(__LINE__).'<hr />'.print_r( $event->msg ,true).'</pre>');
    }
}
