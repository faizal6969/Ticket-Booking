@extends('frontend.dashbord')


@section('title', $heading)


@section('content')

 <!-- Main Content -->
 <div class="container mt-5">
    <h2 class="mb-4">Add Booking</h2>

    <form action="{{ url('store') }}" method="POST">
        @csrf
    
        <div class="mb-3">
            <label for="event" class="form-label">Select User</label>
            <select class="form-select" id="user_id" name="user_id">
                <option value="">Choose a user...</option>
                @foreach ($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            @error('user_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="event" class="form-label">Select Event</label>
            <select class="form-select" id="event_id" name="event_id">
                <option value="">Choose an event...</option>
                @foreach ($events as $event)
                    <option value="{{ $event->id }}" data-price="{{ $event->ticket_price }}">{{ $event->name }}</option>
                @endforeach
            </select>
            @error('event_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="tickets" class="form-label">Number of Tickets</label>
            <input type="number" class="form-control" placeholder="Number of Tickets" id="tickets" name="number_of_tickets" min="1">
            @error('number_of_tickets')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>
    
        <div class="mb-3">
            <label for="total_price" class="form-label">Total Price</label>
            <input type="text" class="form-control" placeholder="Total Price" id="total_price" name="total_price" readonly>
        </div>
    
        <button type="submit" class="btn btn-primary">Book Now</button>
    </form>
</div>

@endsection


@section('script')


{{-- JavaScript --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const eventSelect = document.getElementById('event_id');
        const ticketInput = document.getElementById('tickets');
        const totalPriceInput = document.getElementById('total_price');

        function calculateTotal() {
            const selectedOption = eventSelect.options[eventSelect.selectedIndex];
            const pricePerTicket = parseFloat(selectedOption.getAttribute('data-price')) || 0;
            const numberOfTickets = parseInt(ticketInput.value) || 0;
            const total = pricePerTicket * numberOfTickets;
            totalPriceInput.value = total.toFixed(2);
        }

        eventSelect.addEventListener('change', calculateTotal);
        ticketInput.addEventListener('input', calculateTotal);
    });
</script>

@endsection