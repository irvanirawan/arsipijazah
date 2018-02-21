  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('logo.png')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::User()->name}}</p>
          <!-- Status -->
          <a ><i class="fa fa-circle text-success"></i>{{date('d-m-Y')}}</a>
        </div>
      </div>

      <!-- search form (Optional) -->
      <!-- <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
        </div>
      </form> -->
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>
        <!-- Optionally, you can add icons to the links -->
        <li class="{{ Request::path() == 'home' ? 'active' : '' }}"><a href="{{route('home')}}"><i class="fa fa-home"></i> <span>Beranda</span></a></li>

@ability('superadmin,admin', 'all')        
        <li class="{{ Request::path() == 'user' ? 'active' : '' }}"><a href="{{route('user')}}"><i class="fa fa-users"></i> <span>Users</span></a></li>
        <li class="{{ Request::path() == 'tahunajaran' ? 'active' : '' }}"><a href="{{route('tahunajaran')}}"><i class="fa fa-calendar-check-o"></i> <span>Tahun Ajaran</span></a></li>
        <li class="{{ Request::path() == 'walikelas' ? 'active' : '' }}"><a href="{{route('walikelas')}}"><i class="fa fa-drivers-license-o"></i> <span>Guru</span></a></li>
        <li class="{{ Request::path() == 'kepsek' ? 'active' : '' }}"><a href="{{route('kepsek')}}"><i class="fa fa-gavel"></i> <span>Kepala Sekolah</span></a></li>
        <li class="{{ Request::path() == 'siswa' ? 'active' : '' }}"><a href="{{route('siswa')}}"><i class="fa fa-child"></i> <span>Siswa</span></a></li>
        <li class="{{ Request::path() == 'kls' ? 'active' : '' }}"><a href="{{route('kls')}}"><i class="fa fa-cubes"></i> <span>Kelas</span></a></li>
        <li class="{{ Request::path() == 'matapelajaran' ? 'active' : '' }}"><a href="{{route('matpel')}}"><i class="fa fa-cube"></i> <span>Mata Pelajaran</span></a></li>
@endability

@ability('superadmin,kepsek', 'all')
        <li class="treeview {{ Request::path() == 'nilai' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-book"></i> <span>Ijazah</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
@foreach(DB::table('kelas')->join('tahun_ajaran','kelas.tahun_ajaran','=','tahun_ajaran.id')->where('tahun_ajaran.status','=',2)->select('kelas.*')->get() as $key => $kls)
            <li><a href="{{url('ijazah')}}/{{$kls->kode}}/{{DB::table('matpel')->first()->id}}"><i class="fa fa-circle-o"></i> {{$kls->nama_kelas}}</a></li>
@endforeach
          </ul>
        </li>
@endability

@role('guru')
        <li class="treeview {{ Request::path() == 'nilai' ? 'active' : '' }}">
          <a href="#">
            <i class="fa fa-file-archive-o"></i> <span>Nilai</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
@foreach(DB::table('kelas')->where('wali_kelas','=',DB::table('walikelas')->where('user_id','=',Auth::User()->id)->first()->id)->get() as $key => $kls)
            <li><a href="{{url('nilai')}}/{{$kls->kode}}/{{DB::table('matpel')->first()->id}}"><i class="fa fa-circle-o"></i> {{$kls->nama_kelas}}</a></li>
@endforeach
          </ul>
        </li>
@endrole
        <li>
              <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                  <i class="fa fa-sign-out"></i><span>Logout</span>
              </a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
              </form>
        </li>

<!-- dropdown
        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>-</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="#">Link in level 2</a></li>
            <li><a href="#">Link in level 2</a></li>
          </ul>
        </li>
 -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>