<?php

namespace Modules\Event\Tests\Feature\Event;

use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Event\Database\factories\EventFactory;
use Modules\Event\Entities\Event;
use Modules\Event\Http\Controllers\EventController;
use Modules\Event\Http\Requests\EventIndexRequest;
use Modules\Event\Http\Requests\EventRequest;
use Modules\Event\Repositories\EventRepository;
use Tests\TestCase;

class EventReadTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_this_successfully_return_an_event_with_today_date()
    {
        //arrange
        $now = now();
        $firstEvent = EventFactory::new()->create(['event_time' => $now]);
        $secondEvent = EventFactory::new()->create();

        //act
        $response = $this->get('/api/events');

        //assert
        $this->assertCount(1, $response->json());
        $this->assertEquals($response[0], [
            'id' => $firstEvent->id,
            'name' => $firstEvent->name,
            'description' => $firstEvent->description,
            'event_time' => $firstEvent->event_time,
            'email_to_notification' => $firstEvent->email_to_notification
        ]);

    }

    public function test_if_this_successfully_return_an_event_with_filter_date()
    {
        //arrange
        $firstEvent = EventFactory::new()->create(['event_time' => Carbon::make('2001/11/27')]);
        $secondEvent = EventFactory::new()->create();

        //act
        $response = $this->get('/api/events?day=27-11-2001');

        //assert
        $this->assertCount(1, $response->json());
        $this->assertEquals($response[0], [
            'id' => $firstEvent->id,
            'name' => $firstEvent->name,
            'description' => $firstEvent->description,
            'event_time' => $firstEvent->event_time,
            'email_to_notification' => $firstEvent->email_to_notification
        ]);
    }

    public function test_if_this_fails_return_of_creating_an_event()
    {
        //arrange
        $model = (new Event());
        $repository = new EventRepository($model->setTable('aba'));
        $controller = (new EventController($repository));

        $firstEvent = EventFactory::new()->create(['event_time' => Carbon::make('2001/11/27')]);
        $secondEvent = EventFactory::new()->create();

        $request = new EventIndexRequest();

        //act and assert
        $this->expectException('App\Exceptions\InternalErrorException');
        $controller->index($request);
    }
}