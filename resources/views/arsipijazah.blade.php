@extends('layouts.master')

@section('title')
@parent
 | Arsip
@stop

@section('judul')
    <section class="content-header">
      <h1>
        Dashboard Arsip Ijazah <small>Kelas @if(count($data) != 0) {{$data[0]->nama_kelas}} @endif </small>
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

@if(Session::has('arsipsimpan'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Sukses !</h4>
      {{ Session::get('arsipsimpan') }}
</div>
@endif
@if(Session::has('arsiphapus'))
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('arsiphapus') }}
</div>
@endif
@if(Session::has('arsipupdate'))
<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('arsipupdate') }}
</div>
@endif
<div class="box">
  <div class="box-body">
    <div class="pull-left">
      <h4><span class="fa fa-file"></span>&nbsp <strong>Arsip Ijazah</strong></h4><br>

    </div>
    <div class="pull-right">      
      <h4 style="margin:10;margin-bottom:0">Kelas : <strong>{{DB::table('kelas')->join('walikelas','kelas.wali_kelas','=','walikelas.id')->join('users','walikelas.user_id','=','users.id')->select('kelas.nama_kelas')->where('kelas.kode','=',$data[0]->kode)->first()->nama_kelas}}</strong></h4> &nbsp;
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
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Ijazah</th>
                  <th>Bukti Serah Terima</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
@foreach($data as $key => $n)

                <tr>              
                  <td><a href="/ijazah/siswa/{{$n->kelas}}/{{$n->siswa}}">{{$n->nama}}</a><input type="hidden" name="id[]" value="{{$n->id}}"></td>
                  <td>{{$n->nis}}<input type="hidden" name="matpel[]" value="{{$matpel}}"></td>
                  <td>@if($n->ijazah != null) <a href="{{asset('image')}}/{{$n->ijazah}}">{{$n->ijazah}}</a> @else <small class="btn-danger">ijazah Belum Di Upload</small> @endif</td> 
                  <td>@if($n->bukti != null) <a href="{{asset('image')}}/{{$n->bukti}}">{{$n->bukti}}</a> @else <small class="btn-danger">Bukti Belum Di Upload</small> @endif</td>
                  <td>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="ijazah({{$n->id}})">
                        <i class="fa fa-upload"></i> &nbsp; Upload Ijazah</button>
                      <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myModal" onclick="serahterima({{$n->id}})">
                        <i class="fa fa-upload"></i> &nbsp; Upload Serah Terima</button>
                  </td>
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
@endif
@endsection

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Form Upload <span id="title"></span></h4>
      </div>
      <div class="modal-body">       
       
      <form action="{{route('saveijazah')}}" method="POST" id="myForm" enctype="multipart/form-data">    
{{csrf_field()}}
                <input type="hidden" id="id" name="id" value="">               

              <div class="form-group">
                <label id="label"></label>
                <input type="file" class="form-control" id="file" name="file" required>
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
function ijazah(id) {
        document.getElementById("myForm").action = "{{route('uploadijazah')}}";
        document.getElementById('id').value = id;
        document.getElementById('label').innerHTML = "Foto/Scan Ijazah";
        document.getElementById('title').innerHTML = "Ijazah";
}

function serahterima(id) {
        document.getElementById("myForm").action = "{{route('uploadserahterima')}}";
        document.getElementById('id').value = id;
        document.getElementById('label').innerHTML = "Bukti Serah Terima";
        document.getElementById('title').innerHTML = "Serah Terima";
}

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