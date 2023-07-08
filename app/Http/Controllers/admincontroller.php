<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\category;
use App\Models\product;
use App\Models\address;
use App\Models\order;
use App\Models\order_detail;
use App\Models\document;
use App\Models\notification;
class admincontroller extends Controller
{
    //


     
// Login
public function login(){

    return view('admin.login');
    }
    
//  Admin Login action

public  function adminloginaction(Request $req){
  
    $req->validate([
        'email' => 'required|email',
        'password'=> 'required',
      ]);
      if (Auth::attempt(['email' => $req->email, 'password' => $req->password,'user_role' => 1])) {
        if(auth::user()->user_role == 1 && auth::user()->status == 1){

        return redirect('admin/dashboard');

      }
        else{
          return back()->with(['error1'=> 'Password and Email does not match try again']);
        }
    }
      else{
        return back()->with(['error1'=> 'Password and Email does not match try again']);
      }
}
// Logout

    function  logout(){
      auth::logout();
return redirect('/admin/login');

  }


    // Forget
   public function forget_action(request $req)
 {
   
        $req->validate([
            'email' => 'required|email',

        ]);
    
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
            $message = '<h2 style="color:#040d50">Chutney Indian Food<h2> <hr> <h4> Dear ' . $user->name .'</h4><p> There was a request for password  resetting Chutney Indian Food generated password is <button style="color:#040d50">'. 
            implode($pass).' </button> </p>' ;
            $headers .= 'From: info@chutney.org'."\r\n".
            'Reply-To: info@chutney.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            if(mail($to, $subject, $message, $headers))
            {
                return back()->with('message1','djj');
            }
            else{
                return back()->with('message2','djj');
            }
        }
        else{
            return back()->with('message','djj');
        }
 } 


      
    // Dashboard
    public function dashboard(){
      $frenchies = user::where('user_role',2)->count();
      $order = order::where('status',3)->count();
      $product = product::count();

      return view('admin.dashboard',compact('frenchies','order','product'));
      }
  
  
  
          //profile
  public function profile()
  {
    $id = auth::id();
    $user = user::find($id);
  return view('admin.profile',compact('user'));
  }
  
  
  // Profile edit action
  public function profile_edit_action(request $req)
  {
  $req->validate([
  'email' => 'unique:users,email,' .$req->id.',id',
  ]);
  $id =Auth::id();
  $update  = user::find($id);
  // Image 
  if ($req->has('image')) {
  $req->validate([
  'image' => 'mimes:jpeg,jpg,bmp,png',
  ]);
  $image_path = 'storage/app/' . $update->image;
  //  dd($image_path);
  File::delete($image_path);
  $filename = $req->file('image')->store('media');
  }
  else {
  $filename = $update->image;
  }
  user::where('id',$id)->update([
    'name'=>$req->name,
    'email'=>$req->email,
    'contact'=>$req->contact,
    'image'=>$filename,
    'street'=>$req->street,
    'city'=>$req->city,
    'state'=>$req->state,
    'zip'=>$req->zip,
    'country'=>$req->country,
  ]);
  return redirect('admin/profile')->with('message1','Successfully Updated Profile');  
  }
  
  //update password
  public function update_password()
  {
    return view('admin.update_password');
  } 

  function update_password_action(request $req){
    
    $id =Auth::id();
    $user= user::find($id);
 
   if(password_verify($req->oldpassword,$user->password)){
 
        $user->password = bcrypt($req->newpassword);
 $user->save();
        return back()->with('message','Update');
    }
    else{
        return back()->with(['error'=> 'Old Password  does not match try again']);
      }

  }





  
   //category
    public function category()
    {
        $cat = category::get();

   return view('admin.category',compact('cat'));
   } 

   public function add_category(request $req)
   {

    category::create([
      'name' => $req->name,
  
       ]);
          return back()->with('message','Successfully');
  }


  public function edit_cat_name_action(request $req)
  {

   category::where('id',$req->id)->update([
     'name' => $req->name,
 
      ]);
         return back()->with('message','Successfully');
 }


 
 public function delete_cat_name($id)
 {
$cat = category::find($id);
  $cat->delete();
      return back()->with('delete','delete');
}

   //document
   public function document()
    {
      $user = user::where('user_role',2)->get();

              $doc = document::with(['user'])-> get();
          
    return view('admin.document',compact('doc','user'));
   } 

   public function view_document(request $req)
   {

    $filename = $req->file('file')->store('media');
    
    $document = document::create([
      'user_id'=>$req->user_id,
      'name' =>$req->name,
      'file' =>$filename,
      'status' =>1
      ]);
      
      
      return back()->with('delete','delete');
  } 


//   Delete document
   
   
   function delete_document(request $req){
   
  $document = document::find($req->id);
  $destinationPath = 'storage/app/'.$document->file;
  file::delete($destinationPath);
  $document->delete();
  return back()->with('delete','delete');
 }

   // add product
   public function add_product()

   {  
    
    $cat = category::get();
    return view('admin.add_product',compact('cat'));
   } 

// add product
public function add_product_action(request $req)

{  
  $filename = $req->file('image')->store('media');
    
  product::create([
    'name' => $req->name,
    'price' =>$req->price,
    'total_quantity' =>$req->quantity,
    'image' => $filename,
    'category_id' =>$req->category_id,
    'description' =>$req->description
     ]);


    return back()->with('message','Successfully');

} 

   //view product
   public function view_product()
    {
       $product = product::with(['product_cat'])->get();
           
    $cat = category::get();
    return view('admin.view_product',compact('product','cat'));
   } 
      
