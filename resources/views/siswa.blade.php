@extends('layouts.master')

@section('title')
@parent
 | Siswa
@stop

@section('judul')
    <section class="content-header">
      <h1>
        Siswa
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      </ol>
    </section>
@endsection

@section('konten')

@if(Session::has('siswasimpan'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Sukses !</h4>
      {{ Session::get('siswasimpan') }}
</div>
@endif
@if(Session::has('siswahapus'))
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('siswahapus') }}
</div>
@endif
@if(Session::has('siswaupdate'))
<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('siswaupdate') }}
</div>
@endif

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Siswa</h3>
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
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Agama</th>
                  <th>Alamat</th>
                  <th>Nama Ortu</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
@foreach($data as $key => $d)
                <tr>
                  <td>{{$d->nama}}</td>
                  <td>{{$d->nis}}</td>
                  <td>{{$d->tempat_lahir}}</td>
                  <td>{{$d->tanggal_lahir}}</td>
                  <td>{{$d->jenis_kelamin}}</td>
                  <td>{{$d->agama}}</td>
                  <td>{{$d->alamat}}</td>
                  <td>{{$d->nama_ortu}}</td>
                  <td>
                    <button type="button" class="btn btn-warning btn-xs" onclick="edit({{$d->id}})"  data-toggle="modal" data-target="#myModal">Edit</button> || 
                    <a href="/siswa/delete/{{ $d->id }}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus?')">Hapus</a>
                  </td>
                </tr>
@endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Tempat Lahir</th>
                  <th>Tanggal Lahir</th>
                  <th>Jenis Kelamin</th>
                  <th>Agama</th>
                  <th>Alamat</th>
                  <th>Nama Ortu</th>
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
       
      <form action="{{route('savesiswa')}}" method="POST" id="myForm">     
{{csrf_field()}}
              <div class="form-group">
                <label>Nama Siswa:</label>
                <input type="hidden" id="id" name="id">
                <input type="text" class="form-control" id="field1" name="field1" required>
              </div>

              <div class="form-group">
                <label>Nomor Induk Siswa:</label>
                <input type="text" class="form-control" id="field2" name="field2" required>
              </div>

              <div class="form-group">
                <label>Tempat Lahir:</label>
                <input type="text" class="form-control" id="field3" name="field3" required>
              </div>

              <div class="form-group">
                <label>Tanggal Lahir:</label>
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="field4" name="field4" required>
                </div>
              </div>

              <div class="form-group">
                <label>Jenis Kelamin:</label>
                <select class="form-control" id="field5" name="field5" required>
                		<option value="">-Pilih-</option>
                		<option value="Laki-Laki">Laki-Laki</option>
                		<option value="Perempuan">Perempuan</option>
                </select>	
              </div>

              <div class="form-group">
                <label>Agama:</label>
                <input type="text" class="form-control" id="field6" name="field6" required>
              </div>

              <div class="form-group">
                <label>Alamat:</label>
                <input type="text" class="form-control" id="field7" name="field7" required>
              </div>

              <div class="form-group">
                <label>Nama Wali Siswa:</label>
                <input type="text" class="form-control" id="field8" name="field8" required>
              </div>            

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
  document.getElementById('judul').innerHTML = "Form Edit Data Siswa";
  document.getElementById("myForm").action = "{{route('saveeditsiswa')}}";
  var a = id;  
  $.ajax({
        url: "/siswa/put/"+a,
        type: "get",
        success: function(data) {
        console.log(JSON.parse(data));
        var th =  JSON.parse(data);                     
                document.getElementById('field1').value = th.nama;
                document.getElementById('field2').value = th.nis;
                document.getElementById('field3').value = th.tempat_lahir;
                document.getElementById('field4').value = th.tanggal_lahir;
                document.getElementById('field5').value = th.jenis_kelamin;
                document.getElementById('field6').value = th.agama;
                document.getElementById('field7').value = th.alamat;
                document.getElementById('field8').value = th.nama_ortu;
                document.getElementById('id').value = th.id;
                // document.getElementById('foto').src = '/fileapprove/'+ data[0].foto ;
        }
      });
}

function buat() {
      document.getElementById('field1').value = "";
      document.getElementById('field2').value = "";
      document.getElementById('field3').value = "";
      document.getElementById('field4').value = "";
      document.getElementById('field5').value = "";
      document.getElementById('field6').value = "";
      document.getElementById('field7').value = "";
      document.getElementById('field8').value = "";
      document.getElementById('judul').innerHTML = "Form Tambah Siswa";
      document.getElementById("myForm").action = "{{route('savesiswa')}}";

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
  
	


    //Date picker
    $('#field4').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    })

  })
</script>
@endsection