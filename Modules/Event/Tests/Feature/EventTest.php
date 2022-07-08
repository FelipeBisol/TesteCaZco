<?php

namespace Modules\Event\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Event\Database\factories\EventFactory;
use Modules\Event\Entities\Event;
use Tests\TestCase;

class EventTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_this_successfully_creates_an_event()
    {
        $now = now();
        $event1 = EventFactory::new()->create(['name' => 'teste1', 'event_time' => $now->format('d/m/Y G:i')]);
        $event2 = EventFactory::new()->create(['name' => 'teste2', 'event_time' => $now->subMinutes(10)->format('d/m/Y G:i')]);
        $event3 = EventFactory::new()->create(['name' => 'teste3', 'event_time' => $now->addMinutes(5)->format('d/m/Y G:i')]);
        $event4 = EventFactory::new()->create(['name' => 'teste4', 'event_time' => $now->addMinutes(20)->format('d/m/Y G:i')]);

        $return = Event::query()->whereBetween('event_time', [now(), now()->addMinutes(10)])->get();

        //n aparecer = 4 e 2
        //aparecer = 1 e 3


        dd($return);
    }
}