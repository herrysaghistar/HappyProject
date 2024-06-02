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
    <strong>Copyright &copy; 2014-2021 <a href="#">Sistem Permit To Work</a>.</strong>
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
  $(document).on('click', '.btniddetail', function() {
    var dataDetail = $(this).data();

    $("#modal-lg-detail #ptw_id").val(dataDetail.ptwId);
    $("#modal-lg-detail #no_register").val(dataDetail.ptwId+'/'+'PTW'+'/'+dataDetail.projectId+'/'+dataDetail.month+'/'+dataDetail.year);
    $("#modal-lg-detail #created_at").val(dataDetail.createdAt);
    $("#modal-lg-detail #created_by").val(dataDetail.createdBy);
    $("#modal-lg-detail #berlaku_dari").val(dataDetail.berlakuDari);
    $("#modal-lg-detail #berlaku_sampai").val(dataDetail.berlakuSampai);
    $("#modal-lg-detail #work_location").val(dataDetail.locationName);
    $("#modal-lg-detail #manpower_qty").val(dataDetail.manpowerQty);
    $("#modal-lg-detail #permission_type").val(dataDetail.permissionType);
    $("#modal-lg-detail #nama_proyek").val(dataDetail.projectName);

  fetch(`http://127.0.0.1:8000/detail-tambahan/${dataDetail.ptwId}`)
    .then(response => response.json())
    .then(data => {
        const instruksiDiv = document.getElementById('instruksi_tambahan_div');
        instruksiDiv.innerHTML = '';

        data.forEach((datas, index) => {
            const instruksi_tambahan_data = document.createElement('p');
            instruksi_tambahan_data.textContent = `${index + 1}. ${datas.permission_name}`; 
            instruksiDiv.appendChild(instruksi_tambahan_data);
        });
    })
    .catch(error => console.error('Error fetching data:', error));

  fetch(`http://127.0.0.1:8000/apd/${dataDetail.ptwId}`)
    .then(response => response.json())
    .then(data => {
        const apdDiv = document.getElementById('tools_div');
        apdDiv.innerHTML = '';

        data.forEach((datas, index) => {
            const apd_data = document.createElement('p');
            apd_data.textContent = `${index + 1}. ${datas.tools_name}`; 
            apdDiv.appendChild(apd_data);
        });
    })
    .catch(error => console.error('Error fetching data:', error));
    

  });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#permission_select').on('change', function() {
        const selectedValue = this.value;
        
        fetch(`http://127.0.0.1:8000/input-detail-tambahan/${selectedValue}`)
            .then(response => response.json())
            .then(data => {
              console.log(data);
                const instruksiDiv = document.getElementById('instruksi_tambahan');
                instruksiDiv.innerHTML = ''; // Clear previous content

                data.forEach((item, index) => {
                    const formCheckDiv = document.createElement('div');
                    formCheckDiv.className = 'form-check';

                    const checkbox = document.createElement('input');
                    checkbox.className = 'form-check-input';
                    checkbox.type = 'checkbox';
                    checkbox.value = item.id;
                    checkbox.name = 'permission_tambahan[]';

                    const label = document.createElement('label');
                    label.className = 'form-check-label';
                    label.textContent = `${index + 1}. ${item.permission_name}`;

                    formCheckDiv.appendChild(checkbox);
                    formCheckDiv.appendChild(label);

                    instruksiDiv.appendChild(formCheckDiv);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
});
</script>
<script type="text/javascript">
  $(document).ready(function() {
    $('#permission_select').on('change', function() {
        const selectedValue = this.value;
        
        fetch(`http://127.0.0.1:8000/input-apd/${selectedValue}`)
            .then(response => response.json())
            .then(data => {
              console.log(data);
                const instruksiDiv = document.getElementById('inpuApd');
                instruksiDiv.innerHTML = ''; // Clear previous content

                data.forEach((item, index) => {
                    const formCheckDiv = document.createElement('div');
                    formCheckDiv.className = 'form-check';

                    const checkbox = document.createElement('input');
                    checkbox.className = 'form-check-input';
                    checkbox.type = 'checkbox';
                    checkbox.value = item.id;
                    checkbox.name = 'tools[]';

                    const ketinggian = [0, 1, 3, 4, 5, 6]; // 0-based index adjustment
                    const radiografi = [0, 1, 3, 4, 6]; // 0-based index adjustment
                    if (selectedValue == 6 && ketinggian.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 7 && radiografi.includes(index)) {
                        checkbox.checked = true;
                    }

                    const label = document.createElement('label');
                    label.className = 'form-check-label';
                    label.textContent = `${index + 1}. ${item.tools_name}`;

                    formCheckDiv.appendChild(checkbox);
                    formCheckDiv.appendChild(label);

                    instruksiDiv.appendChild(formCheckDiv);
                });
            })
            .catch(error => console.error('Error fetching data:', error));
    });
});
</script>
</body>
</html>
