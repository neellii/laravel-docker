<?php

namespace App\Http\Filters;

use Illuminate\Database\Eloquent\Builder;

class ProductFilter extends AbstractFilter
{
  public const TITLE = 'title';
  public const PRICE = 'price';
  public const CATEGORY_ID = 'category_id';

  public const AUTHOR = 'author';

  public const PUBLISHED_YEAR = 'published_year';

  protected function getCallbacks(): array
  {
    return [
      self::TITLE => [$this, 'title'],
      // self::AUTHOR => [$this, 'author'],
      self::PRICE => [$this, 'price'],
      self::CATEGORY_ID => [$this, 'category_id'],
      self::PUBLISHED_YEAR => [$this, 'published_year'],
    ];
  }

  public function title(Builder $builder, $value)
  {
    $builder->where(function(Builder $query) use($value) {
      $query->where('title', 'like', "%{$value}%")->orWhere('author', 'like', "%{$value}%");
    });
  }

  public function price(Builder $builder, $value)
  {
    $builder->whereBetween('price', [$value['left_value_price'], $value['right_value_price']]);
  }

  public function category_id(Builder $builder, $value)
  {
    $builder->where('category_id', $value);
  }

  public function author(Builder $builder, $value)
  {
    $builder->orWhere('author', 'like', "%{$value}%");
  }

  public function published_year(Builder $builder, $value)
  {
    $builder->whereBetween('published_year', [$value['left_value_year'], $value['right_value_year']]);
  }
}