@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advanced Form</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Data Permohonan Izin</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-2">
                  <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-lg">Permohonan Baru</button>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No. Register</th>
                      <th>Nama Proyek</th>
                      <th>Tanggal Dikeluarkan</th>
                      <th>Periode Berlaku</th>
                      <th>Lokasi Kerja</th>
                      <th>Uraian Kerja</th>
                      <th>Jenis Izin</th>
                      <th>Alat Pelindung</th>
                      <th>Jumlah Tenaga Kerja</th>
                      <th>Instruksi Tambahan</th>
                      <th>Approval</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>Other browsers</td>
                      <td>All others</td>
                      <td>-</td>
                      <td>-</td>
                      <td>
                        <a href="{{ url('/acc/'.$datas->id) }}"><button type="submit" class="btn btn-success">Acc Permohonan</button></a>
                      </td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- modal -->
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Permohonan Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Submit</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection