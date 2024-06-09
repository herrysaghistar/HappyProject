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
                      <th>Status Dokumen</th>
                      <th>Approval</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>
                        <div class="row">
                          <div class="col-12">
                            <button class="btniddetail btn btn-secondary" id="btniddetail" 
                                data-ptw-id="{{ $datas->ptw_id }}" 
                                data-manpower-qty="{{ $datas->manpower_qty }}" 
                                data-project="{{ $datas->project_name }}" 
                                data-project-id="{{ $datas->project_id }}" 
                                data-month="{{ \App\Helpers\DateHelper::monthToRoman(optional($datas->created_at)->month) }}"
                                data-year="{{ $datas->created_at->format('Y') }}" 
                                data-created-at="{{ $datas->created_at }}" 
                                data-created-by="{{ $datas->created_by }}" 
                                data-berlaku-dari="{{ $datas->berlaku_dari }}" 
                                data-berlaku-sampai="{{ $datas->berlaku_sampai }}" 
                                data-location-name="{{ $datas->location_name }}" 
                                data-project-name="{{ $datas->project_name }}" 
                                data-permission-type="{{ $datas->permission_name }}" 
                                data-remark="{{ $datas->remark }}" 
                                data-toggle="modal" 
                                data-target="#modal-lg-detail">
                              <i class="fas fa-eye"></i>
                            </button>
                          </div>
                          @can('hse')
                          <div class="col-12">
                            <button type="submit" class="btnid btn btn-outline-warning" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-lg-edit"><i class="fas fa-pen"></i></button>
                          </div>
                          <div class="col-12">
                            <button type="submit" class="btnid btn btn-outline-danger" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-delete"><i class="fas fa-trash"></i></button>
                          </div>
                          @endcan
                        </div>
                      </td>
                      <td>{{ $datas->ptw_id }}/PTW/{{ $datas->project_code }}/{{ \App\Helpers\DateHelper::monthToRoman(optional($datas->created_at)->month) }}/{{ $datas->created_at->format('Y') }}</td>
                      <td>{{ $datas->created_by }}</td>
                      <td>{{ $datas->created_at }}</td>
                      <td>{{ $datas->berlaku_dari }} - {{ $datas->berlaku_sampai }}</td>
                      <td>{{ $datas->location_name }}</td>
                      <td>
                        @if($datas->status == 'onprogress')
                        <button type="submit" class="btnid btn btn-outline-warning" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-hold">Hold</button>
                        <button type="submit" class="btnid btn btn-danger" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-done">Close</button>
                        @elseif($datas->status == 'onhold')
                        <button type="submit" class="btnid btn btn-outline-warning" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-open">Open</button>
                        @elseif($datas->status == 'done')
                        <button class="btn btn-success" disabled>Closed</button>
                        @elseif(!$datas->status)
                        <button class="btn btn-warning" disabled>Butuh Approval KAPRO Untuk Open</button>
                        @endif
                      </td>
                      <td>
                        @if($datas->level == 'approved')
                          <button class="btn btn-success" disabled>Dokumen Telah Di Approve!</button>
                        @elseif($datas->level == 'rejected')
                          <button class="btn btn-danger" disabled>Dokumen Ditolak</button>
                        @elseif($datas->level != 'approved' && $datas->level != 'rejected')
                          <button class="btn btn-warning" disabled>Dokumen Belum Disetujui</button>
                        @endif
                      </td>
                      <td>
                          @if($datas->level == 'approved')
                          <a href="{{ url('/download-pdf').'/'.$datas->ptw_id }}">
                            <button class="btn btn-outline-primary">Download PDF</button>
                          </a>
                          @elseif($datas->level == 'rejected')
                          <button class="btn btn-danger" disabled>Perijinan ditolak oleh {{ $datas->rejected_by }}</button>
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
                  <label for="">Nama Proyek</label>
                  <select class="form-control" name="project_id" id="">
                    @foreach($project as $projects)
                    <option value="{{ $projects->id }}">{{ $projects->project_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Lokasi</label>
                  <select class="form-control" name="location_id" id="">
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
                  <select class="form-control" name="permission_id" id="permission_select">
                    <option value="">Pilih Izin</option>
                    @foreach($permission_type as $permission_types)
                    <option value="{{ $permission_types->id }}">{{ $permission_types->permission_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="tools">Instruksi Tambahan</label>
                  <div class="row">
                    <div class="col-12" id="instruksi_tambahan">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="permission_tambahan[]" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Isi Perizinan Dulu!
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tools">Equipment</label>
                  <div class="row">
                    <div class="col-12" id="inputApd">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="tools[]" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Isi Perizinan Dulu!
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Jumlah Man Power</label>
                  <input type="number" name="manpower_qty" class="form-control" id="manpower_qty" required>
                </div>

                <div class="form-group">
                  <label for="remark">Uraian Kegiatan</label>
                  <textarea name="remark" class="form-control" id="remark" rows="3"></textarea>
                </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-success" type="submit">Buat Permohonan</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-lg-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Form Perizinan</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ url('/edit-ptw') }}">
                @csrf
                <input type="" name="id_ptw" id="id_ptw" hidden>
                <div class="form-group">
                  <label for="">Nama Proyek</label>
                  <select class="form-control" name="project_id" id="">
                    @foreach($project as $projects)
                    <option value="{{ $projects->id }}">{{ $projects->project_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="">Lokasi</label>
                  <select class="form-control" name="location_id" id="">
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
                  <select class="form-control" name="permission_id" id="permission_select_edit">
                    <option value="">Pilih Izin</option>
                    @foreach($permission_type as $permission_types)
                    <option value="{{ $permission_types->id }}">{{ $permission_types->permission_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="tools">Instruksi Tambahan</label>
                  <div class="row">
                    <div class="col-12" id="edit_instruksi_tambahan">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="permission_tambahan[]" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Isi Perizinan Dulu!
                        </label>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="form-group">
                  <label for="tools">Equipment</label>
                  <div class="row">
                    <div class="col-12" id="editApd">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" name="tools[]" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">
                          Isi Perizinan Dulu!
                        </label>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="manpower_qty">Jumlah Man Power</label>
                  <input type="number" name="manpower_qty" class="form-control" id="manpower_qty" required>
                </div>
                <div class="form-group">
                  <label for="remark">Uraian Kegiatan</label>
                  <textarea name="remark" class="form-control" id="remark" rows="3"></textarea>
                </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-success" type="submit">Edit Permohonan</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-sm-delete">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Yakin Untuk Menghapus Form Perizinan?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/delete-ptw') }}" method="post">
                @csrf
                <input type="" name="id_ptw" id="id_ptw" hidden>
                <button type="submit" class="btn btn-danger">Hapus Form</button>
              </form>
            </div>
          </div>
        </div>
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
        </div>
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
      <div class="modal fade" id="modal-sm-open">
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
      <div class="modal fade" id="modal-sm-hold">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Ubah Status Pekerjaan Menjadi On Hold ?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/hold') }}" method="post">
                @csrf
                <input type="" name="id_ptw" id="id_ptw" hidden>
                <button type="submit" class="btn btn-success">Hold</button>
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