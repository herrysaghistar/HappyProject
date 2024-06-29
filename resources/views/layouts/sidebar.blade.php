  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <!-- <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8"> -->
      <span class="brand-text font-weight-light">PTW</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          @can('spv')
          <img src="{{ asset('/blue_helm.png') }}" class="img-circle elevation-2" alt="User Image">
          @endcan
          @can('hse')
          <img src="{{ asset('/red_helm.png') }}" class="img-circle elevation-2" alt="User Image">
          @endcan
          @can('kapro')
          <img src="{{ asset('/white_helm.png') }}" class="img-circle elevation-2" alt="User Image">
          @endcan
          @can('kabeng')
          <img src="{{ asset('/white_helm.png') }}" class="img-circle elevation-2" alt="User Image">
          @endcan
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ Auth::user()->name }}</a>
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
            <a href="{{ url('ptw-admin') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Permit To Work
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('jsa-admin') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Job Hazard Analysis
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('location-master') }}" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Data Master Lokasi
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('project-master') }}" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                Data Master Project
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('user-management') }}" class="nav-link">
              <i class="nav-icon far fa-circle"></i>
              <p>
                User Management
              </p>
            </a>
          </li>
          @endcan
          @can('hse')
          <li class="nav-item">
            <a href="{{ url('ptw-hse') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Permit To Work
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('jsa-hse') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Job Hazard Analysis
              </p>
            </a>
          </li>
          @endcan
          @can('kabeng')
          <li class="nav-item">
            <a href="{{ url('ptw-kabeng') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Permit To Work
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('jsa-kabeng') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Job Hazard Analysis
              </p>
            </a>
          </li>
          @endcan
          @can('kapro')
          <li class="nav-item">
            <a href="{{ url('ptw-kapro') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Permit To Work
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('jsa-kapro') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Job Hazard Analysis
              </p>
            </a>
          </li>
          @endcan
          @can('spv')
          <li class="nav-item">
            <a href="{{ url('ptw-spv') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Permit To Work
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ url('jsa-spv') }}" class="nav-link">
              <i class="nav-icon far fa-file"></i>
              <p>
                Job Hazard Analysis
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