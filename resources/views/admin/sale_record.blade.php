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
                           <h3> Sales Record</h3>
                        </div>
                        <div class="col-6">
                           <ol class="breadcrumb">
                              <li class="breadcrumb-item"><a>                                      
                                 <i data-feather="home"></i></a>
                              </li>
                              <li class="breadcrumb-item">Sales</li>
                              <li class="breadcrumb-item active"> View Sales</li>
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
                              <form class="theme-form" method="post" action="adminaddpost">
                               
                                 <div class="box row mb-2 mt-4"  >
                                    <div class="col-md-4 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">Select Frenchies</label>
                                       <select class="js-example-basic-single col-sm-12" required name="postcategoryid">
                                          <option value="">View Business Sale</option>
                                       </select>
                                    </div>
                                    <div class="col-md-3 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">From Date</label>
                                       <input class="form-control"   name="branch_code" type="date" placeholder="Sale Date">
                                    </div>
                                    <div class="col-md-3 ">
                                       <label class="d-block" for="chk-ani" style="color: #040d50;">To Date</label>
                                       <input class="form-control"   name="branch_code" type="date" placeholder="Sale Date">
                                    </div>
                                 </div>
                             
                                 <div class="row mb-2 mt-2">
                                    <div class="col-md-9">
                                    </div>
                                    <div class="col-md-2 mt-4">
                                       <button class="btn btn-primary" name="submit" type="submit">Submit</button>
                                    </div>
                                 </div>
                           </div>
                           </form>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-sm-12 col-xl-12 xl-100">
                        <div class="col-xl-12 col-lg-12">
                           <div class="small-chart-widget chart-widgets-small">
                              <div class="card">
                                 <div class="card-header">
                                    <h5 style="color: #040D50;">Total Sale:<span style="color:#F49F1C;"> $100,00.00</h5>
                                    <div class="card-header-right">
                                       <ul class="list-unstyled card-option">
                                          <li><i class="fa fa-spin fa-cog"></i></li>
                                          <li><i class="fa fa-expand full-card"></i></li>
                                          <li><i class="fa fa-minus minimize-card"></i></li>
                                          <li><i class="fa fa-refresh reload-card"></i></li>
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="card-body">
                                    <div class="chart-container">
                                       <div class="row">
                                          <div class="col-12">
                                             <div id="chart-widget7"></div>
                                          </div>
                                       </div>
                                    </div>
                                   
                                 </div>
                              </div>
                           </div>
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
      <!-- <script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script> -->
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
      <script src="{{asset('public/assets/js/sidebar-menu.js')}}"></script>

     <script src="{{asset('public/assets/js/chart/apex-chart/moment.min.js')}}"></script>
     <script src="{{asset('public/assets/js/chart/apex-chart/apex-chart.js')}}"></script>
     <script src="{{asset('public/assets/js/chart/apex-chart/stock-prices.js')}}"></script>

     
     <script src="{{asset('public/assets/js/prism/prism.min.js')}}"></script>
     <script src="{{asset('public/assets/js/clipboard/clipboard.min.js')}}"></script>
     <script src="{{asset('public/assets/js/counter/jquery.waypoints.min.js')}}"></script>
     <script src="{{asset('public/assets/js/counter/jquery.counterup.min.js')}}"></script>
     <script src="{{asset('public/assets/js/counter/counter-custom.js')}}"></script>
     <script src="{{asset('public/assets/js/custom-card/custom-card.js')}}"></script>
     <script src="{{asset('public/assets/js/chart-widget.js')}}"></script>
     <script src="{{asset('public/assets/js/tooltip-init.js')}}"></script>



     <!-- Theme js-->
    
      <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    
      <script src="{{asset('public/assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/pdfmake.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.autoFill.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.select.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/buttons.print.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.keyTable.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.colReorder.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.fixedHeader.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.rowReorder.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/dataTables.scroller.min.js')}}"></script>
      <script src="{{asset('public/assets/js/datatable/datatable-extension/custom.js')}}"></script>
      <!-- login js-->

      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>
      <script>
         $(document).ready(function(){
             $('input[type="radio"]').click(function(){
                 var inputValue = $(this).attr("value");
                 var targetBox = $("#" + inputValue);
                 $(".box").not(targetBox).hide();
                 $(targetBox).show();
             });
         });
      </script>
   </body>
</html>
x