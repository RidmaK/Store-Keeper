

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <input type="hidden" name="brand-image-check" id="brand-image-check" value="1">
      <img src="{{ asset('assets/img/Canmo.png') }}" alt="AdminLTE Logo" class="brand-image elevation-5" style="margin-left: 2.8rem;">
      <img src="{{ asset('assets/img/Canmo-icon.png') }}" alt="AdminLTE Logo" class="brand-image-icon img-circle elevation-5" style="display:none;margin-left:.6rem;" height="40" width="40">
      <span class="brand-text font-weight-light" style="display:none;">CANMO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="/home" class="nav-link {{ request()->segment(1) == 'home' ? 'active' : '' }} " >
                <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>

          <li class="nav-item {{ (request()->segment(1) == 'role' || request()->segment(1) == 'user') ? 'menu-open' : '' }} ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('role.index') }}" class="nav-link {{ request()->segment(1) == 'role' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Groups</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->segment(1) == 'user' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item {{ (request()->segment(1) == 'store') ? 'menu-open' : '' }}  ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Manage Store
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('store.index') }}" class="nav-link {{ request()->segment(1) == 'store' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ route('store.index') }}" class="nav-link {{ request()->segment(1) == 'store' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transactions</p>
                </a>
              </li> --}}
            </ul>
          </li>

          <li class="nav-item {{ (request()->segment(1) == 'order') ? 'menu-open' : '' }}  ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Manage Oders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('order.index') }}" class="nav-link {{ request()->segment(1) == 'order' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Oders</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{ route('order.index') }}" class="nav-link {{ request()->segment(1) == 'order' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transactions</p>
                </a>
              </li> --}}
            </ul>
          </li>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
