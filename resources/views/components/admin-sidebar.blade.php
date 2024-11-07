<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <div class="d-flex flex-wrap">
      <li class="nav-item dropdown off-canvas-custom-buttons d-none m-1">
        <button type="button" class="btn btn-light nav-custom-button"><b>Store</b> <i
            class="mdi mdi-octagon signal-active"></i></button>
      </li>
      <li class="nav-item dropdown off-canvas-custom-buttons d-none m-1">
        <button type="button" class="btn btn-light nav-custom-button"><i
            class="mdi mdi-magnify"></i>&nbsp;Search</button>
      </li>
      <li class="nav-item dropdown off-canvas-custom-buttons d-none m-1">
        <a class="" href="{{str_replace('/public', "/", Helper::props('/'))}}" target="_blank">
          <button type="button" class="btn btn-light nav-custom-button"><i class="mdi mdi-web"></i>&nbsp;Visit
            Store</button>
        </a>
      </li>
    </div>

    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/dashboard')}}">
        <i class="mdi mdi-grid-large menu-icon"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item nav-category">My Store</li>


    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#form-elements" aria-expanded="false"
        aria-controls="form-elements">
        <i class="menu-icon mdi mdi-wrench"></i>
        <span class="menu-title">Configuration</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{url('admin/logo')}}">Logo & Color</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">Currency & Taxes</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">Store Header</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">Store Footer</a></li>
          <li class="nav-item"> <a class="nav-link" href="pages/charts/chartjs.html">Social Media</a></li>
        </ul>
      </div>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-bs-toggle="collapse" href="#form-elements-2" aria-expanded="false"
        aria-controls="form-elements">
        <i class="menu-icon mdi mdi-view-dashboard"></i>
        <span class="menu-title">Inner Sections</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="form-elements-2">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item"><a class="nav-link" href="{{url('admin/landing-section')}}">Static Sections</a></li>
          <li class="nav-item"> <a class="nav-link" href="{{url('admin/inner-sections')}}">Dynamic Sections</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item nav-category-sidebar">
      <a class="nav-link" href="{{url('admin/categories')}}">
        <i class="mdi mdi-playlist-check menu-icon"></i>
        <span class="menu-title">Categories & Collections</span>
      </a>
    </li>
    <li class="nav-item nav-category-label">
      <a class="nav-link" href="{{url('admin/labels')}}">
        <i class="mdi mdi-more menu-icon"></i>
        <span class="menu-title">Inventory Pages</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/offers')}}">
        <i class="mdi mdi-tag-multiple menu-icon"></i>
        <span class="menu-title">Discounts</span>
      </a>
    </li>
    <li class="nav-item nav-category-inventory">
      <a class="nav-link" href="{{url('admin/inventory')}}">
        <i class="mdi mdi-briefcase-check menu-icon"></i>
        <span class="menu-title">Manage Inventory</span>
      </a>
    </li>

    <li class="nav-item nav-category">Operations</li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/queries')}}">
        <i class="mdi mdi-format-float-left menu-icon"></i>
        <span class="menu-title">Customer Queries</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="">
        <i class="mdi mdi-face-agent menu-icon"></i>
        <span class="menu-title">Support Tickets</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="{{url('admin/directory')}}">
        <i class="mdi mdi-notebook menu-icon"></i>
        <span class="menu-title">Directory</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="">
        <i class="mdi mdi-border-color menu-icon"></i>
        <span class="menu-title">Orders</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="">
        <i class="mdi mdi-alpha-c-box menu-icon"></i>
        <span class="menu-title">Campaigns</span>
      </a>
    </li>

    <li class="nav-item nav-category">My Customer Board</li>
    <li class="nav-item">
      <a class="nav-link" href="">
        <i class="mdi mdi-border-color menu-icon"></i>
        <span class="menu-title">My Orders</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="">
        <i class="mdi mdi-face-agent menu-icon"></i>
        <span class="menu-title">Support</span>
      </a>
    </li>
  </ul>
</nav>
<!-- partial -->