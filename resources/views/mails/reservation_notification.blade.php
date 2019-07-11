<div>
    <h3>New Reservation on Hotel Valerie Suites</h3>
    <p>Customer: {{ $booking->first_name }} {{ $booking->last_name }}</p>
    <p>Customer Phone: {{ $booking->phone }}</p>
    <p>Customer Email: {{ $booking->email }}</p>
    <p>Room: {{ $booking->booking_rooms[0]->room_type->title }}</p>
    <p>Hotel: {{ $booking->hotel->name }}</p>
    <p>Location: {{ $booking->hotel->location->address }}</p>

    <p>Check In: {{ $booking->booking_rooms[0]->check_in }}</p>
    <p>Check Out: {{ $booking->booking_rooms[0]->check_out }}</p>
    <p>Adults: {{ $booking->booking_rooms[0]->adults }}</p>
    <p>Children: {{ $booking->booking_rooms[0]->children }}</p>

    <p>Special Requirement: {{ is_null($booking->special_requirement) ? 'None' : $booking->special_requirement }}</p>
    <p>Booking Ref: <b>{{ $booking->booking_ref}}</b></p>
    <p>Payment due: &#8358;{{ number_format($booking->total_due, 2) }}</p>
    <p>Payment Method: {{ $booking->payments[0]->payment_method }}</p>
</div>