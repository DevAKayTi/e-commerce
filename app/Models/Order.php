<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'uuid','user_id','cart_id','order_number','currency','status',
        'subtotal_cents','discount_cents','tax_cents','shipping_cents','total_cents',
        'shipping_address','billing_address','placed_at','paid_at','cancelled_at'
    ];

    protected $casts = [
        'shipping_address' => 'array',
        'billing_address' => 'array',
        'placed_at' => 'datetime',
        'paid_at' => 'datetime',
        'cancelled_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(OrderItem::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }

    public function shipments() {
        return $this->hasMany(Shipment::class);
    }
}
