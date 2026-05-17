@php
  $profileName = auth()->user()->name ?? 'Admin';
  $isActive = fn ($pattern) => request()->is($pattern) ? 'active' : '';
@endphp

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas text-white border-0 p-3 p-lg-4 sb-admin-sidebar" id="sidebar">
  <button class="btn btn-outline-light d-lg-none position-absolute top-0 end-0 m-4 sb-sidebar-close" type="button" data-sidebar-close aria-label="Close menu">
    <i class="bi bi-x"></i>
  </button>

  <a class="d-block mb-4 mt-5 mt-lg-0" href="{{url('admin/dashboard')}}">
    <img class="img-fluid" src="{{Helper::props('admin/images/logo.png')}}" alt="Singh Brothers Frames">
  </a>

  <div class="background-secondary rounded-2 p-3 mb-4 sb-sidebar-profile">
    <h2 class="h4 text-dark fw-bold mb-3 text-center">{{$profileName}}</h2>
    <div class="dropdown">
      <button class="btn btn-outline-dark w-100 d-flex align-items-center justify-content-center gap-2 fw-bold" type="button" id="sidebarProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        More Options <i class="mdi mdi-chevron-down"></i>
      </button>
      <div class="dropdown-menu w-100 shadow border-0" aria-labelledby="sidebarProfileDropdown">
        <a class="dropdown-item" href="{{url('/admin/my-profile')}}">My Profile</a>
        <a class="dropdown-item" href="{{url('/admin/add-user')}}">Add New User</a>
        <form action="{{route('logout')}}" method="post">
          @csrf
          <button class="dropdown-item" type="submit">Sign Out</button>
        </form>
      </div>
    </div>
  </div>

<ul class="nav flex-column gap-1 sb-sidebar-nav">
  <li class="nav-item text-uppercase small text-secondary mt-3 px-2">My Dashboard</li>

  <li class="nav-item {{$isActive('admin/dashboard')}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{$isActive('admin/dashboard') ? 'bg-dark' : ''}}" href="{{url('admin/dashboard')}}">
      <i class="bi bi-speedometer2 color-secondary"></i>
      <span class="menu-title">Dashboard</span>
    </a>
  </li>

  <li class="nav-item {{$isActive('admin/add-user') ? 'active' : ''}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{($isActive('admin/add-user') ) ? 'bg-dark' : ''}}" href="{{url('admin/add-user')}}">
      <i class="bi bi-person color-secondary"></i>
      <span class="menu-title">System users</span>
    </a>
  </li>

    <li class="nav-item {{$isActive('admin/queries')}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{$isActive('admin/queries') ? 'bg-dark' : ''}}" href="{{url('admin/queries')}}">
      <i class="bi bi-person-plus color-secondary"></i>
      <span class="menu-title">Customer Queries</span>
    </a>
  </li>

  <li class="nav-item {{$isActive('admin/directory')}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{$isActive('admin/directory') ? 'bg-dark' : ''}}" href="{{url('admin/directory')}}">
      <i class="bi bi-people color-secondary"></i>
      <span class="menu-title">Directory</span>
    </a>
  </li>

  <li class="nav-item {{$isActive('admin/all-activity')}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{$isActive('admin/all-activity') ? 'bg-dark' : ''}}" href="{{url('/admin/all-activity')}}">
      <i class="bi bi-clock color-secondary"></i>
      <span class="menu-title">Activity Tracker</span>
    </a>
  </li>

  <li class="nav-item text-uppercase small text-secondary mt-4 px-2">My Store</li>

  <li class="nav-item {{request()->is('admin/inner-sections') ? 'active' : ''}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{(request()->is('admin/inner-sections')) ? 'bg-dark' : ''}}" href="{{ url('admin/inner-sections') }}">
      <i class="bi bi-layout-text-window-reverse color-secondary"></i>
      <span class="menu-title">Product Sections</span>
    </a>
  </li>

  <li class="nav-item {{request()->is('admin/categories') || request()->is('admin/collections/*') ? 'active' : ''}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{(request()->is('admin/categories') || request()->is('admin/collections/*')) ? 'bg-dark' : ''}}" href="{{url('admin/categories')}}">
      <i class="bi bi-list-check color-secondary"></i>
      <span class="menu-title">Categories & Collections</span>
    </a>
  </li>

  <li class="nav-item {{$isActive('admin/labels')}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{$isActive('admin/labels') ? 'bg-dark' : ''}}" href="{{url('admin/labels')}}">
      <i class="bi bi-tags color-secondary"></i>
      <span class="menu-title">Inventory Pages</span>
    </a>
  </li>

  <li class="nav-item {{request()->is('admin/inventory') || request()->is('admin/add-inventory') || request()->is('admin/edit-inventory/*') || request()->is('admin/view-inventory/*') ? 'active' : ''}}">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold {{(request()->is('admin/inventory') || request()->is('admin/add-inventory') || request()->is('admin/edit-inventory/*') || request()->is('admin/view-inventory/*')) ? 'bg-dark' : ''}}" href="{{url('admin/inventory')}}">
      <i class="bi bi-box-seam color-secondary"></i>
      <span class="menu-title">Manage Inventory</span>
    </a>
  </li>

  <li class="nav-item text-uppercase small text-secondary mt-4 px-2">External Link</li>

  <li class="nav-item">
    <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fw-semibold" href="{{str_replace('/public', '/', Helper::props('/'))}}" target="_blank">
      <i class="bi bi-box-arrow-up-right color-secondary"></i>
      <span class="menu-title">Visit website</span>
    </a>
  </li>
</ul>
</nav>
<div class="sb-sidebar-backdrop d-lg-none" data-sidebar-close></div>
<!-- partial -->
