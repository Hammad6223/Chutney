<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order_detail extends Model
{
    use HasFactory;
    protected $table='order_detail';
    protected $fillable = ['id','order_id','product_id','price','quantity' ];


    public function product(){
        
        return $this->belongsTo(product::class,'product_id');    
    }

    // public function user_error(){
        
    //     return $this->belongsTo(user::class,'user_id');    
    // }

}
