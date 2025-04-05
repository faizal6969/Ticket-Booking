<?php

namespace App\Http\Booking\TicketBooking\Repositories;

use App\Models\Booking;

class BookingRepository
{
    public function createBooking(array $data)
    {
        return Booking::create($data);
    }

    public function getUserBookings($userId)
    {
        return Booking::where('user_id', $userId)->paginate(10);
    }


    public function create(array $data)
    {
        return Booking::create([
            'user_id' => $data['user_id'],
            'event_id' => $data['event_id'],
            'number_of_tickets' => $data['number_of_tickets'],
            'total_price' => $data['total_price'],
        ]);
    }

    public function updateReference($id, $ref)
    {
        return Booking::where('id', $id)->update(['booking_reference' => $ref]);
    }


    public function getUserBookingsPaginated($userId, $perPage = 10)
    {
        return Booking::with('event')
            ->where('user_id', $userId)
            ->latest()
            ->paginate($perPage);
    }


}
