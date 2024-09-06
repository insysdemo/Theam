 <!-- Google Font: Source Sans Pro -->
 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
 <!-- Font Awesome -->
 <link rel="stylesheet" href="{{ asset('assets/fontawesome-free/css/all.min.css') }}">
 <!-- Ionicons -->
 <link rel="stylesheet" href="{{ asset('assets/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

 <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
 <!-- Custome style -->
 <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
 {{-- Bootstrap5 css  --}}
 <link rel="stylesheet" href="{{ asset('dist/css/bootstrap5.min.css') }}">

 <link rel="stylesheet" href="{{ asset('dist/css/bootstrap-datepicker.css') }}">
 <link rel="stylesheet" href="{{ asset('assets/select2/select2.min.css') }}">

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


 <style>
     #commonModalContent::-webkit-scrollbar {
         width: 8px;
     }

     #commonModalContent::-webkit-scrollbar-track {
         -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.3);
         border-radius: 10px;
         margin-bottom: 10px;
     }

     #commonModalContent::-webkit-scrollbar-thumb {
         border-radius: 10px;
         -webkit-box-shadow: inset 0 0 6px rgba(0, 0, 0, 0.5);
     }
 </style>

 <div class="modal fade" id="modal">
     <div class="modal-dialog modal-lg modal-dialog-centered " role="document">
         <div class="modal-content">
             <div class="modal-header text-center">
                 <h4 class="modal-title" id="commonModalHeader" style="font-weight: bold;"></h4>
                 <button type="button" class="close   border-dark" data-dismiss="modal" onclick="hideDiv(this)"><span
                         style="font-size: 26px;">&times;</span>
                 </button>
             </div>
             <div id="commonModalContent"
                 style="margin-top: 10px; max-height:70vh; overflow-y: auto; overflow-x: hidden; "></div>
         </div>
     </div>
 </div>
