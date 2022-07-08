<?php

namespace Modules\Event\Tests\Feature\Event;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Event\Database\factories\EventFactory;
use Modules\Event\Entities\Event;
use Modules\Event\Http\Controllers\EventController;
use Modules\Event\Http\Requests\EventRequest;
use Modules\Event\Http\Requests\EventUpdateRequest;
use Modules\Event\Repositories\EventRepository;
use Tests\TestCase;

class EventUpdateTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_this_successfully_creates_an_event()
    {
        //arrange
        $event = EventFactory::new()->create();
        $payloadUpdated = 'test update';

        //act
        $response = $this->put("api/event/{$event->id}", ['name' => $payloadUpdated]);

        //assert
        $response->assertStatus(200);
        $this->assertDatabaseHas('events', [
            'name' => $payloadUpdated,
            'description' => $event->description,
            'email_to_notification' => $event->email_to_notification
        ]);
    }

    public function test_if_this_fails_validation_of_updating_an_event()
    {
        //arrange
        $event = EventFactory::new()->create();
        $event->name = 123;

        //act
        $response =  $this->put("api/event/{$event->id}", $event->toArray());

        //assert
        $this->assertDatabaseMissing('events', $event->toArray());
        $response->assertStatus(400);
    }

    public function test_if_this_fails_return_of_updating_an_event()
    {
        //arrange
        $model = (new Event());
        $repository = new EventRepository($model->setTable('aba'));
        $controller = (new EventController($repository));

        $request = new EventUpdateRequest(["name" => "Dentista"]);
        $event = EventFactory::new()->create();

        //act and assert
        $this->expectException('App\Exceptions\InternalErrorException');
        $controller->update($request, $event->id);
    }
}