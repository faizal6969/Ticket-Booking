@extends('frontend.dashbord')

@section('title')
Confirmation
@endsection

@section('content')

<div class="container">

    <h2>Booking Confirmation</h2>
    <div class="card p-4">
        <p><strong>Event:</strong> {{ $booking->event->name }}</p>
        <p><strong>Venue:</strong> {{ $booking->event->venue }}</p>
        <p><strong>Date:</strong> {{ $booking->event->event_date }}</p>
        <p><strong>Tickets:</strong> {{ $booking->number_of_tickets }}</p>
        <p><strong>Total Price:</strong> ₹{{ $booking->total_price }}</p>
        <p><strong>Booking Reference:</strong> {{ $booking->booking_reference }}</p>
    </div>
</div>

@endsection