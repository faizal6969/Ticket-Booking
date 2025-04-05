<?php

namespace App\Http\Booking\Events\Repositories;

use App\Models\Event;

class EventRepository
{
    public function getEvents()
    {
        return Event::select('id', 'name', 'venue', 'event_date', 'available_seats', 'ticket_price')->get();
    }

    public function lockEvent($id)
    {
        return Event::where('id', $id)->lockForUpdate()->firstOrFail();
    }

    public function decreaseSeats($id, $count)
    {
        Event::where('id', $id)->decrement('available_seats', $count);
    }
}
