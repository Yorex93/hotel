<div>
    <h3>Your Reservation Details</h3>
    <p>Room: {{ $booking->booking_rooms[0]->room_type->title }}</p>
    <p>Hotel: {{ $booking->hotel->name }}</p>
    <p>Location: {{ $booking->hotel->location->address }}</p>
    <p>Check In: {{ $booking->booking_rooms[0]->check_in }}</p>
    <p>Check Out: {{ $booking->booking_rooms[0]->check_out }}</p>
</div>