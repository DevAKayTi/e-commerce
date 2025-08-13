<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id','sku','title','price_cents','compare_at_price_cents','cost_cents','currency',
        'weight_g','length_mm','width_mm','height_mm','barcode','is_default','position','option_values'
    ];

    protected $casts = [
        'option_values' => 'array',
        'is_default' => 'boolean',
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function inventory() {
        return $this->hasOne(Inventory::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }
}
