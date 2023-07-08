<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    use HasFactory;
    protected $table='order';
    protected $fillable = ['id','user_id','total_price','status' ,'total_item','address_id','slip','bank_slip'];


    public function orders(){
        
        return $this->hasMany(order_detail::class,'order_id');    
    }

    public function user(){
        
        return $this->belongsTo(user::class,'user_id');    
    }
    
      public function address(){
        
        return $this->belongsTo(address::class,'address_id');    
    }
}
