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

<script src="{{ asset('AdminLTE-3.2.0/plugins/chart.js/Chart.min.js') }}"></script>

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
   var data = $(this).data();
   console.log('Button clicked. ID:', Id);
   $("#modal-lg-edit #id_ptw").val(Id);
   $("#modal-sm-success #id_ptw").val(Id);
   $("#modal-sm-danger #id_ptw").val(Id);
   $("#modal-sm-open #id_ptw").val(Id);
   $("#modal-sm-hold #id_ptw").val(Id);
   $("#modal-sm-done #id_ptw").val(Id);
   $("#modal-sm-delete #id_ptw").val(Id);
   
   console.log(data);
   $("#modal-lg-edit #project_id").val(data.projectId);
   $("#modal-lg-edit #location_id").val(data.locationId);
   $("#modal-lg-edit #berlaku_dari").val(data.berlakuDari);
   $("#modal-lg-edit #berlaku_sampai").val(data.berlakuSampai);
   $("#modal-lg-edit #permission_select_edit").val(data.permissionId);
   $("#modal-lg-edit #manpower_qty").val(data.manpowerQty);
   $("#modal-lg-edit #remark").val(data.remark);
   $("#modal-lg-edit #catatan_hse").val(data.catatanHse);
});
</script>

<!-- JSA -->
<script type="text/javascript">
$(document).ready(function(){
  $('.btnid_jsa').click(function(){
    var data = $(this).data();
    console.log(data);
    $("#modal-lg-edit #id").val(data);
    $("#modal-sm-delete-jsa #id").val(data.datas.id);

    $("#modal-lg-detail-jsa #doc_no").val('JHA '+data.datas.formatted_id+'/'+data.datas.project_code);
    $("#modal-lg-detail-jsa #supervisi").val(data.datas.supervisi_name);
    $("#modal-lg-detail-jsa #project_name").val(data.datas.project_code);
    $("#modal-lg-detail-jsa #judul_pekerjaan").val(data.datas.judul_pekerjaan);
    $("#modal-lg-detail-jsa #location_name").val(data.datas.tempat_bekerja);
    $("#modal-lg-detail-jsa #plant_location").val(data.datas.plant_loc);
    $("#modal-lg-detail-jsa #uraian_tugas").val(data.datas.uraian_tugas);

    $("#modal-lg-edit-jsa #id").val(data.datas.id);
    $("#modal-lg-edit-jsa #supervisi").val(data.datas.supervisi_name);
    $("#modal-lg-edit-jsa #project_name").val(data.datas.project_code);
    $("#modal-lg-edit-jsa #judul_pekerjaan").val(data.datas.judul_pekerjaan);
    $("#modal-lg-edit-jsa #location_name").val(data.datas.tempat_bekerja);
    $("#modal-lg-edit-jsa #plant_location").val(data.datas.plant_loc);
    $("#modal-lg-edit-jsa #uraian_tugas").val(data.datas.uraian_tugas);

    // Fetch data for Penyusun JSA
fetch(`http://127.0.0.1:8000/user-penyusun-jsa/${data.datas.id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        const penyusunDiv = document.getElementById('detail-penyusun-jsa-container');
        penyusunDiv.innerHTML = ''; // Clear previous content

        data.forEach((datas, index) => {
            const penyusun = document.createElement('p');
            penyusun.textContent = `${index + 1}. ${datas.nama}`; 
            penyusunDiv.appendChild(penyusun);
        });
    })
    .catch(error => console.error('Error fetching data:', error));

// Fetch data for Pelaksana JSA
fetch(`http://127.0.0.1:8000/user-pelaksana-jsa/${data.datas.id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        const pelaksanaDiv = document.getElementById('detail-pelaksana-jsa-container');
        pelaksanaDiv.innerHTML = ''; // Clear previous content

        data.forEach((datas, index) => {
            const pelaksana = document.createElement('p');
            pelaksana.textContent = `${index + 1}. ${datas.nama}`; 
            pelaksanaDiv.appendChild(pelaksana);
        });
    })
    .catch(error => console.error('Error fetching data:', error));

// Fetch data for Penyusun JSA
fetch(`http://127.0.0.1:8000/user-penyusun-jsa/${data.datas.id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        const penyusunDiv = document.getElementById('edit-penyusun-jsa-container');
        penyusunDiv.innerHTML = ''; // Clear previous content

        data.forEach((datas) => {
            addPenyusunForEdit(datas.nama); // Add row with fetched data
        });
    })
    .catch(error => console.error('Error fetching data:', error));

// Fetch data for Pelaksana JSA
fetch(`http://127.0.0.1:8000/user-pelaksana-jsa/${data.datas.id}`)
    .then(response => response.json())
    .then(data => {
        console.log(data);
        const pelaksanaDiv = document.getElementById('edit-pelaksana-jsa-container');
        pelaksanaDiv.innerHTML = ''; // Clear previous content

        data.forEach((datas) => {
            addPelaksanaForEdit(datas.nama); // Add row with fetched data
        });
    })
    .catch(error => console.error('Error fetching data:', error));

  });
});
</script>
<script type="text/javascript">
$(document).on('click', '.btnid_jsa_review', function() {
    var data = $(this).data();
    console.log(data.datas);
    $("#modal-sm-review #id").val(data);

    document.getElementById("review_jsa_title").innerHTML = 'Apakah Anda Telah Review Detail JSA "JHA '+data.datas.formatted_id+'/'+data.datas.project_code+'" ?';
    // $("#modal-sm-review #review_jsa_title").val(data.datas.id);
  });
