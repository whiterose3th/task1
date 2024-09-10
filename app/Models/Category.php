<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use Backpack\CRUD\app\Models\Traits\CrudTrait;

class Category extends Model
{
    use HasFactory;
    use CrudTrait;


    protected $fillable = ['name'];


    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
