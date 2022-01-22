<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = ['category_id','slug','name','image','age_group_id','description','price','view_count'];

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function ageGroup(){
        return $this->belongsTo(AgeGroup::class);
    }
    public function productOrders(){
        return $this->hasMany(ProductOrder::class);
    }
    public function likes(){
        return $this->hasMany(Like::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function favourites(){
        return $this->hasMany(FavList::class);
    }
}

