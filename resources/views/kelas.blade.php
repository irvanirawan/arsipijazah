@extends('layouts.master')

@section('title')
@parent
 | Kelas
@stop

@section('judul')
    <section class="content-header">
      <h1>
        Kelas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      </ol>
    </section>
@endsection

@section('konten')

@if(Session::has('klssimpan'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Sukses !</h4>
      {{ Session::get('klssimpan') }}
</div>
@endif
@if(Session::has('klshapus'))
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('klshapus') }}
</div>
@endif
@if(Session::has('klsupdate'))
<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('klsupdate') }}
</div>
@endif

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kelas</h3>
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
                  <th>Kelas</th>
                  <th>Tahun Ajaran</th>
                  <th>Walikelas</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
@foreach($data as $key => $d)
                <tr>
                  <td>{{$d->nama_kelas}}</td>
                  <td>{{$d->nama}}</td>
                  <td>{{$d->name}}</td>
                  <td>
@if($d->status == 2)
<span class="fa fa-spinner fa-spin"></span> &nbsp <code>Aktiv</code>
@else
Tidak Aktif
@endif
                  </td>
                  <td>
                    <a href="/kelas/detail/{{ $d->id }}" class="btn btn-info btn-xs">Detail</a> || 
                    <button type="button" class="btn btn-warning btn-xs" onclick="edit({{$d->id}})"  data-toggle="modal" data-target="#myModal">Edit</button> || 
                    <a href="/kelas/delete/{{ $d->id }}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus?')">Hapus</a>
                  </td>
                </tr>
@endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Kelas</th>
                  <th>Tahun Ajaran</th>
                  <th>Walikelas</th>
                  <th>Status</th>
                  <th>Opsi</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>



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
       
      <form action="{{route('savekls')}}" method="POST" id="myForm">     
	{{csrf_field()}}
              <div class="form-group">
                <label>Kelas:</label>
                <input type="hidden" id="id" name="id">
                <input type="text" class="form-control" id="field1" name="field1" required>
              </div>

              <div class="form-group">
                <label>Tahun Ajaran:</label>
                <select class="form-control" id="field2" name="field2" required>
                		<option value="">-Pilih-</option>
            		@foreach($data2 as $keyth => $th)
            			<option value="{{$th->id}}">{{$th->nama}}</option>
            		@endforeach
                </select>
              </div> 

              <div class="form-group">
                <label>Wali Kelas:</label>
                <select class="form-control" id="field3" name="field3" required>
                		<option value="">-Pilih-</option>
            		@foreach($data3 as $keywk => $wk)
            			<option value="{{$wk->id}}">{{$wk->name}}</option>
            		@endforeach
                </select>
              </div>        

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-default">Submit</button>
      </div>
      </form>
    </div>

  </div>
</div>
@endsection
@section('script')
<script>
function edit(id) {
  document.getElementById('judul').innerHTML = "Form Edit Tahun Ajaran";
  document.getElementById("myForm").action = "{{route('saveeditkls')}}";
  var a = id;  
  $.ajax({
        url: "/kelas/put/"+a,
        type: "get",
        success: function(data) {
        var th =  JSON.parse(data);
                document.getElementById('id').value = th.id;
                document.getElementById('field1').value = th.nama_kelas;
                document.getElementById('field2').value = th.tahun_ajaran;
                document.getElementById('field3').value = th.wali_kelas;
                // document.getElementById('foto').src = '/fileapprove/'+ data[0].foto ;
        }
      });
}

function buat() {
                document.getElementById('field1').value = '';
                document.getElementById('field2').value = '';
                document.getElementById('field3').value = '';
      document.getElementById('judul').innerHTML = "Form Tambah Kelas";
      document.getElementById("myForm").action = "{{route('savekls')}}";

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