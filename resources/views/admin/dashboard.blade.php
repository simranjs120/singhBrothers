<x-Admin-header :profile="$profile" />
@php
  date_default_timezone_set(env('APPLICATION_TIMEZONE'));
  $hour = (int) date('H');
if ($hour >= 4 && $hour < 12) {
    $salutation = "🌅 Good Morning";
} elseif ($hour >= 12 && $hour < 16) {
    $salutation = "☀️ Good Afternoon";
} elseif ($hour >= 16 && $hour < 20) {
    $salutation = "🌇 Good Evening";
} else {
    $salutation = "🌙 Good Night";
}
  $path = trim(request()->path(), '/') . '/';
@endphp

<div class="container-fluid px-3">
  <div class="row mb-3">
    <div class="col-12">
      <h1 class="h2 fw-normal mb-0">{{$salutation}} <strong class="fw-bold d-block d-lg-inline">{{$profile->name}}.</strong> Welcome to your dashboard</h1>
      <p class="text-muted mb-0 small mt-3">{{$path}}</p>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <p class="text-muted small mb-1">Inventory Items</p>
            <h2 class="fw-bold mb-0">{{$inventoryCount}}</h2>
          </div>
          <div class="background-secondary rounded-2 d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
            <i class="bi bi-box-seam fs-3 text-dark"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <p class="text-muted small mb-1">Inventory Pages</p>
            <h2 class="fw-bold mb-0">{{$inventoryPageCount}}</h2>
          </div>
          <div class="background-secondary rounded-2 d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
            <i class="bi bi-tags fs-3 text-dark"></i>
          </div>
        </div>
      </div>
    </div>

    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body d-flex align-items-center justify-content-between">
          <div>
            <p class="text-muted small mb-1">Customer Queries</p>
            <h2 class="fw-bold mb-0">{{$customerQueryCount}}</h2>
          </div>
          <div class="background-secondary rounded-2 d-flex align-items-center justify-content-center" style="width:56px;height:56px;">
            <i class="bi bi-chat-left-text fs-3 text-dark"></i>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="row g-3 mb-4">
    <div class="col-lg-6">
      <div class="card h-100 shadow-sm border-0 background-primary text-light">
        <div class="card-body">
          <p class="text-uppercase small color-secondary fw-bold mb-2">Shortcuts</p>
          <h2 class="h4 fw-bold text-light mb-3">Jump straight into store work</h2>
          <div class="d-flex flex-wrap gap-3">
            <a href="{{url('admin/inventory')}}" class="background-secondary text-dark border border-dark rounded-3 fw-bold px-4 py-2 text-decoration-none">
              <i class="bi bi-box-seam me-2"></i>Manage Inventory
            </a>
            <a href="{{str_replace('/public', '/', Helper::props('/'))}}" target="_blank" class="btn btn-outline-light rounded-3 fw-bold px-4 py-2">
              <i class="bi bi-box-arrow-up-right me-2"></i>Visit Website
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
      <div class="card h-100 shadow-sm border-0">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-3">
            <p class="fw-normal mb-0 fs-4">Latest Queries</p>
            <a href="{{url('admin/queries')}}" class="text-dark fw-bold text-decoration-none">View all</a>
          </div>
          @forelse($latestQueries as $query)
            <div class="border-bottom pb-3 mb-3">
              <div class="d-flex flex-column flex-md-row justify-content-between gap-2">
                <div>
                  <p class="fw-bold mb-1">{{$query->name}}</p>
                  <p class="text-muted small mb-1">{{$query->email}} | {{$query->phone}}</p>
                  <p class="mb-0">{{Illuminate\Support\Str::limit($query->message, 90)}}</p>
                </div>
                <span class="badge background-secondary text-dark align-self-start">{{ucfirst($query->type)}}</span>
              </div>
            </div>
          @empty
            <p class="text-muted mb-0">No customer queries yet.</p>
          @endforelse
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <p class="fw-normal mb-0 fs-4"><i class="bi bi-clock me-2"></i>Activity Logger</p>
          </div>
          <ul class="list-unstyled ps-3 mb-0 small sb-timeline">
            @foreach($tracking10 as $row)
              <li>
                <div class="d-flex flex-column flex-lg-row justify-content-between gap-1 gap-lg-3">
                  <div>
                    <span class="text-dark fw-bold">{{$row->changer_name}}</span> {{$row->change_title}}
                    <p class="fw-bold mb-0">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</p>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
          <div class="list align-items-center pt-3">
            <div class="wrapper w-100">
              <p class="mb-0">
                <a href="{{url('/admin/all-activity')}}" class="btn btn-sm py-2 background-secondary text-decoration-none text-dark border border-dark border-1 rounded-3 px-4 fw-bold">Show all</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<x-admin-footer />
