<?php

namespace Modules\Event\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Event\Entities\Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "name" => "Dentista",
            "description"=> "Levar raio-x",
            "event_time" =>  \DateTime::createFromFormat('d/m/Y G:i', "28/02/2020 16:40")->format('Y/m/d G:i:s'),
            "email_to_notification"=> "test@cazco.digital"
        ];
    }
}

