<?php
namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\ProductImage;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'uuid','user_id','category_id','name','slug','short_description','description',
        'has_variants','price_cents','compare_at_price_cents','currency','is_active',
        'published_at','options'
    ];

    protected $casts = [
        'options' => 'array',
        'published_at' => 'datetime',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function variants() {
        return $this->hasMany(ProductVariant::class);
    }

    public function images() {
        return $this->hasMany(ProductImage::class);
    }
}
