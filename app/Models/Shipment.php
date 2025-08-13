<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','carrier','service','tracking_number','status','address','shipped_at','delivered_at'
    ];

    protected $casts = [
        'address' => 'array',
        'shipped_at' => 'datetime',
        'delivered_at' => 'datetime',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