</script>
<!-- JSA -->

<script type="text/javascript">
$(document).ready(function() {
  $(document).on('click', '.btnid_master_edit', function() {
    var dataEdit = $(this).data();
    console.log(dataEdit);

    $("#modal-lg-project-edit #id").val(dataEdit.datas.id);
    $("#modal-lg-project-edit #project_code").val(dataEdit.datas.project_code);
    $("#modal-lg-project-edit #project_name").val(dataEdit.datas.project_name);

    $("#modal-lg-location-edit #id").val(dataEdit.datas.id);
    $("#modal-lg-location-edit #location_name").val(dataEdit.datas.location_name);

    $("#modal-lg-user-edit #id").val(dataEdit.datas.id);
    $("#modal-lg-user-edit #name").val(dataEdit.datas.name);
    $("#modal-lg-user-edit #email").val(dataEdit.datas.email);
    $("#modal-lg-user-edit #roleBefore").val(dataEdit.datas.roles[0].name);
    $("#modal-lg-user-edit #role").val(dataEdit.datas.roles[0].name);

  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(document).on('click', '.btnid_master_delete', function() {
    var dataDetail = $(this).data();

    $("#modal-sm-project-delete #id").val(dataDetail.id);
    $("#modal-sm-location-delete #id").val(dataDetail.id);
    $("#modal-sm-user-delete #id").val(dataDetail.id);

  });
});
</script>
<script type="text/javascript">
$(document).ready(function() {
  $(document).on('click', '.btniddetail', function() {
    var dataDetail = $(this).data();
    console.log(dataDetail);

    $("#modal-lg-detail #ptw_id").val(dataDetail.ptwId);
    $("#modal-lg-detail #no_register").val(dataDetail.ptwId+'/'+'PTW'+'/'+dataDetail.projectCode+'/'+dataDetail.month+'/'+dataDetail.year);
    $("#modal-lg-detail #created_at").val(dataDetail.createdAt);
    $("#modal-lg-detail #created_by").val(dataDetail.createdBy);
    $("#modal-lg-detail #berlaku_dari").val(dataDetail.berlakuDari);
    $("#modal-lg-detail #berlaku_sampai").val(dataDetail.berlakuSampai);
    $("#modal-lg-detail #work_location").val(dataDetail.locationName);
    $("#modal-lg-detail #manpower_qty").val(dataDetail.manpowerQty);
    $("#modal-lg-detail #permission_type").val(dataDetail.permissionType);
    $("#modal-lg-detail #nama_proyek").val(dataDetail.projectName);
    $("#modal-lg-detail #code_proyek").val(dataDetail.projectCode);
    $("#modal-lg-detail #remark").val(dataDetail.remark);

  fetch(`http://127.0.0.1:8000/detail-tambahan/${dataDetail.ptwId}`)
    .then(response => response.json())
    .then(data => {
        const instruksiDiv = document.getElementById('instruksi_tambahan_div');
        instruksiDiv.innerHTML = '';
        if (data.length > 0) {
            const labelPermissions = document.createElement('label');
            labelPermissions.textContent = "Instruksi Tambahan";
            instruksiDiv.appendChild(labelPermissions);
        }
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
        if (data.length > 0) {
            const labelTools = document.createElement('label');
            labelTools.textContent = "Tools";
            apdDiv.appendChild(labelTools);
        }
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
    $('#permission_select_edit').on('change', function() {
        const selectedValue = this.value;
        console.log(selectedValue);

        fetch(`http://127.0.0.1:8000/input-apd/${selectedValue}`)
            .then(response => response.json())
            .then(data => {
              console.log(data);
                const instruksiDiv = document.getElementById('editApd');
                instruksiDiv.innerHTML = ''; // Clear previous content

                data.forEach((item, index) => {
                    const formCheckDiv = document.createElement('div');
                    formCheckDiv.className = 'form-check';

                    const checkbox = document.createElement('input');
                    checkbox.className = 'form-check-input';
                    checkbox.type = 'checkbox';
                    checkbox.value = item.id;
                    checkbox.name = 'tools[]';

                    const hot  = [0,1,3,4,6,9];
                    const conf = [0,3,4,6,8,9];
                    const exca = [0,3,4,6,9];
                    const cold = [0,3,4,6,9];
                    const isol = [0,3,4,6,9];
                    const ketinggian = [0, 1, 3, 4, 5, 6];
                    const radiografi = [0, 1, 3, 4, 6];
                    if (selectedValue == 1 && hot.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 2 && conf.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 3 && exca.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 4 && cold.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 5 && isol.includes(index)) {
                        checkbox.checked = true;
                    }
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
<script type="text/javascript">
  $(document).ready(function() {
    $('#permission_select_edit').on('change', function() {
        const selectedValue = this.value;
        console.log(selectedValue);

        fetch(`http://127.0.0.1:8000/input-detail-tambahan/${selectedValue}`)
            .then(response => response.json())
            .then(data => {
              console.log(data);
                const instruksiDiv = document.getElementById('edit_instruksi_tambahan');
                instruksiDiv.innerHTML = ''; // Clear previous content

                data.forEach((item, index) => {
                    const formCheckDiv = document.createElement('div');
                    formCheckDiv.className = 'form-check';

                    const checkbox = document.createElement('input');
                    checkbox.className = 'form-check-input';
                    checkbox.type = 'checkbox';
                    checkbox.value = item.id;
                    checkbox.name = 'permission_tambahan[]';
                    checkbox.style.display = 'none';
                    checkbox.checked = true;

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
                    checkbox.style.display = 'none';
                    checkbox.checked = true;

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
                const instruksiDiv = document.getElementById('inputApd');
                instruksiDiv.innerHTML = ''; // Clear previous content

                data.forEach((item, index) => {
                    const formCheckDiv = document.createElement('div');
                    formCheckDiv.className = 'form-check';

                    const checkbox = document.createElement('input');
                    checkbox.className = 'form-check-input';
                    checkbox.type = 'checkbox';
                    checkbox.value = item.id;
                    checkbox.name = 'tools[]';

                    const hot  = [0,1,3,4,6,9];
                    const conf = [0,3,4,6,8,9];
                    const exca = [0,3,4,6,9];
                    const cold = [0,3,4,6,9];
                    const isol = [0,3,4,6,9];
                    const ketinggian = [0, 1, 3, 4, 5, 6];
                    const radiografi = [0, 1, 3, 4, 6];
                    if (selectedValue == 1 && hot.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 2 && conf.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 3 && exca.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 4 && cold.includes(index)) {
                        checkbox.checked = true;
                    }
                    if (selectedValue == 5 && isol.includes(index)) {
                        checkbox.checked = true;
                    }
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
<script type="text/javascript">
  // Add Penyusun JSA row
function addPenyusun() {
  var newColumn = document.createElement('div');
  newColumn.setAttribute("class", "form-group");
  newColumn.innerHTML = `
    <input type="text" name="penyusun_jsa[]" class="form-control" required>
    <br>
    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus Penyusun</button>
  `;
  document.getElementById('penyusun-jsa-container').appendChild(newColumn);
}

// Add Pelaksana JSA row
function addPelaksana() {
  var newColumn = document.createElement('div');
  newColumn.setAttribute("class", "form-group");
  newColumn.innerHTML = `
    <input type="text" name="pelaksana_jsa[]" class="form-control" required>
    <br>
    <button type="button" class="btn btn-danger btn-sm" onclick="removeRow(this)">Hapus Pelaksana</button>
  `;
  document.getElementById('pelaksana-jsa-container').appendChild(newColumn);
}

// Remove Row
function removeRow(button) {
  button.parentNode.remove();
}

</script>
<script type="text/javascript">
// Add Penyusun JSA row
  function addPenyusunForEdit(name = '') {
    var newColumn = document.createElement('div');
    newColumn.setAttribute("class", "form-group");
    newColumn.innerHTML = `
      <input type="text" name="penyusun_jsa[]" class="form-control" value="${name}" required>
      <br>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeRowForEdit(this)">Hapus Penyusun</button>
    `;
    document.getElementById('edit-penyusun-jsa-container').appendChild(newColumn);
  }

  // Add Pelaksana JSA row
  function addPelaksanaForEdit(name = '') {
    var newColumn = document.createElement('div');
    newColumn.setAttribute("class", "form-group");
    newColumn.innerHTML = `
      <input type="text" name="pelaksana_jsa[]" class="form-control" value="${name}" required>
      <br>
      <button type="button" class="btn btn-danger btn-sm" onclick="removeRowForEdit(this)">Hapus Pelaksana</button>
    `;
    document.getElementById('edit-pelaksana-jsa-container').appendChild(newColumn);
  }

// Remove Row
function removeRowForEdit(button) {
  button.parentNode.remove();
}

</script>
@yield('chart')
</body>
</html>
