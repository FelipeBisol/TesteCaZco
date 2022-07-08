<?php

namespace Modules\Event\Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Modules\Event\Database\factories\EventFactory;
use Modules\Event\Entities\Event;
use Modules\Event\Jobs\NextEventsJob;
use Tests\TestCase;

class EventTest extends TestCase
{

    public function test_if_this_successfully_creates_an_event()
    {
        (new NextEventsJob())->handle();
    }
}