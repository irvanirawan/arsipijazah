@extends('layouts.master')

@section('title')
@parent
 | Kelas {{$data->nama_kelas}}
@stop

@section('judul')
    <section class="content-header">
      <h1>
        Kelas <small>Detail</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{route('kls')}}"><i class="fa fa-dashboard"></i>Home</a></li>
        <li>Detail</li>
      </ol>
    </section>
@endsection

@section('konten')

@if(Session::has('tambahsiswa'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Sukses !</h4>
      {{ Session::get('tambahsiswa') }}
</div>
@endif
@if(Session::has('hapussiswa'))
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('hapussiswa') }}
</div>
@endif
@if(Session::has('klssiswaupdate'))
<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('klssiswaupdate') }}
</div>
@endif
<div class="row">
  <div class="col-sm-6">
<div class="box">
            <div class="box-header">
              <h3 class="box-title">Detail</h3>
              <div class="pull-right">
                
              </div>
            </div>
			 <!-- /.box-header -->
            <div class="box-body">

              <table class="table table-bordered">
                <tbody>
                <tr>
                  <th>Kelas</th>
                  <td>{{$data->nama_kelas}}</td>
                </tr>
                <tr>
                  <th>Tahun Ajaran</th>
                  <td>{{$data->nama}}</td>
                </tr>
                <tr>
                  <th>Wali Kelas</th>
                  <td>{{$data->name}}<code>{{$data->nip}}</code></td>
                </tr>
              </tbody>
            </table>

            </div>
            <!-- /.box-body -->
</div>
</div>
</div>


<div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Siswa Kelas <code>{{$data->nama}}</code></h3>
              <div class="pull-right">
                <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="buat()">
                  <i class="fa fa-plus"></i> 
                  Tambah Siswa
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
                  <th>Jenis Kelamin</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
@foreach($data2 as $key => $d)
                <tr>
                  <td>{{$d->nama}}</td>
                  <td>{{$d->nis}}</td>
                  <td>{{$d->jenis_kelamin}}</td>
                  <td>
                    <a href="/kelas/deletesiswa/{{ $d->idnilai }}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Mengeluarkan {{$d->nama}} dari kelas {{$data->nama_kelas}}?')" title="Mengeluarkan siswa dari daftar">Keluar</a>
                  </td>
                </tr>
@endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Jenis Kelamin</th>
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
       
      <form action="" method="POST" id="myForm">     
	{{csrf_field()}}
                <input type="hidden" id="id" name="id" value='{{$data->idkelas}}'>                

              <div class="form-group">
                <label>Siswa:</label>
                <select class="form-control" id="field2" name="field2" required>
                		<option value="">-Pilih-</option>
            		@foreach($data3 as $keysiswa => $siswa)
            			<option value="{{$siswa->id}}">{{$siswa->nama}}</option>
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
  document.getElementById('judul').innerHTML = "Form ";
  document.getElementById("myForm").action = "";
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
      document.getElementById('judul').innerHTML = "Form Tambah Siswa Untuk Kelas {{$data->nama_kelas}}";
      document.getElementById("myForm").action = "{{route('tambahsiswa')}}";
      
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