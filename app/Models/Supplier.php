<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
      'supplier_name',
      'supplier_contact_number',
      'supplier_address',
    ];

    public function supplier_product()
    {
        return $this->hasMany(Product::class);
    }
}
