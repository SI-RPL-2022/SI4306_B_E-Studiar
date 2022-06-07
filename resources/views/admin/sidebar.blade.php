<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">Estudiar </div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider my-0">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item {{Request::is('admin') ? 'active' : '' }}">
    <a class="nav-link" href="/admin">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span>
    </a>
  </li>
  <li class="nav-item {{Request::is('admin/calon-mentor*') ? 'active' : '' }}">
    <a class="nav-link" href="/admin/calon-mentor">
      <i class="fa-solid fa-chalkboard-user"></i>
      <span>Calon Mentor</span>
    </a>
  </li>
  <li class="nav-item {{Request::is('admin/mentor*') ? 'active' : '' }}">
    <a class="nav-link" href="/admin/mentor">
      <i class="fa-solid fa-chalkboard-user"></i>
      <span>Data Mentor</span>
    </a>
  </li>
  <li class="nav-item {{Request::is('admin/pembayaran*') ? 'active' : '' }}">
    <a class="nav-link" href="/admin/pembayaran">
      <i class="fa-solid fa-chalkboard-user"></i>
      <span>Data Pembayaran</span>
    </a>
  </li>

  {{--
  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Heading -->
  <div class="sidebar-heading">
    Interface
  </div>
  </li> --}}

  <!-- Nav Item - Pages Collapse Menu -->
  {{-- <li class="nav-item">
    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
      aria-controls="collapseTwo">
      <i class="fas fa-fw fa-cog"></i>
      <span>Components</span>
    </a>
    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
      <div class="bg-white py-2 collapse-inner rounded">
        <h6 class="collapse-header">Custom Components:</h6>
        <a class="collapse-item" href="buttons.html">Buttons</a>
        <a class="collapse-item" href="cards.html">Cards</a>
      </div>
    </div>
  </li> --}}


  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>