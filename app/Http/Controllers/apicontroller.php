<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\category;
use App\Models\product;
use App\Models\address;
use App\Models\order;
use App\Models\order_detail;
use App\Models\document;
use App\Models\notification;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File; 

use ZipArchive;
class apicontroller extends Controller
{
    //

     //Login Function
     function login(request $req){
       
  
        $rules = [
            'email'=> 'required|email',
            'password'=> 'required',
        ];
        
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
    
          $user = user::where('email',$req->email)->first();
       
          if($user )
          {
            if( password_verify($req->password, $user->password) 
            && $user->status == 1 && $user->user_role  ==2){
                return response()->json(['error'=> false, 'success_msg'=> 'logged in successfully','data'=> $user]);
            }
            else{
                return response()->json(['error'=> true, 'error_msg'=> 'Ivalid Login Credentials']);
            }
          }
          else{
            return response()->json(['error'=> true, 'error_msg'=> 'Email does not exist try again']);
          }
    }
    
    
    
    // Signup Function
    
    
  public function signup(request $req)
  {
  
    $rules = ([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|max:16|min:6',
            
    ]);
    
      $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
    
   
    $user11 = User::create([
       'name'=>$req->name,
       'email'=>$req->email,
       'password'=>bcrypt($req->password),
       'user_role'=> 2,
       
       
    ]);
    
    if($user11){
        
    return response()->json(['error'=> false, 'success_msg'=> 'signup in successfully']);
      
  }
  }
  
   // Home  Function
function home(request $req){
    
     $product = product::get();
           
     $cat = category::with(['product'])->get();
    
 
   return response()->json(['product'=>$product,'category'=>$cat]);
}

  
  // Profile view Function
function profile(request $req){
    $user = user::find($req->id);
    
   return response()->json(['data'=>$user]);
}
// Edit profile

function edit_profile(request $req){

     $rules = [
            'email' => 'unique:users,email,' .$req->id.',id',
            
        ];
        
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
       $update  = user::find($req->id);
       
       if ($req->has('image')) {
$rules = [
'image' => 'mimes:jpeg,jpg,bmp,png',
];
$validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
        
$image_path = 'storage/app/' . $update->image;
//  dd($image_path);
File::delete($image_path);
$filename = $req->file('image')->store('media');
}
else {
$filename = $update->image;
}


     user::where('id',$req->id)->update([
         'name'=>$req->name,

'email'=>$req->email,
'contact'=>$req->contact,
'image'=>$filename,

  ]);
       
           $user = user::where('id',$req->id)->first(); 
  return response()->json(['error'=> false, 'success_msg'=> 'Successfully Edit Profile','data'=>$user ]);
}

// change password
function change_password(request $req){
    $rules = [
        'oldpassword' => 'required',
        'newpassword' => 'required',
        'confirmpassword' => 'same:newpassword',
        ];
        
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
        
  $user= user::find($req->id);

   if(password_verify($req->oldpassword,$user->password)){
       
            user::where('id',$user->id)->update([
         'password'=>bcrypt($req->newpassword),
]);
        return response()->json(['success_msg'=> 'Successfully Update Password']);
    }
    else{
         return response()->json(['error_msg'=> 'Old Password does not match try again']);
    }
}


