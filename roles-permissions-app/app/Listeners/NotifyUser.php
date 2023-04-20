<?php

namespace App\Listeners;

use App\Events\PageCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Listeners\NotifyUser;
use App\Model\User;

class NotifyUser
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
     * @param  \App\Events\PageCreated  $event
     * @return void
     */
    public function handle(PageCreated $event)
    {
        $page = $event->page;
        $user = auth::user(); 

        $user->notify(new NotifyUser($page));
    }
}
