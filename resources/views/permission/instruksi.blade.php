@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Formulir Perizinan</h1>
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
                @can('spv')
                <div class="col-2">
                  <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-lg">Permohonan Baru</button>
                </div>
                @endcan
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Inspeksi</th>
                      <th>No. Register</th>
                      <th>Tanggal Dikeluarkan</th>
                      <th>Periode</th>
                      <th>Lokasi Kerja</th>
                      <th>Uraian Kegiatan</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>
                        <div class="row">
                          <div class="col-12">
                            <button class="btniddetailinstruksi btn btn-secondary" id="btniddetailinstruksi" 
                                data-ptw-id="{{ $datas->ptw_id }}" 
                                data-project="{{ $datas->project_name }}" 
                                data-project-id="{{ $datas->project_id }}" 
                                data-month="{{ \App\Helpers\DateHelper::monthToRoman(optional($datas->created_at)->month) }}"
                                data-year="{{ $datas->created_at->format('Y') }}" 
                                data-created-at="{{ $datas->created_at }}" 
                                data-created-by="{{ $datas->created_by }}" 
                                data-berlaku-dari="{{ $datas->berlaku_dari }}" 
                                data-berlaku-sampai="{{ $datas->berlaku_sampai }}" 
                                data-location-name="{{ $datas->location_name }}" 
                                data-permission-type="{{ $datas->permission_name }}" 
                                data-remark="{{ $datas->remark }}" 
                                data-toggle="modal" 
                                data-target="#modal-lg-detail">
                              <i class="fas fa-eye"></i>
                            </button>
                          </div>
                        </div>
                      </td>
                      <td>{{ $datas->ptw_id }}/PTW/{{ $datas->project_code }}/{{ \App\Helpers\DateHelper::monthToRoman(optional($datas->created_at)->month) }}/{{ $datas->created_at->format('Y') }}</td>
                      <td>{{ $datas->created_at }}</td>
                      <td>{{ $datas->berlaku_dari }} - {{ $datas->berlaku_sampai }}</td>
                      <td>{{ $datas->location_name }}</td>
                      <td>{{ $datas->remark }}</td>
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
      <div class="modal fade" id="modal-lg-detail">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail Perizinan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="nama_proyek">No. Register</label>
                <input type="text" id="no_register" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="nama_proyek">Tanggal Dikeluarkan</label>
                <input type="text" id="created_at" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="berlaku_dari">Berlaku Dari</label>
                <input type="text" id="berlaku_dari" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="berlaku_sampai">Berlaku Sampai</label>
                <input type="text" id="berlaku_sampai" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="nama_proyek">Lokasi Kerja</label>
                <input type="text" id="work_location" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="nama_proyek">Jenis Ijin Kerja Yang Dilakukan</label>
                <input type="text" id="permission_type" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="nama_proyek">Uraian Kegiatan</label>
                <input type="text" id="remark" class="form-control" disabled>
              </div>

              <div class="form-group">
                <div id="tools_div"></div>
              </div>

              <div class="form-group">
                <div id="instruksi_tambahan_div"></div>
              </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
      
@endsection