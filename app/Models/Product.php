<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'category_id',
      'supplier_id',
      'brand_id',
      'product_name',
      'product_quantity',
      'product_price',
    ];

    public function product_category()
    {
        return $this->belongsTo(Category::class);
    }

    public function product_supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function product_brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
