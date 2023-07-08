<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class document extends Model
{
    use HasFactory;
    protected $fillable = ['id','user_id','name','file','status'];


    public function user(){
        
        return $this->belongsTo(user::class,'user_id');    
    }
}
