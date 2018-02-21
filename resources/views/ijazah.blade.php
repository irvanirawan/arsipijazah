@extends('layouts.master')

@section('title')
@parent
 | Nilai
@stop

@section('judul')
    <section class="content-header">
      <h1>
        Dashboard Ijazah <small>Kelas @if(count($data) != 0) {{$data[0]->nama_kelas}} @endif </small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      </ol>
    </section>
@endsection

@section('konten')

@if(count($data) == 0)
<h4 style="text-align:center">Kelas ini Belum Memiliki Siswa !</h4>
@else

@if(Session::has('nilaisimpan'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Sukses !</h4>
      {{ Session::get('nilaisimpan') }}
</div>
@endif
@if(Session::has('nilaihapus'))
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('nilaihapus') }}
</div>
@endif
@if(Session::has('nilaiupdate'))
<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('nilaiupdate') }}
</div>
@endif
<div class="box">
  <div class="box-body">
    <div class="pull-left">
      <h4><span class="fa fa-eye"></span>&nbsp <strong>LIHAT NILAI</strong></h4><br>
@foreach(DB::table('matpel')->get() as $keym => $mt)
<a href="/ijazah/{{$data[0]->kode}}/{{$mt->id}}" class="btn btn-sm btn-info">{{$mt->matpel}}</a>
@endforeach()
    </div>
    <div class="pull-right">
      <h4 style="margin:10;margin-bottom:0;">Mata Pelajaran : <strong>{{DB::table('matpel')->where('id','=',$matpel)->first()->matpel}}</strong></h4> &nbsp;
      <h4 style="margin:10;margin-top:0">Walikelas : <strong>{{DB::table('kelas')->join('walikelas','kelas.wali_kelas','=','walikelas.id')->join('users','walikelas.user_id','=','users.id')->select('users.name')->where('kelas.kode','=',$data[0]->kode)->first()->name}}</strong></h4> &nbsp;
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
                  <th rowspan="2">Nama</th>
                  <th rowspan="2" align="right">NIS</th>
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
@foreach($data as $key => $n)

  @if(DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first() == null)
                <tr>              
                  <td>{{$n->nama}}<input type="hidden" name="id[]" value="{{$n->id}}"></td>
                  <td>{{$n->nis}}<input type="hidden" name="matpel[]" value="{{$matpel}}"></td>
                  <td>Belum Diinput</td>
                  <td>Belum Diinput</td>
                  <td>Belum Diinput</td>
                  <td>Belum Diinput</td>
                  <td>Belum Diinput</td>
                  <td>Belum Diinput</td>
                  <td>Belum Diinput</td>
                </tr>
  @else
    @php
      $k4satu = DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas4_s1;
      $k4dua = DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas4_s2;
      $k5satu = DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas5_s1;
      $k5dua = DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas5_s2;
      $k6satu = DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas6_s1;
      $uas = DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->uas;
      $rata = ($k4satu+$k4dua+$k5satu+$k5dua+$k6satu+$uas)/6;
    @endphp
                <tr>              
                  <td><a href="{{route('ijazah')}}/siswa/{{$n->kelas}}/{{$n->siswa}}">{{$n->nama}}</a><input type="hidden" name="id[]" value="{{$n->id}}"></td>
                  <td>{{$n->nis}}<input type="hidden" name="matpel[]" value="{{$matpel}}"></td>
                  <td>{{DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas4_s1}}</td>
                  <td>{{DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas4_s2}}</td>
                  <td>{{DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas5_s1}}</td>
                  <td>{{DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas5_s2}}</td>
                  <td>{{DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->nilai_kelas6_s1}}</td>
                  <td>{{DB::table('transaksi_nilai')->where('nilai','=',$n->id)->where('matpel','=',$matpel)->first()->uas}}</td>
                  <td>{{$rata}}</td>
                </tr>
  @endif

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
@endif
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
       
      <form action="" method="POST" id="myForm">     
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