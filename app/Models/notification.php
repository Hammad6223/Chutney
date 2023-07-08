<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{

    protected $table='notification';
    protected $fillable = ['id','user_id','message','subject' ];
    
    use HasFactory;


    public function user(){
        
        return $this->belongsTo(user::class,'user_id');    
    }
}
