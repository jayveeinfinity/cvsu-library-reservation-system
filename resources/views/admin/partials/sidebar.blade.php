<style>
  /** 
  * AUTHOR: JVJB
  * DATE: 03/25/2024
  * THIS WILL MAKE SURE THAT THE SEARCH RESULT KEYWORD WILL MAKE DARKER COLOR
  */
  .sidebar-search-results > .list-group > .list-group-item > .search-title > .text-light {
    color: #343a40 !important;
  }
</style>
<aside class="main-sidebar sidebar-light-success elevation-1">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
      <img src="/images/CvSU-logo-64x64.webp" alt="CvSU Logo" class="brand-image" style="opacity: .8">
      <span class="brand-text font-weight-light">Reservation System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ $googleUserInfo->picture }}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ $googleUserInfo->name }}</a>
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
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-compact nav-collapse-hide-child text-sm" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('admin.dashboard') }}" class="nav-link bg-gradient-success active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
                <!-- <span class="right badge badge-danger">New</span> -->
              </p>
            </a>
          </li>  
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{ route('admin.reservations.index') }}" class="nav-link">
              <i class="nav-icon fas fa-list"></i>
              <p>
                Reservations
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>
                Learning Spaces
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-secret"></i>
              <p>
                Roles
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-info-circle"></i>
              <p>
               About
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('landing') }}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt"></i>
              <p>
               Exit dashboard
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<script type="text/javascript">
  // SIDEBAR SCRIPT
  const url = window.location.href;
  const defaultTab = "dashboard";
  console.log(url);
  LinkClickHandler(url);

  function LinkClickHandler(url) {
    let x = url.indexOf('?');
    let query = x >= 0 ? url.substring(x + 1) : null;
    if (query) {
      let urlCategory = query.split("&");
      if(urlCategory.length > 0) {
        for(let i = 0; i < urlCategory.length; i++) {
          let item = urlCategory[i].split("=");
          if(item[0] != "" && item[1] != "") {
              switch(item[0]) {
                  case "view":
                      switch(item[1]) {
                          case 'libraries':
                          case 'users':
                          case 'accessmanagement':
                              document.querySelector('[data-treecollapsed="controlcenter"]').classList.add('menu-open');
                              document.querySelector('[data-treecollapsed="controlcenter"]').classList.add('menu-is-opening');
                              document.querySelector('[data-treestate="controlcenter"]').classList.add('bg-gradient-success');
                              document.querySelector('[data-treestate="controlcenter"]').classList.add('active');
                              document.querySelector('[data-state="' + item[1] + '"]').classList.add('active');
                              break;
                          case 'landing':
                          case 'libspace':
                          case 'ebooks':
                          case 'ejournals':
                          case 'thesesmanagementsystem':
                          case 'quicklog':
                          case 'bspkrn':
                              document.querySelector('[data-treecollapsed="integratedlibrarysystem"]').classList.add('menu-open');
                              document.querySelector('[data-treecollapsed="integratedlibrarysystem"]').classList.add('menu-is-opening');
                              document.querySelector('[data-treestate="integratedlibrarysystem"]').classList.add('bg-gradient-success');
                              document.querySelector('[data-treestate="integratedlibrarysystem"]').classList.add('active');
                              document.querySelector('[data-state="' + item[1] + '"]').classList.add('active');
                              break;
                          case 'tools':
                              document.querySelector('[data-treecollapsed="controlcenter"]').classList.add('menu-open');
                              document.querySelector('[data-treecollapsed="controlcenter"]').classList.add('menu-is-opening');
                              document.querySelector('[data-treestate="controlcenter"]').classList.add('bg-gradient-success');
                              document.querySelector('[data-treestate="controlcenter"]').classList.add('active');
                              document.querySelector('[data-treecollapsed="' + item[1] + '"]').classList.add('menu-open');
                              document.querySelector('[data-treecollapsed="' + item[1] + '"]').classList.add('menu-is-opening');
                              document.querySelector('[data-treestate="' + item[1] + '"]').classList.add('bg-gradient-success');
                              document.querySelector('[data-treestate="' + item[1] + '"]').classList.add('active');
                              document.querySelector('[data-treestate="' + item[1] + '"]').classList.add('text-white');
                              break;
                          case 'system':
                              document.querySelector('[data-treecollapsed="controlcenter"]').classList.add('menu-open');
                              document.querySelector('[data-treecollapsed="controlcenter"]').classList.add('menu-is-opening');
                              document.querySelector('[data-treestate="controlcenter"]').classList.add('bg-gradient-success');
                              document.querySelector('[data-treestate="controlcenter"]').classList.add('active');
                              document.querySelector('[data-treecollapsed="' + item[1] + '"]').classList.add('menu-open');
                              document.querySelector('[data-treecollapsed="' + item[1] + '"]').classList.add('menu-is-opening');
                              document.querySelector('[data-treestate="' + item[1] + '"]').classList.add('bg-gradient-success');
                              document.querySelector('[data-treestate="' + item[1] + '"]').classList.add('active');
                              document.querySelector('[data-treestate="' + item[1] + '"]').classList.add('text-white');
                              break;
                          default:
                              document.querySelector('[data-treecollapsed="' + item[1] + '"]').classList.add('menu-open');
                              document.querySelector('[data-treecollapsed="' + item[1] + '"]').classList.add('menu-is-opening');
                              document.querySelector('[data-treestate="' + item[1] + '"]').classList.add('bg-gradient-success');
                              document.querySelector('[data-treestate="' + item[1] + '"]').classList.add('active');
                              break;
                      }
                      break;
                  case "tab":
                      if(item[1] != 'dashboard') {
                          document.querySelector('[data-state="' + item[1] + '"]').classList.add('active');
                      }
                      break;
              }
          }
        }
      }
    } else {
      document.querySelector('[data-treestate="' + defaultTab + '"]').classList.add('bg-gradient-success');
      document.querySelector('[data-treestate="' + defaultTab + '"]').classList.add('active');
    }
  }
</script>