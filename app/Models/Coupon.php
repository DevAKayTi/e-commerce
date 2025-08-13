<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code','type','value','min_subtotal_cents','max_uses','max_uses_per_user','starts_at','ends_at','is_active'
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function redemptions() {
        return $this->hasMany(CouponRedemption::class);
    }
}
