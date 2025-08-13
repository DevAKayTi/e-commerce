<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','guest_token','currency','subtotal_cents','discount_cents',
        'tax_cents','shipping_cents','total_cents','status','expires_at'
    ];

    protected $casts = [
        'expires_at' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function items() {
        return $this->hasMany(CartItem::class);
    }
}
