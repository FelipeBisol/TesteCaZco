<?php

namespace Modules\Event\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;
use Modules\Event\Emails\SendEventAlert;
use Modules\Event\Entities\Event;

class EventAlertJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Event $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function handle()
    {
//        Mail::to($this->event->email_to_notification)->send(new SendEventAlert());
        $this->event->update(['sent' => 1]);
    }
}
