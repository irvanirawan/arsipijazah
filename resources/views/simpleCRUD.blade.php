@extends('layouts.master')
@section('title')
@parent
| Tahun Ajaran
@stop
@section('judul')
<section class="content-header">
  <h1>
  Tahun Ajaran
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
  </ol>
</section>
@endsection
@section('konten')
<div class="box">
  <div class="box-header">
    <h3 class="box-title">Data Tahun Ajaran</h3>
    <div class="pull-right">
      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">
      <i class="fa fa-plus"></i>
      Tambah Data
      </button>
    </div>
  </div>
  <!-- /.box-header -->
  <div class="box-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>Rendering engine</th>
          <th>Browser</th>
          <th>Platform(s)</th>
          <th>Engine version</th>
          <th>CSS grade</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Trident</td>
          <td>Internet
            Explorer 4.0
          </td>
          <td>Win 95+</td>
          <td> 4</td>
          <td>X</td>
        </tr>
        <tr>
          <td>Trident</td>
          <td>Internet
            Explorer 5.0
          </td>
          <td>Win 95+</td>
          <td>5</td>
          <td>C</td>
        </tr>
        <tr>
          <td>Trident</td>
          <td>Internet
            Explorer 5.5
          </td>
          <td>Win 95+</td>
          <td>5.5</td>
          <td>A</td>
        </tr>
        <tr>
          <td>Misc</td>
          <td>PSP browser</td>
          <td>PSP</td>
          <td>-</td>
          <td>C</td>
        </tr>
        <tr>
          <td>Other browsers</td>
          <td>All others</td>
          <td>-</td>
          <td>-</td>
          <td>U</td>
        </tr>
      </tbody>
      <tfoot>
      <tr>
        <th>Rendering engine</th>
        <th>Browser</th>
        <th>Platform(s)</th>
        <th>Engine version</th>
        <th>CSS grade</th>
      </tr>
      </tfoot>
    </table>
  </div>
  <!-- /.box-body -->
</div>
@endsection
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Modal Header</h4>
      </div>
      <div class="modal-body">
        
        <form action="/action_page.php">
          
          <div class="form-group">
            <label for="email">Email address:</label>
            <input type="email" class="form-control" id="email">
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="pwd">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@section('script')
<script>
$(function () {
$('#example1').DataTable()
$('#example2').DataTable({
'paging'      : true,
'lengthChange': false,
'searching'   : false,
'ordering'    : true,
'info'        : true,
'autoWidth'   : false
})
})
</script>
@endsection