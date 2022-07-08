<?php

namespace Modules\Event\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EventTest extends TestCase
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
    }
}