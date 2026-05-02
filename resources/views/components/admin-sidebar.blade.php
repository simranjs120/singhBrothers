@php
  $profileName = auth()->user()->name ?? 'Admin';
  $isActive = fn ($pattern) => request()->is($pattern) ? 'active' : '';
@endphp

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas text-white border-0 p-3 p-lg-4 sb-admin-sidebar" id="sidebar">
  <button class="btn btn-outline-light d-lg-none position-absolute top-0 end-0 m-4 sb-sidebar-close" type="button" data-sidebar-close aria-label="Close menu">
    <i class="mdi mdi-close"></i>
  </button>

  <a class="d-block mb-4 mt-5 mt-lg-0" href="{{url('admin/dashboard')}}">
    <img class="img-fluid" src="{{Helper::props('admin/images/logo.png')}}" alt="Singh Brothers Frames">
  </a>

  <div class="bg-primary rounded-2 p-3 mb-4 sb-sidebar-profile">
    <h2 class="h4 text-white fw-bold mb-3">{{$profileName}}</h2>
    <div class="dropdown">
      <button class="btn btn-outline-light w-100 d-flex align-items-center justify-content-center gap-2" type="button" id="sidebarProfileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
        More Options <i class="mdi mdi-chevron-down"></i>
      </button>
      <div class="dropdown-menu w-100 shadow border-0" aria-labelledby="sidebarProfileDropdown">
        <a class="dropdown-item" href="{{url('/admin/my-profile')}}">My Profile</a>
        <a class="dropdown-item" href="{{url('/admin/add-user')}}">Add New User</a>
        <form action="{{url('logout')}}" method="post">
          @csrf
          <button class="dropdown-item" type="submit">Sign Out</button>
        </form>
      </div>
    </div>
  </div>

  <ul class="nav flex-column gap-1 sb-sidebar-nav">
    <li class="nav-item text-uppercase small text-secondary mt-3 px-2">My Dashboard</li>
    <li class="nav-item {{$isActive('admin/dashboard')}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{$isActive('admin/dashboard') ? 'bg-dark' : ''}}" href="{{url('admin/dashboard')}}">
        <i class="mdi mdi-chart-line fs-5"></i>
        <span class="menu-title">Dashboard</span>
      </a>
    </li>
    <li class="nav-item {{$isActive('admin/add-user') || $isActive('admin/my-profile') ? 'active' : ''}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{($isActive('admin/add-user') || $isActive('admin/my-profile')) ? 'bg-dark' : ''}}" href="{{url('admin/add-user')}}">
        <i class="mdi mdi-account fs-5"></i>
        <span class="menu-title">System users</span>
      </a>
    </li>

    <li class="nav-item text-uppercase small text-secondary mt-4 px-2">My Store</li>
    <li class="nav-item {{$isActive('admin/logo')}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{$isActive('admin/logo') ? 'bg-dark' : ''}}" href="{{url('admin/logo')}}">
        <i class="mdi mdi-wrench fs-5"></i>
        <span class="menu-title">Logo</span>
      </a>
    </li>
    <li class="nav-item {{request()->is('admin/landing-section') || request()->is('admin/inner-sections') ? 'active' : ''}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{(request()->is('admin/landing-section') || request()->is('admin/inner-sections')) ? 'bg-dark' : ''}}" data-bs-toggle="collapse" href="#form-elements-2" aria-expanded="{{request()->is('admin/landing-section') || request()->is('admin/inner-sections') ? 'true' : 'false'}}" aria-controls="form-elements-2">
        <i class="mdi mdi-view-dashboard fs-5"></i>
        <span class="menu-title">Inner Sections</span>
        <i class="mdi mdi-chevron-right ms-auto"></i>
      </a>
      <div class="collapse {{request()->is('admin/landing-section') || request()->is('admin/inner-sections') ? 'show' : ''}}" id="form-elements-2">
        <ul class="nav flex-column ms-5 my-1">
          <li class="nav-item"><a class="nav-link text-white-50 py-1" href="{{url('admin/landing-section')}}">Static Sections</a></li>
          <li class="nav-item"><a class="nav-link text-white-50 py-1" href="{{url('admin/inner-sections')}}">Dynamic Sections</a></li>
        </ul>
      </div>
    </li>
    <li class="nav-item {{request()->is('admin/categories') || request()->is('admin/collections/*') ? 'active' : ''}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{(request()->is('admin/categories') || request()->is('admin/collections/*')) ? 'bg-dark' : ''}}" href="{{url('admin/categories')}}">
        <i class="mdi mdi-playlist-check fs-5"></i>
        <span class="menu-title">Categories & Collections</span>
      </a>
    </li>
    <li class="nav-item {{$isActive('admin/labels')}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{$isActive('admin/labels') ? 'bg-dark' : ''}}" href="{{url('admin/labels')}}">
        <i class="mdi mdi-tag-multiple fs-5"></i>
        <span class="menu-title">Inventory Pages</span>
      </a>
    </li>
    <li class="nav-item {{request()->is('admin/inventory') || request()->is('admin/add-inventory') || request()->is('admin/edit-inventory/*') || request()->is('admin/view-inventory/*') ? 'active' : ''}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{(request()->is('admin/inventory') || request()->is('admin/add-inventory') || request()->is('admin/edit-inventory/*') || request()->is('admin/view-inventory/*')) ? 'bg-dark' : ''}}" href="{{url('admin/inventory')}}">
        <i class="mdi mdi-briefcase-check fs-5"></i>
        <span class="menu-title">Manage Inventory</span>
      </a>
    </li>

    <li class="nav-item text-uppercase small text-secondary mt-4 px-2">Customers</li>
    <li class="nav-item {{$isActive('admin/queries')}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{$isActive('admin/queries') ? 'bg-dark' : ''}}" href="{{url('admin/queries')}}">
        <i class="mdi mdi-account-plus fs-5"></i>
        <span class="menu-title">Customer Queries</span>
      </a>
    </li>
    <li class="nav-item {{$isActive('admin/directory')}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{$isActive('admin/directory') ? 'bg-dark' : ''}}" href="{{url('admin/directory')}}">
        <i class="mdi mdi-account-group fs-5"></i>
        <span class="menu-title">Directory</span>
      </a>
    </li>
    <li class="nav-item {{$isActive('admin/all-activity')}}">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold {{$isActive('admin/all-activity') ? 'bg-dark' : ''}}" href="{{url('/admin/all-activity')}}">
        <i class="mdi mdi-clock fs-5"></i>
        <span class="menu-title">Activity Tracker</span>
      </a>
    </li>

    <li class="nav-item text-uppercase small text-secondary mt-4 px-2">External Link</li>
    <li class="nav-item">
      <a class="nav-link text-white d-flex align-items-center gap-3 px-3 py-2 rounded-0 fs-5 fw-semibold" href="{{str_replace('/public', '/', Helper::props('/'))}}" target="_blank">
        <i class="mdi mdi-open-in-new fs-5"></i>
        <span class="menu-title">Visit website</span>
      </a>
    </li>
  </ul>
</nav>
<div class="sb-sidebar-backdrop d-lg-none" data-sidebar-close></div>
<!-- partial -->
