<?php

namespace Modules\Event\Tests\Feature\Event;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Event\Database\factories\EventFactory;
use Modules\Event\Entities\Event;
use Modules\Event\Http\Controllers\EventController;
use Modules\Event\Http\Requests\EventUpdateRequest;
use Modules\Event\Repositories\EventRepository;
use Tests\TestCase;

class EventDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_this_successfully_delete_an_event()
    {
        //arrange
        $event = EventFactory::new()->create();

        //act
        $response = $this->delete("api/event/{$event->id}");

        //assert
        $this->assertDatabaseMissing('events', $event->toArray());
        $response->assertStatus(200);
    }

    public function test_if_this_fails_return_of_deleting_an_event()
    {
        //arrange
        $model = (new Event());
        $repository = new EventRepository($model->setTable('aba'));
        $controller = (new EventController($repository));

        $event = EventFactory::new()->create();

        //act and assert
        $this->expectException('App\Exceptions\InternalErrorException');
        $controller->destroy($event->id);
    }
}