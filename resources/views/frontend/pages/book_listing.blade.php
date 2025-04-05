@extends('frontend.dashbord')

@section('title', $heading)

@section('content')

{{-- <h2 class="mb-4 text-center">User List</h2> --}}
<div class="d-flex justify-content-between align-items-center mb-3 p-3">
    <h2>Booking List</h2>
    <a href="{{url('create')}}" class="btn btn-info px-4 py-2">Add Booking</a>
</div>



    @if($bookings->count())
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Booking Reference</th>
                        <th>Event Name</th>
                        <th>Venue</th>
                        <th>Event Date</th>
                        <th>Tickets Booked</th>
                        <th>Total Paid</th>
                        <th>Booking Date</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td>{{ $booking->booking_reference }}</td>
                            <td>{{ $booking->event->name ?? '-' }}</td>
                            <td>{{ $booking->event->venue ?? '-' }}</td>
                            <td>{{ \Carbon\Carbon::parse($booking->event->event_date)->format('d M Y') }}</td>
                            <td>{{ $booking->number_of_tickets }}</td>
                            <td>₹ {{ number_format($booking->total_price, 2) }}</td>
                            <td>{{ $booking->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        

        {{ $bookings->links() }}
    @else
        <p>No bookings found.</p>
    @endif
</div>


@endsection


