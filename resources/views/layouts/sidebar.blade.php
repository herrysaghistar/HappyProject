  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ url('/') }}" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard</p>
            </a>
          </li>
          @can('admin')
          <li class="nav-item">
            <a href="{{ url('admin') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Perizinan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('spv') }}" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Data Master Perizinan
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('spv') }}" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Data Master Lokasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('spv') }}" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Data Master Project
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('spv') }}" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                User Setting
              </p>
            </a>
          </li>
          @endcan
          @can('hse')
          <li class="nav-item">
            <a href="{{ url('hse') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Perizinan
              </p>
            </a>
          </li>
          @endcan
          @can('kabeng')
          <li class="nav-item">
            <a href="{{ url('kabeng') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Perizinan
              </p>
            </a>
          </li>
          @endcan
          @can('kapro')
          <li class="nav-item">
            <a href="{{ url('kapro') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Perizinan
              </p>
            </a>
          </li>
          @endcan
          @can('spv')
          <li class="nav-item">
            <a href="{{ url('spv') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Perizinan
              </p>
            </a>
          </li>
          @endcan
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>