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
                        <h3>neue Kategorie hinzufügen</h3>
                     </div>
                     <div class="col-6">
                        <ol class="breadcrumb">
                           <li class="breadcrumb-item"><a>                                      
                              <i data-feather="home"></i></a>
                           </li>
                           <li class="breadcrumb-item">Kategorie</li>
                           <li class="breadcrumb-item active"> neue Kategorie hinzufügen</li>
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
                           <form class="theme-form" method="post" action="add_category">
                              @csrf
                              <div class="row mb-2">
                                 <div class="col-md-8 ">
                                    <input class="form-control"  required id="branch_code" name="name" type="text" placeholder="Geben Sie den Kategorienamen ein">
                                 </div>
                                 <div class="col-md-4 mt-2">
                                    <button class="btn btn-primary " name="submit" type="submit">Einreichen</button>
                                 </div>
                              </div>
                        </div>
                        </form>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-sm-12 col-xl-12 xl-100">
                     <div class="card">
                        <div class="card-body">
                           <ul class="nav nav-tabs border-tab nav-primary" id="info-tab" role="tablist">
                              <li class="nav-item"><a class="nav-link active" id="info-home-tab" data-bs-toggle="tab" href="#info-home" role="tab" aria-controls="info-home" aria-selected="true"> Kategorien</a></li>
                           </ul>
                           <div class="tab-content" id="info-tabContent">
                              <div class="tab-pane fade show active" id="info-home" role="tabpanel" aria-labelledby="info-home-tab">
                                 <div class="dt-ext table-responsive">
                                    <table class="display" id="responsive">
                                       <thead>
                                          <tr>
                                              <th>#</th>
                                             <th>Kategoriename</th>
                                             <th>Aktion</th>
                                          </tr>
                                       </thead>
                                       <tbody>
                                       @php
                            $count=1;
                            @endphp
                                       @foreach($cat as $cat)
                                          <tr>
                                          <td>{{$count++}}</td>
                                             <td>{{$cat->name}}</td>
                                             <td>
                                                <!-- <a  class="btn-xs"  data-bs-toggle="modal" data-bs-target=".bd-example-modal-sm"  ><i class="fa fa-list fa-lg" style="color: green"></i></a> -->
                                                <a  class="btn-xs"  data-bs-toggle="modal" data-bs-target="#helo{{$cat->id}}"  ><i class="fa fa-edit fa-lg" style="color: blue"></i></a>
                                                <a  class="btn-xs" href="{{url('admin/delete_cat_name/' .$cat->id )}}" onClick="return confirm('Are you sure?')"><i class="fa fa-times-circle fa-lg" style="color: red" ></i></a>
                                             </td>
                                             <!-- Modal Edit -->
                                             <div class="modal fade " id="helo{{$cat->id}}" id="helo" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-sm">
                                                   <div class="modal-content">
                                                      <div class="modal-header">
                                                         <h5 class="modal-title">  Kategorie bearbeiten</h5>
                                                         <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                                      </div>
                                                      <div class="modal-body">
                                                         <form action="{{url('admin/edit_cat_name_action')}}" method="post">
                                                         @csrf

                                                         <input class="form-control"  value="{{$cat->id}}"  name="id" type="hidden">
                                                            <div class="col-md-12">
                                                               <div class="mb-3">
                                                                  <label class="float-start" for="recipient-name">Kategoriename</label>
                                                                  <input class="form-control"  required type="text"  name="name" value={{$cat->name}}>
                                                               </div>
                                                            </div>
                                                         
                                                            <div class="modal-footer">
                                                               <!-- <button class="btn btn-secondary " type="button" data-bs-dismiss="modal">Schließen</button> -->
                                                               <button class="btn btn-primary" type="submit">Aktualisieren</button>
                                                            </div>
                                                         </form>
                                                      </div>
                                                   </div>
                                                </div>
                                                <!-- Modal End -->
                                          </tr>

                                          @endforeach
                                       </tbody>
                                    </table>
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
      
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.all.min.js"></script>

      <script>
         $('#hi').delay(2000).slideUp(1200);
      </script>

@if (session('message'))

<script>
   Swal.fire({
     position: 'top-end',
     icon: 'success',
     title: 'Erfolgreich',
     showConfirmButton: false,
     timer: 2500
   })
</script>

                     @endif

                     @if (session('delete'))
 <script>
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Erfolgreich',
        showConfirmButton: false,
        timer: 2500
      })
    </script> @endif
   </body>
</html>