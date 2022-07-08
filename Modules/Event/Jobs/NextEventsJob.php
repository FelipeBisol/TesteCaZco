<?php

namespace Modules\Event\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Modules\Event\Entities\Event;

class NextEventsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct()
    {
        //
    }

    public function handle()
    {
        $start = now()->subMinutes(2)->format('Y-m-d G:i:s');
        $end = now()->addMinutes(10)->format('Y-m-d G:i:s');

        Event::query()->whereBetween('event_time', [ $start, $end])
            ->where('sent', '=', false)
            ->chunk(20, function($events){
                foreach ($events as $event){
                    EventAlertJob::dispatch($event);
                }
            });
    }
}
