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
                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                  {{ $errors->first() }}
                </div>
                @endif
                @cannot('kapro')
                <div class="col-2">
                  <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-lg">JSA Baru</button>
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
                          <div class="col-12">
                            <button type="submit" class="btnid_jsa btn btn-outline-warning" id="btnid_jsa" 
                                    data-datas="{{ $data }}" 
                                    data-toggle="modal" 
                                    data-target="#modal-lg-edit-jsa">
                              <i class="fas fa-pen"></i>
                            </button>
                          </div>
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
                      @if($data->created_at == $data->updated_at)
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
      <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add JSA</h4>
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
                  <label for="manpower_qty">Penyusun JSA</label>
                  <div id="penyusun-jsa-container"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPenyusun()">Tambahkan Penyusun</button>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Pelaksana JSA</label>
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

                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button class="btn btn-success" type="submit">Buat Permohonan</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-lg-detail-jsa">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Detail JSA</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ url('/create-ptw') }}">
                @csrf
                <div class="form-group">
                  <label for="manpower_qty">Doc. No.</label>
                  <input type="" name="doc_no" class="form-control" id="doc_no" disabled>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Supervisi</label>
                  <input type="" name="supervisi" class="form-control" id="supervisi" disabled>
                </div>

                <div class="form-group">
                    <label for="manpower_qty">Penyusun JSA</label>
                    <div id="detail-penyusun-jsa-container"></div>
                </div>

                <div class="form-group">
                    <label for="manpower_qty">Pelaksana JSA</label>
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
              </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-lg-edit-jsa">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit JSA</h4>
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
                  <label for="manpower_qty">Penyusun JSA</label>
                  <div id="edit-penyusun-jsa-container"></div>
                  <button type="button" class="btn btn-outline-primary btn-sm" onclick="addPenyusunForEdit()">Tambahkan Penyusun</button>
                </div>

                <div class="form-group">
                  <label for="manpower_qty">Pelaksana JSA</label>
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
              <figure class="table" style="width:680pt; margin: 0 auto;">
                <table class="ck-table-resized" style="border-collapse:collapse;" border="0" cellpadding="0" cellspacing="0" width="904">
                    <colgroup>
                        <col style="width:25%;" width="226">
                        <col style="width:25%;">
                        <col style="width:25%;">
                        <col style="width:25%;">
                    </colgroup>
                    <tbody>
                        <tr style="height:120.75pt;" height="161">
                            <td class="xl65" style="border:1pt solid windowtext;font-style:normal;height:120.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:middle;white-space-collapse:collapse;width:170pt;" height="161" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>PROCESS STEPS / LANGKAH KERJA</strong></span></span></td>
                            <td class="xl66" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top:1pt solid windowtext;font-style:normal;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:middle;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>POTENTIAL HAZARDS / POTENSI BAHAYA</strong></span></span></td>
                            <td class="xl66" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top:1pt solid windowtext;font-style:normal;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:middle;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>PPE / TINDAKAN PENGENDALIAN &amp; APD</strong></span></span></td>
                            <td class="xl66" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top:1pt solid windowtext;font-style:normal;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:middle;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>PERSON(S) RESPONSIBLE FOR CONTROL MEASURE</strong></span></span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:182.25pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="6" height="243" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Persiapan Personil</strong></span></span></td>
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pekerja kurang / tidak sehat</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan semua pekerja dalam kondisi sehat</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Semua orang yang terlibat dengan pekerjaan</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan semua pekerja sudah melakukan Medical Check Uo</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:60.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="81" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pekerja tidak mengetahui peraturan K3 di lokasi proyek</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja mendapat Safety Induction</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja mengikuti sosialisasi prosedur, PTW, dan JHA</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:60.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="81" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pekerja tidak kompeten</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja memiliki sertifikat kompetensi yang balid</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Supervisi</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja berkompeten di bidangnya</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:60.75pt;" height="81">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:152.25pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="3" height="203" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Persiapan benda kerja</strong></span></span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Block belum mendapat izin untuk dikerjakan</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan block atau benda kerja telah mendapat izin untuk dilakukan pekerjaan dari supervisi / QA</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Penempatan block masih belum sempurna</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan block telah berada di tempat yang aman dan sesuai rencana penempatan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Kebocoran aliran listrik pada kabel</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan semua&nbsp;</span></font>
                                    <font class="font8" style="font-weight:400;text-decoration-line:none;"><i><span lang="EN-US" dir="ltr">cable connection</span></i></font>
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr"> sudah diinspeksi dan tidak ada yang terkelupas</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:198.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="5" height="265" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Persiapan alat, tabung oksigen &amp; asetilin, selang-selang dan cutting torch</strong></span></span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Terjepit</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja menggunakan APD yang sesuai (</span></font>
                                    <font class="font8" style="font-weight:400;text-decoration-line:none;"><i><span lang="EN-US" dir="ltr">safety gloves</span></i></font>
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">)</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Penanganan manual (</span></font>
                                    <font class="font8" style="font-weight:400;text-decoration-line:none;"><i><span lang="EN-US" dir="ltr">manual handling</span></i></font>
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">) salah</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja mengikuti prosedur manual handling</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Kabel/aksesoris mesin las tidak terisolasi dengan baik dan tidak aman digunakan</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan mesin telah diinspeksi dan dipastikan aman untuk digunakan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Selang gas bocor</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan selang gas telah diklem secara aman dan tidak ada kebocoran</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US"></span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Tabung gas menimpa pekerja</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Penempatan tabung yang rapi, terikat dan terdapat jarak antara oksigen dan asetilin</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US"></span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:76.5pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="102" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Persiapan mesin las dan peralatannya</strong></span></span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Mesin las tidak berfungsi</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan mesin berfungsi dan terkalibrasi dengan baik</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Kabel/aksesoris mesin las tidak terisolasi dengan baik dan tidak aman digunakan</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan mesin telah diinspeksi dan aman untuk digunakan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US"></span></span></td>
                        </tr>
                        <tr style="height:15.0pt;" height="20">
                            <td class="xl71" style="border-bottom-style:none;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;height:15.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="20" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Perisapan alat lifting gear</strong></span></span></td>
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Kondisi peralatan/penataan peralatan tidak sesuai</span></font>
                                </span></td>
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan kondisi peralatan sesuai dan tertata rapi</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:15.75pt;" height="21">
                            <td class="xl77" style="border-bottom-style:none;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:15.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="21" width="226"><span style="color:black;font-family:&quot;Courier New&quot;, monospace;font-size:11pt;"><span lang="EN-US" dir="ltr">o</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font6" style="font-style:normal;text-decoration-line:none;"><span lang="EN-US" dir="ltr"><strong>Sling</strong></span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl77" style="border-bottom-style:none;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:&quot;Courier New&quot;, monospace;font-size:11pt;"><span lang="EN-US" dir="ltr">o</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font6" style="font-style:normal;text-decoration-line:none;"><span lang="EN-US" dir="ltr"><strong>Shackle</strong></span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Peralatan tidak berfungsi/rusak</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan peralatan berfungsi dan telah dilakukan loadtest</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl77" style="border-bottom-style:none;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:&quot;Courier New&quot;, monospace;font-size:11pt;"><span lang="EN-US" dir="ltr">o</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font6" style="font-style:normal;text-decoration-line:none;"><span lang="EN-US" dir="ltr"><strong>Hook</strong></span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Peralatan tidak sesuai dengan kapasitas</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan peralatan yang digunakan sesuai dengan prosedur</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl78" style="border-bottom:1pt solid windowtext;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:&quot;Courier New&quot;, monospace;font-size:11pt;"><span lang="EN-US" dir="ltr">o</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font6" style="font-style:normal;text-decoration-line:none;"><span lang="EN-US" dir="ltr"><strong>Chain/lever block</strong></span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Melakukan pengangkatan melebihi kapasitas</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pengangkatan sesuai dengan kapasitas&nbsp;</span></font>
                                    <font class="font8" style="font-weight:400;text-decoration-line:none;"><i><span lang="EN-US" dir="ltr">Overhead Crane</span></i></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:243.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="7" height="325" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Persiapan Lokasi</strong></span></span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Lantai licin</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan lokasi terbebas dari genangan air dan peralatan lain (pipa, scaffolding, dll)</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Ada material lain di lokasi kerja yang membuat proses terhambat</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan lokasi kerja bebas dari material yang tidak diperlukan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Lokasi/area kerja kotor dan tidak rapi</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Lakukan pembersihan setiap sebelum dan setelah melaksanakan pekerjaan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Lokasi/area kerja gelap</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan terdapat penerangan tambahan yang dapat digunakan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:90.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="3" height="121" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Suhu di lokasi/area kerja panas</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan terdapat ventilasi yang memadai</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="3" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="40" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Gunakan exhaust fan bila diperlukan</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan kebutuhan air minum terpenuhi untuk semua pekerja</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:196.5pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="6" height="262" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Fit up block BMPP</strong></span></span></td>
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="4" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Tergores, terjepit, terpukul</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja memakai APD yang sesuai (</span></font>
                                    <font class="font8" style="font-weight:400;text-decoration-line:none;"><i><span lang="EN-US" dir="ltr">safety gloves</span></i></font>
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">)</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="4" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="40" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja memahami prosedur aman bekerja</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:45.0pt;" height="60">
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="60" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja melakukan pekerjaan dengan hati-hati dan konsentrasi</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Tidak mengambil jalan pintas dalam melakukan pekerjaan</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:60.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="81" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Kesalahan manual handling</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja memahami prosedur manual handling</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja melakukan pengangkatan sesuai prosedur</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:75.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="101" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Penandaan marking&nbsp;</strong></span></span></td>
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Salah gambar/prosedur</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan bekerja sesuai gambar dan prosedur kerja</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan sebelum melakukan pekerjaan telah berkoordinasi dengan supervisi dan owner</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:60.0pt;" height="80">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:363.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="9" height="484" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Cutting material dengan menggunakan oxy-acetilyn</strong></span></span></td>
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="5" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Terjadi api balik, kebakaran selang, dan ledakan tabung</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pemasangan flashback arrestor pada posisi torch dan regulator dari kedua macam gas dan lakukan pembersihan torch dengan benar</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="5" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US"></span></span></td>
                        </tr>
                        <tr style="height:45.0pt;" height="60">
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="60" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Mengatur katup regulator kedua macam gas sesuai dengan persyaratan aman</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="40" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pemasangan regulator dengan benar pastikan tidak longgar</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="40" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pemasangan cutting torch dengan benar</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:60.75pt;" height="81">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:60.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="81" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Tersedia APAR dalam jarak yang mudah dijangkau dan pastikan pekerja terlatih untuk menggunakannya</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:15.0pt;" height="20">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Selang blander lepas dan/atau bocor</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Periksa semua sambungan</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US"></span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Lakukan bubble test sebelum menggunakan blander</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Luka bakar akibat bunga api atau letupan</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Menggunakan APD yang disyaratkan seusai dengan kebutuhan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US"></span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Menghirup asap, kerusakan mata karena sinar api dan torch pada pekerja</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Menggunakan APD yang disyaratkan seusai dengan kebutuhan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US"></span></span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:318.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="9" height="424" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Pekerjaan pengelasan</strong></span></span></td>
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;</span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Terpapar cahaya las, terkena percikan, menghirup asap las</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan personel yang bekerja kompeten di bidangnya</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:75.75pt;" height="101">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:75.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="101" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja menggunakan APD yang sesuai (safety helmet, safety shoes, sarung tangan las, kap las, masker, selubung tangan) dan apron bila diperlukan</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:15.0pt;" height="20">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Luka bakar akibat terkena percikan api las</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pemberian fire blanket</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja menggunakan APD yang sesuai</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:90.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="3" height="121" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Kebakaran yang disebabkan oleh benda terbakar (kertas, plastik, dan bahan mudah terbakar lainnya)</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan area kerja telah steril sebelum melakukan pekerjaan</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="3" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="40" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan tidak ada bahan yang mudah terbakar dekat area kerja</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Benda yang mudah terbakar harus dipindahkan atau ditutup</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:75.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="101" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pekerja mengalami dehidrasi</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan persediaan air minum cukup</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pekerja dihimbau untuk membawa bekal air minum sendiri di area kerja masing-masing</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:60.75pt;" height="81">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:182.25pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="4" height="243" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Penggerindaan</strong></span></span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Batu gerinda pecah</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan mesin gerinda/rotary telah diperiksa dan gunakan batu gerinda sesuai dengan RPM yang tercantum</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Pekerja</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Tersengat listrik mesin gerinda</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Periksa seluruh konektor kabel dan pastikan telah terisolasi dengan baik dan aman</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.0pt;" height="40">
                            <td class="xl68" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;height:75.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" height="101" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pekerja mengalami dehidrasi</span></font>
                                </span></td>
                            <td class="xl69" style="border-bottom-style:none;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan persediaan air minum cukup</span></font>
                                </span></td>
                            <td class="xl70" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="2" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pekerja dihimbau untuk membawa bekal air minum sendiri di area kerja masing-masing</span></font>
                                </span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl67" style="border-bottom:1.0pt solid black;border-left:1pt solid windowtext;border-right:1pt solid windowtext;border-top:1pt none windowtext;font-style:normal;height:153.0pt;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" rowspan="4" height="204" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr"><strong>Kebersihan dan kerapian area</strong></span></span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Kondisi peralatan/penataan peralatan berantakan/berserakan.</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan kondisi peralatan sesuai dan tertata rapi</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Lokasi/area kotor, tidak bersih, licin</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan lokasi terbebas dari material/peralatan lain yang tidak digunakan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:30.75pt;" height="41">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:30.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="41" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Terjepit atau terluka saat melakukan pembersihan</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan pekerja berhati-hati dalam melakukan pembersihan</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                        <tr style="height:45.75pt;" height="61">
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;height:45.75pt;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" height="61" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Waste/sampah</span></font>
                                </span></td>
                            <td class="xl73" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-align:left;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Symbol, serif;font-size:11pt;"><span lang="EN-US" dir="ltr">·</span></span><span style="color:black;font-family:&quot;Times New Roman&quot;, serif;font-size:7pt;">
                                    <font class="font7" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span></font>
                                </span><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;">
                                    <font class="font5" style="font-style:normal;font-weight:400;text-decoration-line:none;"><span lang="EN-US" dir="ltr">Pastikan sampah dibuang pada tempatnya dan dipisah sesuai jenisnya</span></font>
                                </span></td>
                            <td class="xl76" style="border-bottom:1pt solid windowtext;border-left-style:none;border-right:1pt solid windowtext;border-top-style:none;font-style:normal;font-weight:400;padding-left:1px;padding-right:1px;padding-top:1px;text-decoration-line:none;text-wrap:wrap;vertical-align:top;white-space-collapse:collapse;width:170pt;" width="226"><span style="color:black;font-family:Calibri, sans-serif;font-size:11pt;"><span lang="EN-US" dir="ltr">Pengawas kerja (Supervisi) / Safety</span></span></td>
                        </tr>
                    </tbody>
                </table>
            </figure>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <form action="{{ url('/edit-status-review-jsa') }}" method="post">
                @csrf
                <input type="" name="id" id="id" hidden>
                <button type="submit" class="btn btn-success">ACC JSA</button>
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