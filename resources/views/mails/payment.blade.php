<div>
    <h3>Your Reservation Details</h3>
    <p>Room: {{ $payment->booking->booking_rooms[0]->room_type->title }}</p>
    <p>Hotel: {{ $payment->booking->hotel->name }}</p>
    <p>Location: {{ $payment->booking->hotel->location->address }}</p>
    <p>Check In: {{ $payment->booking->booking_rooms[0]->check_in }}</p>
    <p>Check Out: {{ $payment->booking->booking_rooms[0]->check_out }}</p>
    <p>Adults: {{ $payment->booking->booking_rooms[0]->adults }}</p>
    <p>Children: {{ $payment->booking->booking_rooms[0]->children }}</p>
    <p>Booking Ref: <b>{{ $payment->booking->booking_ref}}</b></p>
    <p>Payment due: &#8358;{{ number_format($payment->booking->total_due, 2) }}</p>
    <p><hr></p>
    <p>Payment Method: {{ $payment->payment_method }}</p>
    <p>Payment Status: {{ $payment->payment_status }}</p>
    <p>Payment Ref: {{ $payment->payment_ref }}</p>
    <p>Reservation Status: {{ $payment->booking->booking_status }}</p>
</div>