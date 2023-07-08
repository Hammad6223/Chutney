<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;

    protected $table='product';
    protected $fillable = ['id','name' ,'price','image','category_id','quantity','total_quantity','description'];

    public function product_cat(){
        
        return $this->belongsTo(category::class,'category_id');    
    }
}
