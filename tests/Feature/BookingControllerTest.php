<?php

namespace Tests\Feature;

use Mockery;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\Http\Booking\TicketBooking\Service\BookingService;

class BookingControllerTest extends TestCase
{

    use DatabaseTransactions;
    

     public function test_create_method_displays_booking_add_view_with_data()
     {
         // Create a test user and authenticate
         $user = User::create([
             'name' => 'John Doe',
             'email' => 'john.doe@example.com',
             'password' => Hash::make('password123'),
         ]);
         $this->actingAs($user);
 
         // Mock the bookingService to return specific data
         $mockBookingService = Mockery::mock(BookingService::class);
         $mockBookingService->shouldReceive('getUsers')->once()->andReturn(collect([$user]));
         $mockBookingService->shouldReceive('getEvents')->once()->andReturn(collect());
 
         // Bind the mock to the container
         $this->app->instance(BookingService::class, $mockBookingService);
 
         // Call the create method
         $response = $this->get(route('bookings.create'));
 
         // Assert the view is correct
         $response->assertViewIs('frontend.pages.booking_add');
 
         // Assert the view has the expected data
         $response->assertViewHas('users', function ($users) use ($user) {
             return $users->contains('id', $user->id);
         });
 
         $response->assertViewHas('events', function ($events) {
             return $events->isEmpty();
         });
 
         $response->assertViewHas('heading', 'Create Booking');
     }
 
     protected function tearDown(): void
     {
         Mockery::close();
         parent::tearDown();
     }
}  
