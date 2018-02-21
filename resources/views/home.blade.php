@extends('layouts.master')

@section('title')
@parent
 | Beranda
@stop

@section('judul')
    <section class="content-header">
      <h1>
        Beranda
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      </ol>
    </section>
@endsection

@section('konten')

<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>150</h3>

              <p>Siswa</p>
            </div>
            <div class="icon">
              <i class="ion ion-happy-outline"></i>
            </div>
            <a href="#" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3>3</h3>

              <p>Kelas</p>
            </div>
            <div class="icon">
              <i class="ion ion-cube"></i>
            </div>
            <a href="#" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>44</h3>

              <p>Ijazah Telah dibagikan</p>
            </div>
            <div class="icon">
              <i class="ion ion-university"></i>
            </div>
            <a href="#" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3>65</h3>

              <p>Ijazah Tertahan</p>
            </div>
            <div class="icon">
              <i class="ion ion-soup-can-outline"></i>
            </div>
            <a href="#" class="small-box-footer">Detail <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>

<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title">Nilai Per Kelas <small>{{date('Y')}}</small></h3>

              <!-- <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div> -->

            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
                <table class="table no-margin">
                  <thead>
                  <tr>
                    <th>Kelas</th>
                    <th>Jumlah Siswa</th>
                    <th>Nilai Masuk</th>
                    <th>Persentase</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr>
                    <td><a href="pages/examples/invoice.html">VI A</a></td>
                    <td>25</td>
                    <td><span class="label label-success">25</span></td>
                    <td>
                      <div class="progress progress-sm active">
		                <div class="progress-bar progress-bar-success progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
		                  <span class="sr-only">100%</span> <sup><b style="font-size:16px">100%</b></sup>
		                </div>
		              </div>
                    </td>
                  </tr>
                  <tr>
                    <td><a href="pages/examples/invoice.html">VI B</a></td>
                    <td>25</td>
                    <td><span class="label label-warning">20</span></td>
                    <td>
                      <div class="progress progress-sm active">
		                <div class="progress-bar progress-bar-warning progress-bar-striped" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
		                  <span class="sr-only">80%</span> <sup><b style="font-size:16px">80%</b></sup>
		                </div>
		              </div>
                    </td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
              <!-- <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Place New Order</a>
              <a href="javascript:void(0)" class="btn btn-sm btn-default btn-flat pull-right">View All Orders</a> -->
            </div>
            <!-- /.box-footer -->
          </div>
@endsection

@section('script')

@endsection