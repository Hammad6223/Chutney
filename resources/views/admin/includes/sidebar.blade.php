@include('admin.includes.head');
<!-- Page Sidebar Start-->
<div class="sidebar-wrapper">
   <div>
      <div class="logo-wrapper py-2" >
         <a href="{{url('admin/dashboard')}}"><img class="img-fluid for-light pb-2" src="{{asset('public/assets/images/logo/logo.png')}}" alt="" style="height:65px; ">
        </a>
         <!-- <div class="back-btn"><i class="fa fa-angle-left"></i></div>
         <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div> -->
      </div>
      <div class="logo-icon-wrapper"><a href="index.html"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo-icon.png')}}" alt=""></a></div>
      <nav class="sidebar-main">
         <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
         <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
               
               <li class="back-btn">
                  <a href="index.html"><img class="img-fluid" src="{{asset('public/assets/images/logo/logo-icon.png')}}" alt=""></a>
                  <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/dashboard' )}}"><i data-feather="home"></i><span class="">Armaturenbrett</span></a>
               </li>
               
              

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/profile' )}}"><i data-feather="user"></i><span class="">Profil</span></a>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/frenchies' )}}"><i data-feather="film"></i><span class="" > Franzosen</span></a>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i  data-feather="file-text"></i><span> Aufträge</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/order_awaiting')}}">Warten</a></li>
                     <li><a href="{{url('admin/order_inprogress')}}">Im Gange</a></li>
                     <li><a href="{{url('admin/order_pending')}}">Ausstehend</a></li>
                     <li><a href="{{url('admin/order_complete')}}">Completed</a></li>
                     <li><a href="{{url('admin/order_cancelled')}}">Abgesagt</a></li>
                  </ul>
               </li>




               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i  data-feather="database"></i><span> Produkte</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/add_product')}}">Neue hinzufügen</a></li>
                     <li><a href="{{url('admin/view_product')}}">Produkt anzeigen</a></li>
                  </ul>
               </li>
               <li class="sidebar-list">
                  <a class="sidebar-link sidebar-title" href="#"> <i  data-feather="message-square"></i><span> Benachrichtigungen</span></a>
                  <ul class="sidebar-submenu">
                     <li><a href="{{url('admin/add_notification')}}">Neue hinzufügen</a></li>
                     <li><a href="{{url('admin/view_notification')}}">Benachrichtigungen anzeigen</a></li>
                  </ul>
               </li>
             
<!-- 
               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{ url('/admin/sale_record' )}}"><i data-feather="dollar-sign"></i><span class="" > Sale Record</span></a>
               </li> -->

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{url('admin/category')}}"><i data-feather="layers"></i><span class="" > Kategorien</span></a>
               </li>

               <li class="sidebar-list">
                  <a class="sidebar-link " href="{{url('admin/document')}}"><i data-feather="book"></i><span class="" > Unterlagen </span></a>
               </li>


              
            
               <li class="sidebar-list" style="color: red;">
                  <a  class="sidebar-link " href="{{ url('/admin/logout' )}}"><i data-feather="power" style="color: red !important;" ></i><span style="color: red !important;">Ausloggen</span></a>
               </li>
            </ul>
         </div>
         <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
      </nav>
   </div>
</div>
<!-- Page Sidebar Ends-->