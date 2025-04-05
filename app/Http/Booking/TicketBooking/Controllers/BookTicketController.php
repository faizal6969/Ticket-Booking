<?php

namespace App\Http\Booking\TicketBooking\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Http\Requests\BookingRequest;
use App\Http\Booking\TicketBooking\Service\BookingService;

class BookTicketController extends Controller
{

    protected $bookingService;

    public function __construct(BookingService $bookingService)
    {
        $this->bookingService = $bookingService;
    } 

    public function create() {
        $data['users'] = $this->bookingService->getUsers();
        $data['events'] = $this->bookingService->getEvents();
        $data['heading'] = 'Create Booking'; 
        
        return view('frontend.pages.booking_add', $data);
    }


    public function store(BookingRequest $request)
    {
        $booking = $this->bookingService->book($request->validated());

        return view('frontend.pages.booking_confirmation', compact('booking'));
    }


    public function myBookings() {
        $bookings = $this->bookingService->getUserBookings(auth()->id());
        $heading = 'My Booking';

        return view('frontend.pages.book_listing', compact('bookings', 'heading'));
    }
}
