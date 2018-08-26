<?php

namespace Hotel\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Payment.
 *
 * @package namespace Hotel\Entities;
 * @property int $id
 * @property int $booking_id
 * @property int $payment_method_id
 * @property string $payment_ref
 * @property string $transaction_ref
 * @property string $payer_full_name
 * @property string $payer_phone
 * @property string $payer_email
 * @property string $narration
 * @property float $total_amount
 * @property string $payment_status
 * @property string|null $payment_status_message
 * @property string|null $payment_date
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @mixin \Eloquent
 */
class Payment extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

	/**
	 * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
	 */
    public function booking(){
    	return $this->belongsTo(Booking::class);
    }
}
