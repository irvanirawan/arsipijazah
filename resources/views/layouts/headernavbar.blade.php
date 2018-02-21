<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" title="Tahun Ajaran Aktif">
              <!-- <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span> -->
              <span class="fa fa-spinner fa-spin"></span> &nbsp <code>{{DB::table('tahun_ajaran')->where('status','=',2)->first()->nama}}</code>
            </a>
          </li>
          

        </ul>
      </div>