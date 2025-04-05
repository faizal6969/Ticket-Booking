----------PROJECT DETAILS----------

# 1.php artisan migrate 
# 2.php artisan db:seed
# 3.Install and set up Laravel Breeze for authentication (registration and login).
# 4.After logging in, you can view the ticket booking list page with all details.
# 5. You can create a new booking. For example, if you book 10 tickets from the events table, the total tickets in the events table will be reduced by the number of newly added tickets.
# 6. App/Http/Booking/
#└── TicketBooking/
#    ├── Controller/
#    ├── Service/
#    └── Repository/
#USER and EVENT
#7. Php unit test completed command = php artisan test --filter=BookingControllerTest
#8.Eloquent ORM is used for database interactions.
#9.The application follows the pattern: Controller → Service → Repository. Only the Repository layer accesses the database tables directly.
#10.Request method validation is implemented, and error messages are displayed on the ticket booking page.