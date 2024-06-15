@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User</h1>
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
                <h3 class="card-title">Data User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="col-2">
                  <button type="submit" class="btn btn-outline-success" data-toggle="modal" data-target="#modal-lg-user-add">User Baru</button>
                </div>
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>User</th>
                      <th>Email</th>
                      <th>Role</th>
                      <th>Edit</th>
                      <th>Delete</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($data as $datas)
                    <tr>
                      <td>{{ $datas->name }}</td>
                      <td>{{ $datas->email }}</td>
                      <td>
                        @foreach($datas->roles as $role)
                          {{ $role->name }}@if(!$loop->last), @endif
                        @endforeach
                      </td>
                      <td>
                        <button class="btnid_master_edit btn btn-outline-primary" id="btnid_user" data-id="{{ $datas->id }}" data-toggle="modal" data-target="#modal-lg-user-edit">Edit</button>
                      </td>
                      <td>
                        <button class="btnid_master_delete btn btn-danger" id="btnid_user" data-id="{{ $datas->id }}" data-toggle="modal" data-target="#modal-sm-user-delete">Delete</button>
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
      <div class="modal fade" id="modal-lg-user-add">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ url('/user-management-add') }}" method="post">
                @csrf
                  <div class="form-group">
                    <label for="manpower_qty">Nama User</label>
                    <input type="" name="name" class="form-control" id="Name" required>
                  </div>
                  <div class="form-group">
                    <label for="manpower_qty">Email</label>
                    <input type="email" name="email" class="form-control" id="Name" required>
                  </div>
                  <div class="form-group">
                    <label for="manpower_qty">Password</label>
                    <input type="password" name="password" class="form-control" id="Name" required>
                  </div>
                  <div class="form-group">
                    <label for="">Role</label>
                    <select class="form-control" name="role" id="">
                      @foreach($roles as $role)
                          <option value="{{ $role }}">{{ $role }}</option>
                      @endforeach
                    </select>
                  </div>
                </div>
                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-success">Add</button>
                </div>
              </form>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-lg-user-edit">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Data</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/user-management-edit') }}" method="post">
                @csrf
                <input type="" name="id" id="id" hidden>
                <button type="submit" class="btn btn-success">Edit</button>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="modal fade" id="modal-sm-user-delete">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data ?</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-footer justify-content-between">
              <form action="{{ url('/user-management-delete') }}" method="post">
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