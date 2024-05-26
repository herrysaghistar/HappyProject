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
                      <th>Detail</th>
                      <th>No. Register</th>
                      <th>Dibuat oleh</th>
                      <th>Tanggal Dikeluarkan</th>
                      <th>Periode</th>
                      <th>Lokasi Kerja</th>
                      <th>Status Pekerjaan</th>
                      <th>Approval</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>
                        <button class="btniddetail btn btn-secondary" id="btniddetail" 
                                data-ptw-id="{{ $datas->ptw_id }}" 
                                data-manpower-qty="{{ $datas->manpower_qty }}" 
                                data-project="{{ $datas->project_name }}" 
                                data-month="{{ \App\Helpers\DateHelper::monthToRoman(optional($datas->created_at)->month) }}"
                                data-year="{{ $datas->created_at->format('Y') }}" 
                                data-created-at="{{ $datas->created_at }}" 
                                data-created-by="{{ $datas->created_by }}" 
                                data-berlaku-dari="{{ $datas->berlaku_dari }}" 
                                data-berlaku-sampai="{{ $datas->berlaku_sampai }}" 
                                data-location-name="{{ $datas->location_name }}" 
                                data-project-name="{{ $datas->project_name }}" 
                                data-permission-type="{{ $datas->permission_name }}" 
                                data-permission-tambahan="{{ $datas->permission_names }}"
                                data-tools="{{ $datas->tools_names }}"
                                data-toggle="modal" 
                                data-target="#modal-lg-detail">
                          <i class="fas fa-eye"></i>
                        </button>
                      </td>
                      <td>{{ $datas->ptw_id }}/PTW/{{ \App\Helpers\DateHelper::monthToRoman(optional($datas->created_at)->month) }}/{{ $datas->created_at->format('Y') }}</td>
                      <td>{{ $datas->created_at }}</td>
                      <td>{{ $datas->created_by }}</td>
                      <td>{{ $datas->berlaku_dari }} - {{ $datas->berlaku_sampai }}</td>
                      <td>{{ $datas->location_name }}</td>
                      <td>
                        @if($datas->status == 'progress')
                        <div class="row">
                          <div>
                            Pekerjaan Sedang Dalam Progress
                          </div>
                          <div>
                            <button class="btn btn-outline-success">Pekerjaan Selesai</button>
                          </div>
                        </div>
                        @elseif($datas->status == 'done')
                          Pekerjaan Telah Selesai
                        @elseif($datas->level == 'rejected')
                          Dokumen Ditolak
                        @elseif($datas->level != 'approved' && $datas->level != 'rejected')
                          Dokumen Belum Disetujui
                        @elseif($datas->status == 'onprogress')
                        <button type="submit" class="btnid btn btn-outline-warning" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-done">Selesaikan Pekerjaan</button>
                        @elseif(!$datas->status)
                        <button type="submit" class="btnid btn btn-outline-warning" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-progress">Mulai Pekerjaan</button>
                        @endif
                      </td>
                      <td>
                          @if($datas->level == 'approved')
                          <a href="{{ url('/download-pdf').'/'.$datas->ptw_id }}">
                            <button class="btn btn-outline-primary">Download PDF</button>
                          </a>
                          @elseif($datas->level == 'rejected')
                          <button class="btn btn-outline-danger" disabled>Perijinan ditolak oleh {{ $datas->rejected_by }}</button>
                          @else
                            @can('spv')
                            Menunggu keputusan {{ $datas->level }}
                            @endcan
                            @cannot('spv')
                            <button type="submit" class="btnid btn btn-success" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-success">Acc Permohonan</button>
                            <button type="submit" class="btnid btn btn-danger" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-danger">Reject Permohonan</button>
                            @endcannot
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
              <form method="POST" action="{{ url('/create-ptw') }}">
                @csrf
                <div class="form-group">
                  <label for="exampleFormControlSelect1">Nama Proyek</label>
                  <select class="form-control" name="project_id" id="exampleFormControlSelect1">
                    @foreach($project as $projects)
                    <option value="{{ $projects->id }}">{{ $projects->project_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Lokasi</label>
                  <select class="form-control" name="location_id" id="exampleFormControlSelect1">
                    @foreach($work_location as $work_locations)
                    <option value="{{ $work_locations->id }}">{{ $work_locations->location_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                    <label for="berlaku_dari">Berlaku Dari</label>
                    <input type="date" name="berlaku_dari" class="form-control" id="berlaku_dari" required>
                </div>

                <div class="form-group">
                    <label for="berlaku_sampai">Berlaku Sampai</label>
                    <input type="date" name="berlaku_sampai" class="form-control" id="berlaku_sampai" required>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlSelect1">Jenis Perizinan</label>
                  <select class="form-control" name="permission_id" id="exampleFormControlSelect1">
                    @foreach($permission_type as $permission_types)
                    <option value="{{ $permission_types->id }}">{{ $permission_types->permission_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="tools">Instruksi Tambahan</label>
                  <div class="row">
                    <div class="col-12">
                      @foreach($permission_tambahan as $permission)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $permission->id }}" name="permission_tambahan[]" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          {{ $permission->permission_name }}
                        </label>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tools">Equipment</label>
                  <div class="row">
                    <div class="col-12">
                      @foreach($tools as $tool)
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="{{ $tool->id }}" name="tools[]" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          {{ $tool->tools_name }}
                        </label>
                      </div>
                      @endforeach
                    </div>
                  </div>
                </div>

                <div class="form-group">
                    <label for="manpower_qty">Jumlah Man Power</label>
                    <input type="number" name="manpower_qty" class="form-control" id="manpower_qty" required>
                </div>

                <div class="form-group">
                    <label for="remark">Catatan/Keterangan Tambahan</label>
                    <textarea name="remark" class="form-control" id="remark" rows="3"></textarea>
                </div>

            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button class="btn btn-success" type="submit">Buat Permohonan</button>
            </div>
              </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
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
                <label for="nama_proyek">Nama Proyek</label>
                <input type="text" id="nama_proyek" class="form-control" disabled>
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
                <label for="nama_proyek">Uraian Kegiatan</label>
                <input type="text" id="remark" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="nama_proyek">Jenis Ijin Kerja Yang Dilakukan</label>
                <input type="text" id="permission_type" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Jumlah Man Power</label>
                <input type="text" id="manpower_qty" class="form-control" disabled>
              </div>

              <div class="form-group">
                <label for="Tools">Tools</label>
                <p id="tools1"></p>
                <p id="tools2"></p>
                <p id="tools3"></p>
                <p id="tools4"></p>
                <p id="tools5"></p>
                <p id="tools6"></p>
                <p id="tools7"></p>
                <p id="tools8"></p>
                <p id="tools9"></p>
                <p id="tools10"></p>
                <p id="tools11"></p>
                <p id="tools12"></p>
              </div>

              <div class="form-group">
                <label for="instruksi_tambahan">Instruksi Tambahan</label>
                <p id="instruksi_tambahan1"></p>
                <p id="instruksi_tambahan2"></p>
                <p id="instruksi_tambahan3"></p>
                <p id="instruksi_tambahan4"></p>
              </div>
            </div>
            <div class="modal-footer justify-content-end">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-sm-success">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Setujui Perizinan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/acc') }}" method="post">
                @csrf
                <input type="" name="id_ptw" id="id_ptw" hidden>
                <button type="submit" class="btn btn-success">Setujui</button>
              </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <div class="modal fade" id="modal-sm-danger">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Tolak Perizinan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/reject') }}" method="post">
                @csrf
                <input type="" name="id_ptw" id="id_ptw" hidden>
                <button type="submit" class="btn btn-danger">Tolak</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-sm-progress">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Status Pekerjaan Menjadi On Progress?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/mulai') }}" method="post">
                @csrf
                <input type="" name="id_ptw" id="id_ptw" hidden>
                <button type="submit" class="btn btn-primary">Mulai</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-sm-done">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Status Pekerjaan Menjadi Selesai?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/done') }}" method="post">
                @csrf
                <input type="" name="id_ptw" id="id_ptw" hidden>
                <button type="submit" class="btn btn-success">Selesai</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection