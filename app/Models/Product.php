<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_name_ar','product_name_en','product_description_ar','product_description_en','section_id'];



    public function section(){
        return $this->belongsTo(section::class,'section_id');
    }
}
