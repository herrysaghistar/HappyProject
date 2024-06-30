@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dokumen JHA</h1>
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
                <h3 class="card-title">Data Dokumen JHA</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                  {{ $errors->first() }}
                </div>
                @endif
                @cannot('kapro')
                <div class="col-2">
                  <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-lg">JHA Baru</button>
                </div>
                @endcan
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
                        <div class="row">
                          <div class="col-12">
                            <button class="btnid_jsa btn btn-secondary" 
                                    data-datas="{{ $data }}" 
                                    data-toggle="modal" 
                                    data-target="#modal-lg-detail-jsa">
                              <i class="fas fa-eye"></i>
                            </button>
                          </div>
                          @can('hse')
                          @if($data->review != 'Y')
                          <div class="col-12">
                            <button type="submit" class="btnid_jsa btn btn-outline-warning" id="btnid_jsa" 
                                    data-datas="{{ $data }}" 
                                    data-toggle="modal" 
                                    data-target="#modal-lg-edit-jsa">
                              <i class="fas fa-pen"></i>
                            </button>
                          </div>
                          @endcan
                          <div class="col-12">
                            <button type="submit" class="btnid_jsa btn btn-outline-danger" id="btnid_jsa" 
                                    data-datas="{{ $data }}" 
                                    data-toggle="modal" 
                                    data-target="#modal-sm-delete-jsa">
                              <i class="fas fa-trash"></i>
                            </button>
                          </div>
                          @endcan
                        </div>
                      </td>
                      <td>JHA {{ $data->formatted_id }}/{{ $data->project_code }}</td>
                      <td>{{ $data->judul_pekerjaan }}</td>
                      <td>{{ $data->supervisi_name }}</td>
                      <td>{{ $data->tempat_bekerja }}</td>
                      <td>{{ $data->created_at }}</td>
                      <td>{{ $data->reviewed_by }}</td>
                      @if($data->review != 'Y')
                      <td>
                        <button class="btn btn-danger" disabled>Belum Di Review</button>
                      </td>
                      @else
                      <td>{{ $data->updated_at }}</td>
                      @endif
                      <td>
                        @if($data->reviewed_by == '')
                          @can('hse')
                              <button class="btnid_jsa_review btn btn-danger" 
                                      id="btnid_jsa_review" 
                                      data-datas="{{ $data }}" 
                                      data-toggle="modal" 
                                      data-target="#modal-sm-review">
                                Belum Di Review
                              </button>
                          @elsecan('kabeng')
                              <button class="btnid_jsa_review btn btn-danger" 
                                      id="btnid_jsa_review" 
                                      data-datas="{{ $data }}" 
                                      data-toggle="modal" 
                                      data-target="#modal-sm-review">
                                Belum Di Review
                              </button>
                          @elsecan('kapro')
                              <button class="btnid_jsa_review btn btn-danger" 
                                      id="btnid_jsa_review" 
                                      data-datas="{{ $data }}" 
                                      data-toggle="modal" 
                                      data-target="#modal-sm-review">
                                Belum Di Review
                              </button>
                          @else
                              <button class="btn btn-danger" disabled>Belum Di Review</button>
                          @endcan
                        @else
                        <button class="btnid_jsa_review btn btn-outline-success" 
                                id="btnid_jsa_review" 
                                data-datas="{{ $data }}" 
                                data-toggle="modal" 
                                data-target="#modal-sm-review">Sudah Di Review</button>
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
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add JHA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ url('/create-jsa') }}">
                @csrf
                <div class="form-group">
                  <label for="manpower_qty">PTW</label>
                  <select class="form-control" name="ptw_id" id="ptw_id">
                    @foreach($ptw as $ptws)
                    <option value="{{ $ptws->ptw_id }}">{{ $ptws->ptw_id }}/PTW/{{ $ptws->project_code }}/{{ \App\Helpers\DateHelper::monthToRoman(optional($ptws->created_at)->month) }}/{{ $ptws->created_at->format('Y') }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Supervisi</label>
                  <input type="" name="supervisi" class="form-control" id="supervisi" required>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Penyusun JHA</label>
                  <div id="penyusun-jsa-container"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPenyusun()">Tambahkan Penyusun</button>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Pelaksana JHA</label>
                  <div id="pelaksana-jsa-container"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPelaksana()">Tambahkan Pelaksana</button>
                </div>

                <div class="form-group">
                  <label for="">Nama Proyek</label>
                  <select class="form-control" name="project_code" id="project_code">
                    @foreach($project as $projects)
                    <option value="{{ $projects->project_code }}">{{ $projects->project_code }} - {{ $projects->project_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Judul Pekerjaan</label>
                  <input type="" name="judul_pekerjaan" class="form-control" id="judul_pekerjaan" required>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Lokasi Pekerjaan</label>
                  <select class="form-control" name="tempat_bekerja" id="tempat_bekerja">
                    @foreach($location as $locations)
                    <option value="{{ $locations->location_name }}">{{ $locations->location_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="remark">Plant Location</label>
                  <input type="" name="plant_location" class="form-control" id="plant_location" required>
                </div>

                <div class="form-group">
                  <label for="remark">Uraian Tugas</label>
                  <textarea name="uraian_tugas" class="form-control" id="uraian_tugas" rows="3"></textarea>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Langkah kerja</label>
                  <div id="addLK"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addLK()">Tambahkan Langkah Kerja</button>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Potensi Bahaya</label>
                  <div id="addPB"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPB()">Tambahkan Potensi Bahaya</button>
                </div>
                
                <div class="form-group">
                  <label for="manpower_qty">Tindakan Pengendalian dan APD</label>
                  <div id="addPPE"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPPE()">Tambahkan PPE</button>
                </div>
                
                <div class="form-group">
                  <label for="manpower_qty">Person Responsible For Control Measure</label>
                  <div id="addPerson"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPerson()">Tambahkan Person Responsible</button>
                </div>

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-success" type="submit">Buat JHA</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-lg-detail-jsa">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail JHA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="manpower_qty">Doc. No. PTW</label>
                <input type="" name="doc_no_ptw" class="form-control" id="doc_no_ptw" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Doc. No.</label>
                <input type="" name="doc_no" class="form-control" id="doc_no" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Supervisi</label>
                <input type="" name="supervisi" class="form-control" id="supervisi" disabled>
              </div>

              <div class="form-group">
                  <label for="manpower_qty">Penyusun JHA</label>
                  <div id="detail-penyusun-jsa-container"></div>
              </div>

              <div class="form-group">
                  <label for="manpower_qty">Pelaksana JHA</label>
                  <div id="detail-pelaksana-jsa-container"></div>
              </div>

              <div class="form-group">
                <label for="">Kode Proyek</label>
                <input type="" name="project_name" class="form-control" id="project_name" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Judul Pekerjaan</label>
                <input type="" name="judul_pekerjaan" class="form-control" id="judul_pekerjaan" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Lokasi Pekerjaan</label>
                <input type="" name="location_name" class="form-control" id="location_name" disabled>
              </div>

              <div class="form-group">
                <label for="remark">Plant Location</label>
                <input type="" name="plant_location" class="form-control" id="plant_location" disabled>
              </div>

              <div class="form-group">
                <label for="remark">Uraian Tugas</label>
                <input type="" name="uraian_tugas" class="form-control" id="uraian_tugas" disabled>
              </div>

              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-lg-edit-jsa">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit JHA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ url('/edit-jsa') }}">
                @csrf
                <input type="" name="id" class="form-control" id="id" hidden>
                <div class="form-group">
                  <label for="manpower_qty">Supervisi</label>
                  <input type="" name="supervisi" class="form-control" id="supervisi" required>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Penyusun JHA</label>
                  <div id="edit-penyusun-jsa-container"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPenyusunForEdit()">Tambahkan Penyusun</button>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Pelaksana JHA</label>
                  <div id="edit-pelaksana-jsa-container"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPelaksanaForEdit()">Tambahkan Pelaksana</button>
                </div>

                <div class="form-group">
                  <label for="">Nama Proyek</label>
                  <select class="form-control" name="project_code" id="project_code">
                    @foreach($project as $projects)
                    <option value="{{ $projects->project_code }}">{{ $projects->project_code }} - {{ $projects->project_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Judul Pekerjaan</label>
                  <input type="" name="judul_pekerjaan" class="form-control" id="judul_pekerjaan" required>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Lokasi Pekerjaan</label>
                  <select class="form-control" name="tempat_bekerja" id="tempat_bekerja">
                    @foreach($location as $locations)
                    <option value="{{ $locations->location_name }}">{{ $locations->location_name }}</option>
                    @endforeach
                  </select>
                </div>

                <div class="form-group">
                  <label for="remark">Plant Location</label>
                  <input type="" name="plant_location" class="form-control" id="plant_location" required>
                </div>

                <div class="form-group">
                  <label for="remark">Uraian Tugas</label>
                  <textarea name="uraian_tugas" class="form-control" id="uraian_tugas" rows="3"></textarea>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Langkah kerja</label>
                  <div id="addLKForEdit"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addLKForEdit()">Tambahkan Langkah Kerja</button>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Potensi Bahaya</label>
                  <div id="addPBForEdit"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPBForEdit()">Tambahkan Potensi Bahaya</button>
                </div>
                
                <div class="form-group">
                  <label for="manpower_qty">Tindakan Pengendalian dan APD</label>
                  <div id="addPPEForEdit"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPPEForEdit()">Tambahkan PPE</button>
                </div>
                
                <div class="form-group">
                  <label for="manpower_qty">Person Responsible For Control Measure</label>
                  <div id="addPersonForEdit"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPersonForEdit()">Tambahkan Person Responsible</button>
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
      <div class="modal fade" id="modal-sm-delete-jsa">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Yakin Untuk Menghapus Dokumen JSA?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/delete-jsa') }}" method="post">
                @csrf
                <input type="" name="id" id="id" hidden>
                <button type="submit" class="btn btn-danger">Hapus JSA</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-sm-review">
        <div class="modal-dialog modal-xl">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="review_jsa_title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>
                Detail JSA telah mempertimbangkan hal hal berikut :
              </p>
              <div class="form-group">
                <label for="manpower_qty">Doc. No. PTW</label>
                <input type="" name="doc_no_ptw_review" class="form-control" id="doc_no_ptw_review" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Doc. No.</label>
                <input type="" name="doc_no" class="form-control" id="doc_no" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Supervisi</label>
                <input type="" name="supervisi" class="form-control" id="supervisi" disabled>
              </div>

              <div class="form-group">
                  <label for="manpower_qty">Penyusun JHA</label>
                  <div id="detail-penyusun-jsa-container-review"></div>
              </div>

              <div class="form-group">
                  <label for="manpower_qty">Pelaksana JHA</label>
                  <div id="detail-pelaksana-jsa-container-review"></div>
              </div>

              <div class="form-group">
                <label for="">Kode Proyek</label>
                <input type="" name="project_name" class="form-control" id="project_name" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Judul Pekerjaan</label>
                <input type="" name="judul_pekerjaan" class="form-control" id="judul_pekerjaan" disabled>
              </div>

              <div class="form-group">
                <label for="manpower_qty">Lokasi Pekerjaan</label>
                <input type="" name="location_name" class="form-control" id="location_name" disabled>
              </div>

              <div class="form-group">
                <label for="remark">Plant Location</label>
                <input type="" name="plant_location" class="form-control" id="plant_location" disabled>
              </div>

              <div class="form-group">
                <label for="remark">Uraian Tugas</label>
                <input type="" name="uraian_tugas" class="form-control" id="uraian_tugas" disabled>
              </div>

              <label>Langkah Kerja</label>              
              <div id="PertimbanganLKJSA"></div>
              <label>Potensi Bahaya</label>              
              <div id="PertimbanganPBJSA"></div>
              <label>PPE/Tindakan Pengendalian</label>              
              <div id="PertimbanganPPEJSA"></div>
              <label>Penanggung Jawab</label>
              <div id="PertimbanganPersonJSA"></div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <form action="{{ url('/edit-status-review-jsa') }}" method="post">
                @csrf
                <input type="" name="id" id="id" hidden>
                <button type="submit" class="btn btn-success" id="acc-jha-button" style="display: none;">ACC JHA</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection