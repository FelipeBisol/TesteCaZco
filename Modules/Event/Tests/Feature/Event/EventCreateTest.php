<?php

namespace Modules\Event\Tests\Feature\Event;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Modules\Event\Entities\Event;
use Modules\Event\Http\Controllers\EventController;
use Modules\Event\Http\Requests\EventRequest;
use Modules\Event\Repositories\EventRepository;
use Tests\TestCase;

class EventCreateTest extends TestCase
{
    use RefreshDatabase;

    public function test_if_this_successfully_creates_an_event()
    {
        //arrange
        $payload = [
            "name" => "Dentista",
            "description"=> "Levar raio-x",
            "event_time"=> "28/02/2020 16:40",
            "email_to_notification"=> "test@cazco.digital"
        ];

        //act
        $response = $this->post('/api/event', $payload);

        //assert
        $this->assertDatabaseHas('events', $payload);
        $response->assertStatus(200);
    }

    public function test_if_this_fails_validation_of_creating_an_event()
    {
        //arrange
        $payload = [
            "description"=> "Levar raio-x",
            "event_time"=> "28/02/2020 16:40",
            "email_to_notification"=> "test@cazco.digital"
        ];

        //act
        $response = $this->post('/api/event', $payload);

        //assert
        $this->assertDatabaseMissing('events', $payload);
        $response->assertStatus(400);
    }

    public function test_if_this_fails_return_of_creating_an_event()
    {
        //arrange
        $model = (new Event());
        $repository = new EventRepository($model->setTable('aba'));
        $controller = (new EventController($repository));

        $request = new EventRequest(["name" => "Dentista",
            "description"=> "Levar raio-x",
            "event_time"=> "28/02/2020 16:40",
            "email_to_notification"=> "test@cazco.digital"]);

        //act

        //assert
        $this->expectException('App\Exceptions\InternalErrorException');
        $controller->store($request);
    }
}