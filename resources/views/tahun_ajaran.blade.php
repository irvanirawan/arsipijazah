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

@if(Session::has('thsimpan'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Sukses !</h4>
      {{ Session::get('thsimpan') }}
</div>
@endif
@if(Session::has('thhapus'))
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('thhapus') }}
</div>
@endif
@if(Session::has('thupdate'))
<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('thupdate') }}
</div>
@endif

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Tahun Ajaran</h3>
              <div class="pull-right">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="buat()">
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
                  <th>Tahun Ajaran</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
@foreach($data as $key => $d)
                <tr>
                  <td>{{$d->nama}}</td>
                  <td>
@if($d->status == 2)
    <span class="fa fa-spinner fa-spin"></span> &nbsp <code>Aktiv</code>
@endif
                  </td>
                  <td>
@if($d->status == 1)
                    <a href="{{route('tahunajaran')}}/{{$d->id}}" class="btn btn-xs btn-info">Aktivkan</a> ||
@endif
                    <button type="button" class="btn btn-warning btn-xs" onclick="edit({{$d->id}})"  data-toggle="modal" data-target="#myModal">Edit</button> 
@if($d->status == 1)
                    || 
                    <a href="/tahunajaran/delete/{{ $d->id }}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus?')">Hapus</a>
@endif
                  </td>
                </tr>
@endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Tahun Ajaran</th>
                  <th>Status</th>
                  <th>Opsi</th>
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
        <h4 class="modal-title"><span id="judul"></span></h4>
      </div>
      <div class="modal-body">       
       
      <form action="{{route('saveth')}}" method="POST" id="myForm">     
{{csrf_field()}}
              <div class="form-group">
                <label for="email">Tahun Ajaran:</label>
                <input type="hidden" id="id" name="id">
                <input type="text" class="form-control" id="th" name="nama" required>
              </div>

              <!-- <div class="form-group">
                <label for="pwd">Password:</label>
                <input type="password" class="form-control" id="pwd">
              </div>  -->           

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>

@section('script')
<script>
function edit(id) {
  document.getElementById('judul').innerHTML = "Form Edit Tahun Ajaran";
  document.getElementById("myForm").action = "{{route('saveeditth')}}";
  var a = id;  
  $.ajax({
        url: "/tahunajaran/put/"+a,
        type: "get",
        success: function(data) {
        console.log(JSON.parse(data));
        var th =  JSON.parse(data);                     
                document.getElementById('th').value = th.nama;
                document.getElementById('id').value = th.id;
                // document.getElementById('foto').src = '/fileapprove/'+ data[0].foto ;
        }
      });
}

function buat() {
      document.getElementById('th').value = "";
      document.getElementById('judul').innerHTML = "Form Tambah Tahun Ajaran";
      document.getElementById("myForm").action = "{{route('saveth')}}";

}

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