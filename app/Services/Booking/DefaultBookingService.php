<?php
/**
 * Created by PhpStorm.
 * User: blackbush
 * Date: 21/08/2018
 * Time: 9:09 PM
 */

namespace Hotel\Services\Booking;


use Carbon\Carbon;
use Hotel\Entities\Booking;
use Hotel\Entities\HotelSettings;
use Hotel\Entities\Payment;
use Hotel\Entities\Room;
use Hotel\Mail\PaymentConfirmed;
use Hotel\Mail\Reservation;
use Hotel\Mail\ReservationNotification;
use Hotel\Repositories\BookingRepository;
use Hotel\Repositories\BookingRoomRepository;
use Hotel\Repositories\PaymentRepository;
use Hotel\Repositories\RoomRepository;
use Hotel\Repositories\RoomTypeRepository;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;

class DefaultBookingService implements BookingService {

	protected $bookingRepo;
	protected $roomRepo;
	protected $bookingRoomRepo;
	protected $roomTypeRepo;
	protected $paymentRepo;
	protected $roomTypeService;

	public function __construct(BookingRepository $booking_repository,
		RoomRepository $room_repository, BookingRoomRepository $booking_room_repository,
		RoomTypeRepository $room_type_repository, PaymentRepository $payment_repository, RoomTypeService $room_type_service) {
		$this->bookingRepo = $booking_repository;
		$this->roomRepo = $room_repository;
		$this->bookingRoomRepo = $booking_room_repository;
		$this->roomTypeRepo = $room_type_repository;
		$this->paymentRepo = $payment_repository;
		$this->roomTypeService = $room_type_service;
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed | Booking
	 * @throws \Exception
	 */
	function createBooking( Request $request ) {
		$room_id = $request->get('roomId');
		$booking_id = 0;
		$booking_room_id = 0;
		$payment_id = 0;
		$hotel_settings = HotelSettings::all();
		$hotel_setting = null;
		if($hotel_settings->count() > 0){
			$hotel_setting = $hotel_settings->first();
		}

		try{
			$room = $this->roomRepo->find($room_id);
			$room_type = $this->roomTypeRepo->find($room->room_type_id);

			if(!$room_type){
				throw new \Exception("Room Type not found");
			}
			$checkIn = $request->get('checkIn');
			$checkOut = $request->get('checkOut');
			$children = $request->get('children');
			$adults = $request->get('adults');


			$checkInDate = Carbon::createFromTimestampMs($checkIn)->format('Y-m-d');
			$checkOutDate = Carbon::createFromTimestampMs($checkOut)->format('Y-m-d');

			$days = Carbon::createFromTimestampMs($checkOut)->startOfDay()
			                                                ->diffInDays(Carbon::createFromTimestampMs($checkIn)->startOfDay());

			$rooms = $this->getRoomsFor($checkInDate, $checkOutDate, $room->room_type_id, $room->hotel_id);

			if(count($rooms) > 0){
				$randRoom = $rooms[0];
				$total_due = $days * $room_type->base_price_per_night;

				$booking = $this->bookingRepo->create([
					'hotel_id' => $room->hotel_id,
					'title' => $request->get('title'),
					'first_name' => $request->get('firstName'),
					'last_name' => $request->get('lastName'),
					'phone' => $request->get('phone'),
					'email' => $request->get('email'),
					'address' => $request->get('address'),
					'special_requirement' => $request->get('specialRequest'),
					'booking_status' => 'PENDING',
					'total_due' => $total_due,
					'booking_ref' => strtoupper(str_random(10))
				]);

				$booking_id = $booking->id;

				$bookingRoom = $this->bookingRoomRepo->create([
					'booking_id' => $booking->id,
					'room_type_id' => $room_type->id,
					'room_id' => $randRoom->id,
					'check_in' => $checkInDate,
					'check_out' => $checkOutDate,
					'adults' => $adults,
					'children' => $children,
					'amount' => $total_due,
					'total' => $total_due
				]);
				$booking_room_id = $bookingRoom->id;


				$payment = $this->paymentRepo->create([
					'booking_id' => $booking->id,
					'payment_method' => $request->get('paymentMethod'),
					'payment_ref' => strtoupper(str_random(20)),
					'transaction_ref' => strtoupper(str_random(8)),
					'payer_full_name' => $request->get('firstName').' '.$request->get('lastName'),
					'payer_phone' => $request->get('phone'),
					'payer_email' => $request->get('email'),
					'narration' => 'Reservation',
					'total_amount' => $total_due,
					'payment_status' => 'PENDING',
				]);
				$payment_id = $payment->id;

				try{
					if($request->get('paymentMethod') === 'LOCATION'){
						$b = $this->bookingRepo->with(['hotel.location' ,'payments', 'booking_rooms.room_type'])->find($booking->id);
						Mail::to($booking->email)->send(new Reservation($b));
						if(!is_null($hotel_setting)){
							Mail::to($hotel_setting->reservation_email)->send(new ReservationNotification($b));
						}
					}

				} catch (\Exception $e){

				}

				return $this->bookingRepo->with(['payments', 'booking_rooms'])->find($booking->id);

			} else {
				throw new \Exception( "No available rooms for request" );
			}


		} catch (\Throwable $e){

			if($payment_id > 0){
				$this->paymentRepo->delete($payment_id);
			}

			if($booking_room_id > 0){
				$this->bookingRoomRepo->delete($booking_room_id);
			}

			if($booking_id > 0){
				$this->bookingRepo->delete($booking_id);
			}

			throw new \Exception($e);
		}


	}


	private function getRoomsFor($checkInDate, $checkOutDate, $room_type_id, $hotel_id){

		$rooms = Room::query()->where('room_type_id', $room_type_id)->where('hotel_id', $hotel_id)
			->whereDoesntHave('booking_rooms', function (Builder $queryBookingRooms) use ($checkInDate, $checkOutDate){
				return $queryBookingRooms->where('check_in', '>=', $checkInDate)
				                         ->where('check_in', '<=', $checkOutDate)
				                         ->whereDoesntHave('booking', function (Builder $queryBooking){
				                         	return $queryBooking->where('booking_status', 'CANCELLED');
				                         });
			})->with('room_type')->get();
		return $rooms;
	}

	/**
	 * @param int $bookingId
	 * @param Request $request
	 *
	 * @return mixed | Booking
	 */
	function updateBooking( int $bookingId, Request $request ) {
		// TODO: Implement updateBooking() method.
	}

	/**
	 * @param Request $request
	 *
	 * @return mixed | Collection
	 */
	function getBookings( Request $request ) {
		$page = $request->has('page') ? $request->get('page') : 0;
		$pageSize = $request->has('per_page') ? $request->get('per_page') : 15;
		$keyword = $request->has('keyword') ? $request->get('keyword') : null;
		$startDate = $request->has('startDate') ? $request->get('startDate') : null;
		$endDate = $request->has('endDate') ? $request->get('endDate') : null;
		$status = $request->has('status') ? $request->get('status') : null;
		$booking_ref = $request->has('booking_ref') ? $request->get('booking_ref') : null;
		$hotel_id = $request->has('hotel_id') ? $request->get('hotel_id') : null;
		$room_type_id = $request->has('room_type_id') ? $request->get('room_type_id') : null;
		$check_in = $request->has('check_in') ? $request->get('check_in') : null;

		$bookings = Booking::query();

		if(!is_null($startDate)){
			$bookings = $bookings->where('created_at', '>=', Carbon::createFromTimestampMs($startDate)
			                                                       ->startOfDay()->format('Y-m-d H:i:s'));
		}

		if(!is_null($endDate)){
			$bookings = $bookings->where('created_at', '<=', Carbon::createFromTimestampMs($endDate)
			                                                       ->endOfDay()->format('Y-m-d H:i:s'));
		}

		if(!is_null($keyword)){
			$bookings = $bookings->where('name', 'LIKE', "%$keyword%")
			                     ->orWhere('email', 'LIKE', "%$keyword%")
			                     ->orWhere('phone', 'LIKE', "%$keyword%");
		}

		if(!is_null($status)){
			$bookings = $bookings->where('booking_status', $status);
		}

		if(!is_null($booking_ref)){
			$bookings = $bookings->where('booking_ref', $booking_ref);
		}

		if(!is_null($hotel_id) || !is_null($room_type_id) || is_null($check_in)){
			$bookings = $bookings->whereHas('booking_rooms', function (Builder $bookingRoomQuery) use ($hotel_id, $room_type_id, $check_in){
				$q =  $bookingRoomQuery;
				if(!is_null($hotel_id)){
					$q = $q->where('hotel_id', $hotel_id);
				}

				if(!is_null($room_type_id)){
					$q = $q->where('room_type_id', $room_type_id);
				}

				if(!is_null($check_in)){
					$q = $q->where('check_in', Carbon::createFromTimestampMs($check_in)->format('Y-m-d'));
				}

				return $q;
			});
		}

		return $bookings->with('booking_rooms', 'payments')->orderBy('created_at', 'DESC')->paginate($pageSize, ['*'], 'page', $page);

	}

	/**
	 * @param $bookingId
	 *
	 * @return boolean
	 */
	function deleteBooking( $bookingId ) {
		return (bool) $this->bookingRepo->delete($bookingId);
	}


	/**
	 * @param string $reference
	 *
	 * @return mixed | Payment
	 * @throws \Exception
	 */
	public function checkPayment( string $reference ) {
		$payments = $this->paymentRepo->with(['booking.hotel.location', 'booking.booking_rooms.room_type'])->findWhere(['payment_ref' => $reference]);

		if(count($payments) > 0){
			$curl = curl_init();
			$payment = $payments[0];
			if(!$payment instanceof Payment){
				return response()->json(['message'=>'No payment found for ref'],500);
			}

			$booking = $payment->booking;
			if(!$booking instanceof Booking){
				return response()->json(['message'=>'No booking found for payment'],500);
			}

			$secret_key = env('PAYSTACK_LIVE_PRIVATE_KEY');
			curl_setopt_array($curl, array(
				CURLOPT_URL => "https://api.paystack.co/transaction/verify/" . rawurlencode($reference),
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_HTTPHEADER => [
					"accept: application/json",
					"authorization: Bearer ".$secret_key."",
					"cache-control: no-cache"
				],
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			if($err){
				throw new \Exception('Error connecting to paystack');
			}

			$transaction = json_decode($response);

			//dd($transaction);

			if(!$transaction->status){
				throw new \Exception('Error checking payment status');
			}

			if('success' == $transaction->data->status){
				//DO ACTION
				$previousStatus = $payment->payment_status;
				$payment->update([
					'payment_status'=>'SUCCESS',
					'payment_date'=> date('Y-m-d H:i:s', strtotime($transaction->data->transaction_date))
				]);
				$booking->update(['booking_status' => 'APPROVED']);

				if($previousStatus === 'PENDING'){
					try{
						Mail::send(new PaymentConfirmed($payment));
					} catch (\Exception $e){
						try {
							Mail::send(new PaymentConfirmed($payment));
						} catch (\Exception $e){

						}
					}

				}

				return ['message'=>'Payment Successful', 'success' => true];

			} else {
				$payment->update([
					'payment_status'=>'FAILED',
					'payment_date'=> date('Y-m-d H:i:s', strtotime($transaction->data->transaction_date))
				]);
				$booking->update(['booking_status' => 'CANCELLED']);
				return ['message'=>'Payment Unsuccessful', 'success' => false];
			}
		}
		throw new \Exception('No payment found for ref');
	}
}