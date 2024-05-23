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
                      <th>Approval</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>{{ $datas->karyawan_name }}</td>
                      <td>{{ $datas->project_name }}</td>
                      <td>{{ $datas->created_at }}</td>
                      <td>{{ $datas->berlaku_dari }} - {{ $datas->berlaku_sampai }}</td>
                      <td></td>
                      <td></td>
                      <td>{{ $datas->manpower_qty }}</td>
                      <td>{{ $datas->remark }}</td>
                      <td>
                          @if($datas->status == 'N')
                          Ditolak
                          @elseif($datas->status == 'Y')
                          <a href="{{ url('/download-pdf').'/'.$datas->ptw_id }}">
                            <button class="btn btn-outline-primary">Download PDF</button>
                          </a>
                          @else
                          <button type="submit" class="btnid btn btn-success" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-success">Acc Permohonan</button>
                          <button type="submit" class="btnid btn btn-danger" id="btnid" data-id="{{ $datas->ptw_id }}" data-toggle="modal" data-target="#modal-sm-danger">Reject Permohonan</button>
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
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- Modal -->
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection