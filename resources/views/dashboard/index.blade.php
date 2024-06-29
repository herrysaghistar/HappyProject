@extends('layouts.app')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $document_count['ptw'] }}</h3>

                <p>Jumlah PTW Form</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              @can('spv')
              <a href="{{ url('ptw-spv') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('hse')
              <a href="{{ url('ptw-hse') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('kabeng')
              <a href="{{ url('ptw-kabeng') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('kapro')
              <a href="{{ url('ptw-kapro') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('admin')
              <a href="{{ url('ptw-admin') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $document_count['ptw_undone'] }}</h3>

                <p>PTW Belum Approved</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              @can('spv')
              <a href="{{ url('ptw-spv') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('hse')
              <a href="{{ url('ptw-hse') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('kabeng')
              <a href="{{ url('ptw-kabeng') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('kapro')
              <a href="{{ url('ptw-kapro') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('admin')
              <a href="{{ url('ptw-admin') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{ $document_count['jsa'] }}</h3>

                <p>Jumlah JHA</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              @can('spv')
              <a href="{{ url('jsa-spv') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('hse')
              <a href="{{ url('jsa-hse') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('kabeng')
              <a href="{{ url('jsa-kabeng') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('kapro')
              <a href="{{ url('jsa-kapro') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('admin')
              <a href="{{ url('jsa-admin') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{ $document_count['jsa_undone'] }}</h3>

                <p>JHA Belum Disetujui</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              @can('spv')
              <a href="{{ url('jsa-spv') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('hse')
              <a href="{{ url('jsa-hse') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('kabeng')
              <a href="{{ url('jsa-kabeng') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('kapro')
              <a href="{{ url('jsa-kapro') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @elsecan('admin')
              <a href="{{ url('jsa-admin') }}" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
              @endcan
            </div>
          </div>
          <!-- ./col -->
        </div>
        
        <div class="row">
            <div class="col-6">
              <div class="card card-info">
                <div class="card-header">
                  <h3 class="card-title">Pie Chart</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                      <i class="fas fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="pieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
                <!-- /.card-body -->
              </div>
            </div>
        </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection

@section('chart')
<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        // Get the context of the canvas element we want to select
        var ctx = document.getElementById('pieChart').getContext('2d');
        // Data for Pie Chart
        var documentCount = @json($document_count);
        var dataValues = Object.values(documentCount);
        var data = {
            labels: [
              'PTW', 'PTW Belum Approve', 'JHA', 'JHA Belum Approve'
              ],
            datasets: [{
                data: dataValues,
                backgroundColor: ['#ff9999','#66b3ff','#99ff99','#ffcc99']
            }]
        };
        // Options for Pie Chart
        var options = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
                position: 'right',
            }
        };
        // Create Pie Chart
        var pieChart = new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    });
</script>
@endsection