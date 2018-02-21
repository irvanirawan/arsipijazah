@extends('layouts.master')

@section('title')
@parent
 | User
@stop

@section('judul')
    <section class="content-header">
      <h1>
        User
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i>Home</a></li>
      </ol>
    </section>
@endsection

@section('konten')

@if(Session::has('usersimpan'))
<div class="alert alert-success alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Sukses !</h4>
      {{ Session::get('usersimpan') }}
</div>
@endif
@if(Session::has('userhapus'))
<div class="alert alert-warning alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('userhapus') }}
</div>
@endif
@if(Session::has('userupdate'))
<div class="alert alert-info alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      <h4><i class="icon fa fa-check"></i> Info !</h4>
      {{ Session::get('userupdate') }}
</div>
@endif

<div class="box">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
            </div>
			 <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Peran</th>
                  <th>Keterangan</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
@foreach($data as $key => $d)
	@if($d->id == Auth::User()->id)

	@else
                <tr>
                  <td>{{$d->name}}</td>
                  <td>{{$d->email}}</td>
                  <td>{{$d->display_name}}</td>
                  <td>{{$d->description}}</td>		
                  <td>
                    <button type="button" class="btn btn-warning btn-xs" onclick="edit({{$d->id}})"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i> Peran</button> || 
                    <a href="/user/delete/{{ $d->id }}" class="btn btn-danger btn-xs" onclick="return confirm('Yakin Hapus?')">Hapus</a>
                  </td>
                </tr>
    @endif
@endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Nama</th>
                  <th>Email</th>
                  <th>Peran</th>
                  <th>Keterangan</th>
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
       
      <form action="{{route('saveuser')}}" method="POST" id="myForm">     
				{{csrf_field()}}
                <input type="hidden" id="id" name="id">                

              <div class="form-group">                 
                <label>JenisPeran:</label>                 
                <select class="form-control" id="field1" name="field1" onchange="getnip(this)" required>                     
                  <option value="">-Pilih-</option> 
                  @foreach($role as $key => $r)
                  <option value="{{$r->id}}">{{$r->display_name}}</option> 
                  @endforeach
                </select>                
              </div>

              <div class="form-group" id="nip" style="display: none;">                 
                <label>NIP:</label>                 
                <input type="text" class="form-control" name="nip" required>                
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
  document.getElementById('judul').innerHTML = "Form Daftar Peran";
  document.getElementById("myForm").action = "{{route('saveedituser')}}";
  document.getElementById('id').value = id;
}
function getnip(selectObject) {
    var value = selectObject.value;
    if(value == 2 || value == 3){
      document.getElementById('nip').style.display = 'block';
    } else {
      document.getElementById('nip').style.display = 'none';
    }
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