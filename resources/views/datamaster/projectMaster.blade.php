@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Project</h1>
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
                <h3 class="card-title">Data Project</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-2">
                  <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-lg-project-add">Project Baru</button>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>Project Code</th>
                      <th>Project Name</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>{{ $datas->project_code }}</td>
                      <td>{{ $datas->project_name }}</td>
                      <td>
                        <button class="btnid_master_edit btn btn-outline-primary" id="btnid_project" data-id="{{ $datas->id }}" data-toggle="modal" data-target="#modal-lg-project-edit">Edit</button>
                      </td>
                      <td>
                        <button class="btnid_master_delete btn btn-danger" id="btnid_project" data-id="{{ $datas->id }}" data-toggle="modal" data-target="#modal-sm-project-delete">Delete</button>
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
      <div class="modal fade" id="modal-lg-project-add">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('/project-master-add') }}" method="post">
                @csrf
                <div class="form-group">
                  <label for="">Code Project</label>
                  <input type="" name="code" class="form-control" id="" required>
                </div>
                <div class="form-group">
                  <label for="">Nama Project</label>
                  <input type="" name="name" class="form-control" id="" required>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Edit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-lg-project-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/project-master-edit') }}" method="post">
                @csrf
                <input type="" name="id" id="id" hidden>
                <button type="submit" class="btn btn-success">Edit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-sm-project-delete">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data ?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/project-master-delete') }}" method="post">
                @csrf
                <input type="" name="id" id="id" hidden>
                <button type="submit" class="btn btn-success">Hapus</button>
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