<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/dashboard') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/sales') }}">
          <i class="mdi mdi-home menu-icon"></i>
          <span class="menu-title">Sales</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#category-ui" aria-expanded="false" aria-controls="category-ui">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Category</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="category-ui">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/category/create') }}">Add Category</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{  url('admin/category') }}">View Category</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-bs-toggle="collapse" href="#product" aria-expanded="false" aria-controls="product">
          <i class="mdi mdi-circle-outline menu-icon"></i>
          <span class="menu-title">Products</span>
          <i class="menu-arrow"></i>
        </a>
        <div class="collapse" id="product">
          <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ url('admin/products/create') }}">Add product</a></li>
            <li class="nav-item"> <a class="nav-link" href="{{  url('admin/products') }}">View product</a></li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/brands') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Brands</span>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/users') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Users</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/sliders') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Home Slider</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{ url('admin/settings') }}">
          <i class="mdi mdi-view-headline menu-icon"></i>
          <span class="menu-title">Site Setting</span>
        </a>
      </li>


    </ul>
  </nav>
