<?php

namespace App\Listeners;

use App\Events\AdminCreateMail;
use App\Mail\AdminUserRegister;
use Illuminate\Support\Facades\Mail;

class SenduserMail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(AdminCreateMail $event): void
    {
        //

        Mail::to($event->admin->email)->send(new AdminUserRegister($event->admin, $event->password));
    }
}
