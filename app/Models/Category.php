<?php

namespace App\Models;

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'parent_id', 'title', 'keywords', 'description', 'image', 'status' 
    ];

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id')->where('parent_id', null)->with('parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id')->with('children');
    }

    public function getParentsAttribute()
    {
        $parents = collect([]);

        $parent = $this->parent;

        while(!is_null($parent)) {
            $parents->push($parent);
            $parent = $parent->parent;
        }

        return $parents;
    }

    public function products(): HasMany
    {
        return $this->hasMany(Product::class, 'category_id');
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
