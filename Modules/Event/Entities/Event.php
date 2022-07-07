<?php

namespace Modules\Event\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'event_time', 'email_to_notification'];
    
    protected static function newFactory()
    {
        return \Modules\Event\Database\factories\EventFactory::new();
    }
}