// add product
public function edit_product_action(request $req)

{  

  $update  = product::find($req->id);
  // Image 
  if ($req->has('image')) {
  $req->validate([
  'image' => 'mimes:jpeg,jpg,bmp,png',
  ]);
  $image_path = 'storage/app/' . $update->image;
  //  dd($image_path);
  File::delete($image_path);
  $filename = $req->file('image')->store('media');
  }
  else {
  $filename = $update->image;
  }

    
  product::where('id',$req->id)->update([
    'name' => $req->name,
    'price' =>$req->price,
   'total_quantity' =>$req->quantity,
    'image' => $filename,
    'category_id' =>$req->category_id,
    'description' =>$req->description
     ]);


    return back()->with('message','Successfully');

} 
   
 
public function delete_product($id)
{
$product = product::find($id);

  $image_path = 'storage/app/' . $product->image;

  File::delete($image_path);

 $product->delete();
     return back()->with('delete','delete');
}


   //view Frenchies
      public function frenchies()
    {
      $user = user::with(['address'])->where('user_role',2)->get();
    //  return $user;
            
      return view('admin.frenchies',compact('user'));
   } 

   
   //order_awaiting
   public function order_awaiting()
   {
        
    $order = order::with(['orders.product.product_cat','user','address'])->orderBy('id', 'DESC')->where('status',0)->get();
    // return $order;


   return view('admin.order_awaiting',compact('order'));
  } 
    //upload slip
    public function upload_slip(request $req)
    {
        
             
    $ord =  order ::with(['user'])->where('id',$req->id)->first();
    

   
         
      $filename = $req->file('slip')->store('media');
    
   
    
  order::where('id',$req->id)->update([
    'status'=>1,
    'slip'=> $filename ,
     ]);
        $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $ord->user->email;
            $from = 'info@chutney.org';
            $subject = 'Chutney Indian Food';
            $message = '<h4> Dear ' . $ord->user->name .'</h4> <p> Chutney Indian Food uploaded Slip against the order where order data is <b> '  . $ord->created_at .' </b> </p>' ;
            $headers .= 'From: info@chutney.org'."\r\n".
            'Reply-To: info@chutney.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            if(mail($to, $subject, $message, $headers))
            {
                 return redirect('admin/order_inprogress');
            }
     
    
   } 

   public function order_inprogress()
   {
        
    $order = order::with(['orders.product.product_cat','user','address'])->orderBy('id', 'DESC')->where('status',1)->get();
    // return $order;


   return view('admin.order_inprogress',compact('order'));
  } 

  public function order_pending()
  {
       
   $order = order::with(['orders.product.product_cat','user','address'])->orderBy('id', 'DESC')->where('status',2)->get();
   // return $order;


  return view('admin.order_pending',compact('order'));
 } 

 //view order_completed
 public function order_completed_check($id)
 {
          
           $ord =  order ::with(['user'])->where('id',$id)->first();
           
     
            
           order::where('id',$id)->update([
            'status'=>3,
            
             ]);
                  $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $ord->user->email;
            $from = 'info@chutney.org';
            $subject = 'Chutney Indian Food';
            $message = '<h4> Dear ' . $ord->user->name .'</h4> <p> Your order have been approved  where order data is <b> '  . $ord->created_at .' </b> </p>' ;
            $headers .= 'From: info@chutney.org'."\r\n".
            'Reply-To: info@chutney.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            if(mail($to, $subject, $message, $headers))
            {
                return redirect('admin/order_complete');
            }
            
             
} 
  
   //view order_completed
   public function order_completed()
   {

    $order = order::with(['orders.product.product_cat','user','address'])->orderBy('id', 'DESC')->where('status',3)->get();
    // return $order;
   return view('admin.order_completed',compact('order'));  

  } 
  //view Frenchies
     public function order_cancelled()
   {
    
    $order = order::with(['orders.product.product_cat','user','address'])->orderBy('id', 'DESC')->where('status',4)->get();
    // return $order;
   return view('admin.order_cancelled',compact('order')); 
  
  } 

  public function order_cancelled_check($id)
  {
    order::where('id',$id)->update([
      'status'=>4,
      
       ]);
       return redirect('admin/order_cancelled');

 } 

 public function add_notification()
 {   
  $user = user::where('user_role',2)->get();      


 return view('admin.add_notification',compact('user'));
} 

public function add_notification_action(request $req)
{   

$user =user::find($req->user_id);

     notification::create([
    'user_id' => $req->user_id,
    'subject' =>$req->subject,
    'message' => $req->message,
     ]); 
     
          $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $to = $user->email;
            $from = 'info@chutney.org';
            $subject = 'Chutney Indian Food';
            $message = $req->message;
            $headers .= 'From: info@chutney.org'."\r\n".
            'Reply-To: info@chutney.org'. "\r\n" .
            'X-Mailer: PHP/' . phpversion();
            
            if(mail($to, $subject, $message, $headers))
            {
                 return back()->with('message','Successfully');
            }  
    

} 

public function view_notification()
{   
      
$noti = notification::with(['user'])->orderBy('id', 'DESC')->get();

return view('admin.view_notification',compact('noti'));
} 

   //view sale_record
   public function sale_record()
   {
             
   return view('admin.sale_record');
  } 

}
