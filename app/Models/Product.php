<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;



    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'brand',
        'status',
        'color',
        'discount',
        'stock',
        'image',
        'category_id'

    ];

    public $timestamps = true;



    public function getCategoryName()
{
    $category = Category::find($this->category_id);
    return $category ? $category->name : 'N/A';
}


public function discountedPrice()
{
    $discountedAmount = $this->price * ($this->discount / 100);
    return $this->price - $discountedAmount;
}

public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
