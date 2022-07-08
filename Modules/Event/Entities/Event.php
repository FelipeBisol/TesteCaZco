<?php

namespace Modules\Event\Entities;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'event_time', 'email_to_notification'];

    protected $casts = [
        'event_time' => 'datetime:d-m-Y G:i'
    ];

    protected static function newFactory()
    {
        return \Modules\Event\Database\factories\EventFactory::new();
    }

    protected function getEventTimeAttribute($value)
    {
        $date = Carbon::make($value);
        return $date->format('d/m/Y G:i');
    }
}
