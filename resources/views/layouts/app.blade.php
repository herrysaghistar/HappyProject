<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.css') }}">
  <!-- datatables -->
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">{{ Auth::user()->name }}</span>
          <div class="dropdown-divider"></div>
          <a href="{{ url('/logouts') }}" class="dropdown-item dropdown-footer">logout</a>
        </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
@include('layouts.sidebar')
@yield('content')
  <footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 3.2.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('AdminLTE-3.2.0/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.js') }}"></script>

<script src="{{ asset('AdminLTE-3.2.0/dist/js/pages/dashboard.js') }}"></script>

<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('AdminLTE-3.2.0/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('AdminLTE-3.2.0/dist/js/adminlte.min.js') }}"></script>

<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript">
$('.btnid').click(function(){
   var Id = $(this).data('id');
   console.log('Button clicked. ID:', Id);
   $("#modal-sm-success #id_ptw").val(Id);
   $("#modal-sm-danger #id_ptw").val(Id);
   $("#modal-sm-progress #id_ptw").val(Id);
   $("#modal-sm-done #id_ptw").val(Id);
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $('.btniddetail').click(function() {
    document.getElementById("instruksi_tambahan1").innerHTML = '';
    document.getElementById("instruksi_tambahan2").innerHTML = '';
    document.getElementById("instruksi_tambahan3").innerHTML = '';
    document.getElementById("instruksi_tambahan4").innerHTML = '';
    document.getElementById("tools1").innerHTML = '';
    document.getElementById("tools2").innerHTML = '';
    document.getElementById("tools3").innerHTML = '';
    document.getElementById("tools4").innerHTML = '';
    document.getElementById("tools5").innerHTML = '';
    document.getElementById("tools6").innerHTML = '';
    document.getElementById("tools7").innerHTML = '';
    document.getElementById("tools8").innerHTML = '';
    document.getElementById("tools9").innerHTML = '';
    document.getElementById("tools10").innerHTML = '';
    document.getElementById("tools11").innerHTML = '';
    document.getElementById("tools12").innerHTML = '';
    var dataDetail = $(this).data();
    var permissionString = dataDetail.permissionTambahan;
    var permissionsArray = permissionString.split(',');
    var toolsString = dataDetail.tools;
    var toolsArray = toolsString.split(',');

    $("#modal-lg-detail #ptw_id").val(dataDetail.ptwId);
    $("#modal-lg-detail #no_register").val(dataDetail.ptwId+'/'+'PTW'+'/'+dataDetail.month+'/'+dataDetail.year);
    $("#modal-lg-detail #created_at").val(dataDetail.createdAt);
    $("#modal-lg-detail #created_by").val(dataDetail.createdBy);
    $("#modal-lg-detail #berlaku_dari").val(dataDetail.berlakuDari);
    $("#modal-lg-detail #berlaku_sampai").val(dataDetail.berlakuSampai);
    $("#modal-lg-detail #work_location").val(dataDetail.locationName);
    $("#modal-lg-detail #manpower_qty").val(dataDetail.manpowerQty);
    $("#modal-lg-detail #permission_type").val(dataDetail.permissionType);
    $("#modal-lg-detail #nama_proyek").val(dataDetail.projectName);
    if (permissionsArray[0]) {
      document.getElementById("instruksi_tambahan1").innerHTML = '1. '+permissionsArray[0];  
    }
    if (permissionsArray[1]) {
      document.getElementById("instruksi_tambahan2").innerHTML = '2. '+permissionsArray[0];  
    }
    if (permissionsArray[2]) {
      document.getElementById("instruksi_tambahan3").innerHTML = '3. '+permissionsArray[0];  
    }
    if (permissionsArray[3]) {
      document.getElementById("instruksi_tambahan4").innerHTML = '4. '+permissionsArray[0];  
    }
    if (toolsArray[0]) {
      document.getElementById("tools1").innerHTML = '1. '+toolsArray[0];  
    }
    if (toolsArray[1]) {
      document.getElementById("tools2").innerHTML = '2. '+toolsArray[1];  
    }
    if (toolsArray[2]) {
      document.getElementById("tools3").innerHTML = '3. '+toolsArray[2];  
    }
    if (toolsArray[3]) {
      document.getElementById("tools4").innerHTML = '4. '+toolsArray[3];  
    }
    if (toolsArray[4]) {
      document.getElementById("tools5").innerHTML = '5. '+toolsArray[4];  
    }
    if (toolsArray[5]) {
      document.getElementById("tools6").innerHTML = '6. '+toolsArray[5];  
    }
    if (toolsArray[6]) {
      document.getElementById("tools7").innerHTML = '7. '+toolsArray[6];  
    }
    if (toolsArray[7]) {
      document.getElementById("tools8").innerHTML = '8. '+toolsArray[7];  
    }
    if (toolsArray[8]) {
      document.getElementById("tools9").innerHTML = '9. '+toolsArray[8];  
    }
    if (toolsArray[9]) {
      document.getElementById("tools10").innerHTML = '10. '+toolsArray[9];  
    }
    if (toolsArray[10]) {
      document.getElementById("tools11").innerHTML = '11. '+toolsArray[10];  
    }
    if (toolsArray[11]) {
      document.getElementById("tools12").innerHTML = '12. '+toolsArray[11];  
    }
  });
});
</script>

</body>
</html>