    // Forget
   public function forget(request $req)
 {
    
     $rules = [
            'email'=> 'required|email',
            
        ];
        
        $validator = Validator::make($req->all(), $rules);
        if($validator->fails())
        {
            return response()->json(['error'=> true, 'error_msg'=> $validator->errors()->first()]);
        }
      
    
        $user = user::where('email', $req->email)->first();
   
      

        if ($user) {
            
           $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
    $pass = array(); //remember to declare $pass as an array
    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
            $user->password = bcrypt(implode($pass));
            $user->save();
            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $req->email;
            $from = 'info@chutney.org';
            $subject = 'Chutney Indian Food';
            $message = '<h2 style="color:#040d50">Chutney Indian Food<h2> <hr> <h4> Dear ' . $user->name .'</h4><p> There was a request for password  Chutney Indian Food  system generated password is <button style="color:#040d50">'. 
            implode($pass).' </button> </p>' ;
            $headers .= 'From: info@chutney.org'."\r\n".
            'Reply-To: info@chutney.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            if(mail($to, $subject, $message, $headers))
            {
                 return response()->json(['error'=> false, 'success_msg'=> 'You have e-mailed your password']);
            }
            else{
             return response()->json(['error'=> true, 'success_msg'=> 'Email does not exist try again!']);
            }
           
         
        }
        else{
            return response()->json(['error'=> true, 'success_msg'=> 'Email does not exist try again!']);
               
        }
     
 }
 
 
//  ADDRESS

function add_address(request $req){
    
    
   $add =  address::create([
       'user_id' => $req->user_id,
       'street' =>$req->street,
       'city' =>$req->city,
       'state' =>$req->state,
       'zip' =>$req->zip,
       'country' =>$req->country
        ]);
 return response()->json(['success_msg'=> 'Successfully!']);
}

// View
function view_address(request $req){
     $add = address::where('user_id',$req->user_id)->get();
   return response()->json(['address'=>$add]);
}

// edit
function edit_address(request $req){
    
    
   $add =  address::where('id',$req->id)->update([
       
       'street' =>$req->street,
       'city' =>$req->city,
       'state' =>$req->state,
       'zip' =>$req->zip,
       'country' =>$req->country
        ]);
        
 return response()->json(['success_msg'=> 'Successfully!']);
}
  
  
  function delete_address(request $req){
    
    
   $add =  address::find($req->id);
       $add->delete();
       

        
 return response()->json(['success_msg'=> 'Successfully!']);
}
  
  
  
//   Add document
  function add_document(request $req){
   
   
    $filename = $req->file('file')->store('media');
    
    $document = document::create([
      'user_id'=>$req->user_id,
      'name' =>$req->name,
      'file' =>$filename
      ]);
 return response()->json(['success_msg'=> 'Successfully!']);
}

//   View document
  function view_document(request $req){
   
 $document = document::where('user_id',$req->user_id)->where('status',0)->get();
 $admin = document::where('user_id',$req->user_id)->where('status',1)->get();
 return response()->json(['document'=>$document,'admin'=>$admin]);
}

//   Delete document
  function delete_document(request $req){
   
 $document = document::find($req->id);
 $destinationPath = 'storage/app/'.$document->file;
 file::delete($destinationPath);
 $document->delete();
   return response()->json(['success_msg'=> 'Successfully!']);
}


// Order

 function add_order(request $req){

    //   return $req->card;
     
    //  dd( $req->card);
     
    //  return $req->card;
     
      $order = order::create([
      'user_id'=>$req->user_id,
      'total_price' =>$req->total_price,
      'total_item' =>$req->total_item,
      'address_id'=>$req->address_id,
      ]);
     

    
    foreach($req->card as $card){
   
         $card =(object)$card;
         
       
         $pro = product::find($card->id);
        
         
         $pr=  product::where('id',$pro->id)->update([
             'total_quantity'=> $pro->total_quantity - $card->quantity
             ]);
             
          $add = order_detail::create([
      'order_id'=>$order->id,
      'product_id' =>(int) $card->id,
      'quantity' => (int) $card->quantity,
        // array_push($items, $card->id);
    ]);
   
    } 

        
 return response()->json(['success_msg'=> 'Successfully!']);
}




    function view_order(request $req){
  
    $order = order::with(['orders.product.product_cat','address'])->orderBy('id', 'DESC')->where('user_id',$req->user_id)->get();
    return $order;
 
}
  
  
  
    function add_slip(request $req){
        
        $user = user::where('user_role',1)->first();
        
         $ord =  order ::with(['user'])->where('id',$req->order_id)->first();
        
        
            
      
    $filename = $req->file('file')->store('media');

    
    $document = order::where('id',$req->order_id)->update([
      
      'bank_slip' =>$filename,
      'status'=>2
      ]);
      
          $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $user->email;
            $from = 'info@chutney.org';
            $subject = 'Chutney Indian Food';
            $message = '<h4> Dear ' . $user->name .'</h4> <p>  Uploaded Bank Slip where frenchies name is  <b> '  . $ord->user->name .' </b> </p>' ;
            $headers .= 'From: info@chutney.org'."\r\n".
            'Reply-To: info@chutney.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            if(mail($to, $subject, $message, $headers))
            {
                  return response()->json(['success_msg'=> 'Successfully!']);
            }

 
}

  


    function notification(request $req){
        
        $noti = notification::where('user_id',$req->user_id)->orderBy('id', 'DESC')->get();
        return $noti ;
      
  
 return response()->json(['success_msg'=> 'Successfully!']);
 
}

}
