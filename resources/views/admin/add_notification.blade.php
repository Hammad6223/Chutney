<!DOCTYPE html>
<html lang="en">
   @include('admin.includes.head')
   <body>
      <div class="loader-wrapper">
         <div class="loader-index"><span></span></div>
         <svg>
            <defs></defs>
            <filter id="goo">
               <fegaussianblur in="SourceGraphic" stddeviation="11" result="blur"></fegaussianblur>
               <fecolormatrix in="blur" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo"> </fecolormatrix>
            </filter>
         </svg>
      </div>
      <div class="page-wrapper compact-wrapper" id="pageWrapper">
         @include('admin.includes.topbar')
         <!-- Page Body Start-->
         <div class="page-body-wrapper">
            @include('admin.includes.sidebar')
            <div class="page-body">
               <div class="container-fluid ">
                  <div class="page-title " style="padding-top:0px;">
                     <div class="row mt-4">
                        <div class="col-6">
                           <h3>Benachrichtigung hinzufügen</h3>
                        </div>
                        <div class="col-6">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a>                                      
                                 <i data-feather="home"></i></a>
                              </li>
                              <li class="breadcrumb-item">Benachrichtigung</li>
                              <li class="breadcrumb-item active"> Benachrichtigung hinzufügen</li>
                           </ol>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- Container-fluid starts-->
               <div class="container-fluid">
                  <div class="row">
                     <div class="col-sm-12">
                        <div class="card">
                           <div class="card-header">
                              <form  method="post" action="add_notification_action" enctype="multipart/form-data">
                                 @csrf
                                 <div class="row mt-2">
                                 
                                  
                                    <div class="col-md-6 ">
                                       <label class="float-start" for="recipient-name">Frienchies</label>
                                    
                                       <select class="js-example-basic-single col-sm-12" required name="user_id">
                                          <option value="">Wählen Sie Frenchies</option>
                                          <!--<<option value="1">All Frenchies</option>-->
                                          @foreach($user as $user)
                             <option value="{{$user->id}}"> {{$user->name}}</option>
                              @endforeach
                                       </select>
                                    </div>

                                    <div class="col-md-6">
                                       <div class="mb-3">
                                          <label class="float-start" for="recipient-name"> Thema</label>
                                          <input class="form-control" required  name="subject" type="text" >
                                       </div>
                                    </div>
                                    <div class="col-md-12">
                                       <div class="mb-3">
                                          <label class="float-start" for="recipient-name"> Nachricht</label>
                                          <textarea class="form-control" name="message" id="exampleFormControlTextarea1" rows="6" spellcheck="false"></textarea>
                           
                                       </div>
                                    </div>

                                        </div>
                           </div>
                           <div class="card-footer text-end">
                           <button class="btn btn-primary " name="submit" type="submit">Einreichen</button>
                           </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- Container-fluid Ends-->
         <!-- footer start-->
         @include('admin.includes.footer')
      </div>
      </div>
      <!-- latest jquery-->
      <script src="{{asset('public/assets/js/jquery-3.5.1.min.js')}}"></script>
      <!-- Bootstrap js-->
      <script src="{{asset('public/assets/js/bootstrap/bootstrap.bundle.min.js')}}"></script>
      <!-- feather icon js-->
      <script src="{{asset('public/assets/js/icons/feather-icon/feather.min.js')}}"></script>
      <script src="{{asset('public/assets/js/icons/feather-icon/feather-icon.js')}}"></script>
      <!-- scrollbar js-->
      <script src="{{asset('public/assets/js/scrollbar/simplebar.js')}}"></script>
      <script src="{{asset('public/assets/js/scrollbar/custom.js')}}"></script>
      <!-- Sidebar jquery-->
      <script src="{{asset('public/assets/js/config.js')}}"></script>
      <!-- Plugins JS start-->
      <script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>
      <script src="{{asset('public/assets/js/dropzone/dropzone.js')}}"></script>
      <script src="{{asset('public/assets/js/dropzone/dropzone-script.js')}}"></script>
      <script src="{{asset('public/assets/js/tooltip-init.js')}}"></script>
      <script src="{{asset('public/assets/js/notify/bootstrap-notify.min.js')}}"></script>
      <!-- Plugins JS Ends-->
      <!-- Theme js-->
      <script src="https://use.fontawesome.com/43c99054a6.js"></script>
      <script src="{{asset('public/assets/js/script.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2.full.min.js')}}"></script>
      <script src="{{asset('public/assets/js/select2/select2-custom.js')}}"></script>
            
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>
      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>
      <script type="text/javascript">
         function expire_toggle()
         {
            if($('#date_check').is(":checked"))   
               // console.log("edawd");   
                $("#date_div").hide();
         
            else
                  $("#date_div").show();
         }
      </script>

@if (session('message'))

<script>
   Swal.fire({
     position: 'top-end',
     icon: 'success',
     title: 'Successfully',
     showConfirmButton: false,
     timer: 2500
   })
</script>

                     @endif
   </body>
</html>