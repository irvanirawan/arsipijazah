@extends('layouts.master')

@section('title')
@parent
 | Kepala Sekolah
@stop

@section('judul')
    <section class="content-header">
      <h1>
        Kepala Sekolah
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      </ol>
    </section>
@endsection

@section('konten')

@if(Session::has('kepseksimpan'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Sukses !</h4>
      {{ Session::get('kepseksimpan') }}
</div>
@endif
@if(Session::has('kepsekhapus'))
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('kepsekhapus') }}
</div>
@endif
@if(Session::has('kepsekupdate'))
<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('kepsekupdate') }}
</div>
@endif

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Kepala Sekolah</h3>
              <div class="pull-right">
                <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="buat()">
                  <i class="fa fa-plus"></i> 
                  Tambah Data
                </button> -->
              </div>
            </div>
			 <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>NIP</th>
                  <th>Email</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
@foreach($data as $key => $d)
                <tr>
                  <td>{{$d->namanya}}</td>
                  <td>{{$d->nip}}</td>
                  <td>{{$d->emailnya}}</td>
                  <td>
                    <button type="button" class="btn btn-warning btn-xs" onclick="edit({{$d->idnya}})"  data-toggle="modal" data-target="#myModal">Edit</button> || 
                    <a href="/kepsek/delete/{{ $d->idnya }}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus?')">Hapus</a>
                  </td>
                </tr>
@endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>NIP</th>
                  <th>Email</th>
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
       
      <form action="{{route('savewk')}}" method="POST" id="myForm">     
{{csrf_field()}}
              <div class="form-group">
                <label>Nama:</label>
                <input type="hidden" id="id" name="id">
                <input type="text" class="form-control" id="field1" name="field1" required>
              </div>

              <div class="form-group">
                <label>NIP:</label>
                <input type="text" class="form-control" id="field2" name="field2" required>
              </div>

              <div class="form-group">
                <label>Email:</label>
                <input type="email" class="form-control" id="field3" name="field3" required>
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
  document.getElementById('judul').innerHTML = "Form Edit Data Kepala Sekolah";
  document.getElementById("myForm").action = "{{route('saveeditkepsek')}}";
  var a = id;  
  $.ajax({
        url: "/kepsek/put/"+a,
        type: "get",
        success: function(data) {
        var th =  JSON.parse(data);        
                document.getElementById('field1').value = th.namanya;
                document.getElementById('field2').value = th.nip;
                document.getElementById('field3').value = th.emailnya;
                document.getElementById('id').value = th.idnya;
                // document.getElementById('foto').src = '/fileapprove/'+ data[0].foto ;
        }
      });
}

function buat() {
      document.getElementById('field1').value = "";
      document.getElementById('field2').value = "";
      document.getElementById('judul').innerHTML = "Form Tambah Guru";
      document.getElementById("myForm").action = "{{route('savewk')}}";

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