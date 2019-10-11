<?php

namespace App\Providers;

use App\Events\SendEmailToMemberEvent;
use App\Mail\MemberMail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;

class SendEmailToMemberListener implements ShouldQueue
{
    public function handle(SendEmailToMemberEvent $event)
    {
        sleep(3);
        return Mail::to('saisailuhlaing@gmail.com')->send(new MemberMail($event->user));
    }
}
