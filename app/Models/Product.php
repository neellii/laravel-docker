<?php

namespace App\Models;

use App\Models\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Filterable;

    protected $table = 'products';

    protected $fillable = [
       'title', 'description', 'price', 'quantity', 'category_id', 'detail', 'keywords', 'image', 'status', 'user_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');   
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function shopcart()
    {
        return $this->hasMany(ShopCart::class);
    }

    public function orderproducts()
    {
        return $this->hasMany(OrderProduct::class);
    }

    protected function status(): Attribute
    {
        return Attribute::make(
            get: function(int $value) {
                if($value === 1) {
                    return 'published';
                } elseif($value === 0) {
                    return 'unpublished';
                }

                return 'invalid status';
            }
                
        );
    }
}
