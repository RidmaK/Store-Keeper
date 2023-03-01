

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/home" class="brand-link">
        <input type="hidden" name="brand-image-check" id="brand-image-check" value="1">
      <img src="{{ asset('assets/img/logo.png') }}" alt="AdminLTE Logo" class="brand-image" style="margin-left: 2.8rem;">
      <img src="{{ asset('assets/img/logo-icon.png') }}" alt="AdminLTE Logo" class="brand-image-icon " style="display:none;margin-left:.6rem;margin-top: -6px;" height="40" width="40">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          @can('dashboard-list')
          <li class="nav-item">
            <a href="/home" class="nav-link {{ request()->segment(1) == 'home' ? 'active' : '' }} " >
                <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          @endcan
          @canany(['user-list','role-list'])
          <li class="nav-item {{ (request()->segment(1) == 'role' || request()->segment(1) == 'user') ? 'menu-open' : '' }} ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                User Management
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('user-list')
              <li class="nav-item">
                <a href="{{ route('role.index') }}" class="nav-link {{ request()->segment(1) == 'role' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User Groups</p>
                </a>
              </li>
              @endcan
              @can('role-list')
              <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ request()->segment(1) == 'user' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>User</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
          @canany(['product-list'])
          <li class="nav-item {{ (request()->segment(1) == 'product') || (request()->segment(1) == 'category') || (request()->segment(1) == 'dealer') ? 'menu-open' : '' }}  ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>
                Manage Store
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('category-list')
              <li class="nav-item">
                <a href="{{ route('category.index') }}" class="nav-link {{ request()->segment(1) == 'category' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              @endcan
              @can('product-list')
              <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link {{ request()->segment(1) == 'product' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Products</p>
                </a>
              </li>
              @endcan
              @can('dealer-list')
              <li class="nav-item">
                <a href="{{ route('dealer.index') }}" class="nav-link {{ request()->segment(1) == 'dealer' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dealers</p>
                </a>
              </li>
              @endcan
              {{-- <li class="nav-item">
                <a href="{{ route('store.index') }}" class="nav-link {{ request()->segment(1) == 'store' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('store.index') }}" class="nav-link {{ request()->segment(1) == 'store' ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transactions</p>
                </a>
              </li> --}}
            </ul>
          </li>
          @endcan
          @canany(['order-list','today-order-list'])
          <li class="nav-item {{ (request()->segment(1) == 'order') ? 'menu-open' : '' }} {{ (request()->segment(1) == 'today-order') ? 'menu-open' : '' }}  ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Manage Oders
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('order-list')
              <li class="nav-item">
                <a href="{{ route('order.index') }}" class="nav-link {{ request()->segment(1) == 'order' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Store</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
          @canany(['order-list','today-order-list'])
          <li class="nav-item {{ (request()->segment(1) == 'delivery') ? 'menu-open' : '' }}  ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>
                Deliveries
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('order-list')
              <li class="nav-item">
                <a href="{{ route('order.in') }}" class="nav-link {{ request()->segment(2) == 'in' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>In</p>
                </a>
              </li>
              @endcan
              @can('order-list')
              <li class="nav-item">
                <a href="{{ route('order.out') }}" class="nav-link {{ request()->segment(2) == 'out' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>OUT</p>
                </a>
              </li>
              @endcan
              @can('order-list')
              <li class="nav-item">
                <a href="{{ route('order.return') }}" class="nav-link {{ request()->segment(2) == 'return' ? 'active' : '' }} ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Return</p>
                </a>
              </li>
              @endcan
            </ul>
          </li>
          @endcan
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
