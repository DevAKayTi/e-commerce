<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id','provider','reference','amount_cents','currency','status','payload','paid_at'
    ];

    protected $casts = [
        'payload' => 'array',
        'paid_at' => 'datetime',
    ];

    public function order() {
        return $this->belongsTo(Order::class);
    }
}
