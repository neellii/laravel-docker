<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    protected $fillable = [
       'user_id', 'product_id', 'subject', 'review', 'IP', 'rate', 'status'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);   
    }

    public function user()
    {
        return $this->belongsTo(User::class);   
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
