<?php

namespace App\Http\Booking\TicketBooking\Service;

use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Booking\Users\Repositories\UserRepository;
use App\Http\Booking\Events\Repositories\EventRepository;
use App\Http\Booking\TicketBooking\Repositories\BookingRepository;

class BookingService
{
    protected $eventRepo;
    protected $bookingRepo;
    protected $userRepository;

    public function __construct(EventRepository $eventRepo, BookingRepository $bookingRepo, UserRepository $userRepository)
    {
        $this->eventRepo = $eventRepo;
        $this->bookingRepo = $bookingRepo;
        $this->userRepository = $userRepository;
    }

    public function getUserBookings($userId)
    {
        return $this->bookingRepo->getUserBookingsPaginated($userId);
    }


    public function getUsers()
    {
        return $this->userRepository->getUsers();
    }

    public function getEvents()
    {
        return $this->eventRepo->getEvents();
    }

    public function book(array $data)
    {
        return DB::transaction(function () use ($data) {
            // Lock event row to prevent race conditions
            $event = $this->eventRepo->lockEvent($data['event_id']);
           
            if ($event->available_seats < $data['number_of_tickets']) {
                throw new \Exception("Not enough seats available");
            }

            // Calculate total price
            $totalPrice = $event->ticket_price * $data['number_of_tickets'];
            $data['total_price'] = $totalPrice;


            // Create booking
            $booking = $this->bookingRepo->create($data);

            // Generate booking reference
            $bookingRef = 'BOOK-' . str_pad($booking->id, 6, '0', STR_PAD_LEFT);
            $this->bookingRepo->updateReference($booking->id, $bookingRef);

            // Decrement available seats
            $this->eventRepo->decreaseSeats($event->id, $data['number_of_tickets']);

            // Return with related event data for confirmation view
            return $booking->fresh()->load('event');
        });
    }


}
