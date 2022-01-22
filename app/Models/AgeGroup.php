<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgeGroup extends Model
{
    use HasFactory;
    protected $fillable = ['slug','name'];
    public function product(){
        return $this->hasMany(Product::class);
    }
}
