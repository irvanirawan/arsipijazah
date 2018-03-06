@extends('layouts.master')

@section('title')
@parent
 | Ijazah
@stop

@section('judul')
    <section class="content-header">
      <h1>
        Dashboard Ijazah <small>{{$siswa->nama}}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      </ol>
    </section>
@endsection

@section('konten')

<div class="box">
  <div class="box-body">
    <div class="pull-left">
      <h4 style="margin:10;margin-bottom:0;">Nama Siswa : <strong>{{$siswa->nama}}</strong></h4> &nbsp;
      <h4 style="margin:10;margin-top:0">NIS : <strong>{{$siswa->nis}}</strong></h4> &nbsp;
    </div>
    <div class="pull-right">
      <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="buat()">
                  <i class="fa fa-pencil"></i> 
                &nbsp; Rubah Status
      </button><br> -->
      <h4 style="margin:10;margin-bottom:0;">Status : <strong>
@if($idnilai->status == 1)
<i class="btn-info">Sudah Disalin</i>
@elseif($idnilai->status == 2)
<i class="btn-info">Sudah Diarsip</i>
@else
<i class="btn-danger">Belum Disalin</i>
@endif
      </strong></h4> &nbsp;
    </div>
  </div>
</div>
        <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Nilai</h3>
              <div class="pull-right">
                <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="buat()">
                  <i class="fa fa-plus"></i> 
                  Tambah Data
                </button> -->
              </div>
            </div>
            <form action="{{route('savenilai')}}" method="POST">
              {{csrf_field()}}
       <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-responsive table-bordered table-striped">
                <thead>
                <tr>
                  <th rowspan="2" align="right">Mata Pelajaran</th>
                  <th colspan="6" border-bottom="1px">Nilai</th>
                  <th rowspan="2">Rata-rata</th>
                </tr>
                <tr>
                  <th>IV Semester1</th>
                  <th>IV Semester2</th>
                  <th>V Semester1</th>
                  <th>V Semester2</th>
                  <th>VI Semester1</th>
                  <th>Uas</th>
                </tr>
                </thead>
                <tbody>

@foreach($arrdata as $key => $d)
                  <tr>              
                    <td>{{$d[0]}}</td>
                    <td>{{$d[1]}}</td>
                    <td>{{$d[2]}}</td>
                    <td>{{$d[3]}}</td>
                    <td>{{$d[4]}}</td>
                    <td>{{$d[5]}}</td>
                    <td>{{$d[6]}}</td>
                    <td>{{$d[7]}}</td>
                  </tr>
@endforeach
                </tbody>
                <tfoot>
                <tr>
                  
                </tr>
                </tfoot>
              </table>
            </div>
            <div class="box-footer">
<!-- <button type="submit" class="btn btn-sm btn-primary">Simpan Nilai</button> -->
            </div>
            </form>
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
        <h4 class="modal-title">Form Rubah Status</h4>
      </div>
      <div class="modal-body">       
       
      <form action="{{route('saveijazah')}}" method="POST" id="myForm" enctype="multipart/form-data">    
{{csrf_field()}}
              <div class="form-group">
                <label>Nama:</label>
                <input type="hidden" id="id" name="id" value="{{$idnilai->id}}">
                <select class="form-control" id="field2" name="field2" onchange="getbukti(this)" required>
                        <option value="">-Pilih-</option>
                        <option value="1">Sudah disalin</option>
                        <option value="2">Telah Diterima Walimurid</option>
                </select> 
              </div>

              <div class="form-group" id="nip" style="display: none;">
                <label>Bukti Serah Terima:</label>
                <input type="file" class="form-control" id="file" name="file">
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
function getbukti(selectObject) {
    var value = selectObject.value;
    if(value == 2){
      document.getElementById('nip').style.display = 'block';
    } else {
      document.getElementById('nip').style.display = 'none';
    }
}
function edit(id) {
  document.getElementById('judul').innerHTML = "Form Edit Data Kepala Sekolah";
  document.getElementById("myForm").action = "";
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
      document.getElementById("myForm").action = "";

}
</script>
@endsection