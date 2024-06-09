@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dokumen JSA</h1>
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
                <h3 class="card-title">Data Dokumen JSA</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Detail</th>
                      <th>Doc No</th>
                      <th>Judul</th>
                      <th>Nama Supervisi</th>
                      <th>Tempat Bekerja</th>
                      <th>Tgl Dibuat</th>
                      <th>Reviewed By</th>
                      <th>Tgl Review</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($jsa as $data)
                    <tr>
                      <td>
                        <button class="btniddetailjsa btn btn-secondary" data-toggle="modal" data-target="#modal-lg-detail-jsa">
                          <i class="fas fa-eye"></i>
                        </button>
                      </td>
                      <td>JHA {{ $data->formatted_id }}/{{ $data->project_code }}</td>
                      <td>{{ $data->judul_pekerjaan }}</td>
                      <td>{{ $data->supervisi_name }}</td>
                      <td>{{ $data->tempat_bekerja }}</td>
                      <td>{{ $data->created_at }}</td>
                      <td>{{ $data->reviewed_by }}</td>
                      @if($data->created_at == $data->updated_at)
                      <td>
                        <button class="btn btn-danger" disabled>Belum Di Review</button>
                      </td>
                      @else
                      <td>{{ $data->updated_at }}</td>
                      @endif
                      <td>
                        @if($data->reviewed_by == '')
                          @can('spv')
                            <button class="btn btn-danger">Belum Di Review</button>
                          @endcan
                          @cannot('spv')
                            <button class="btn btn-danger" disabled>Belum Di Review</button>
                          @endcan
                        @else
                        <button class="btn btn-outline-success" disabled>Sudah Di Review</button>
                        @endif
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
      <div class="modal fade" id="modal-lg-detail-jsa">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Form Permohonan Baru</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>something</p>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection