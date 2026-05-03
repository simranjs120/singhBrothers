<x-Admin-header :profile="$profile" />
@php
  date_default_timezone_set(env('APPLICATION_TIMEZONE'));
  $hour = (int) date('H');
  if ($hour >= 4 && $hour < 12) {
    $salutation = "🌅 Good Morning";
  } elseif ($hour >= 12 && $hour < 16) {
    $salutation = "🏞️ Good Afternoon";
  } elseif ($hour >= 16 && $hour < 20) {
    $salutation = "🌄 Good Evening";
  } else {
    $salutation = "🌃 Good Night";
  }
  $letter = ucfirst(substr($profile->name, 0, 1));
  $path = trim(request()->path(), '/') . '/';
@endphp
<div class="container-fluid px-3">
  <!-- Header -->
  <div class="row mb-3">
    <div class="col-12">
      <h1 class="h2 fw-normal mb-0">{{$salutation}} <strong class="fw-bold d-block d-lg-inline">{{$profile->name}}.
        </strong>Welcome to your dashboard</h1>
      <p class="text-muted mb-0 small mt-3">{{$path}}</p>
    </div>
  </div>


  <!-- Content -->
  <div class="row">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between mb-4">
            <p class="fw-normal mb-0 fs-4"><i class="mdi mdi-clock"></i>Activity Logger</p>
          </div>
          <ul class="list-unstyled ps-3 mb-0 small sb-timeline">
            @foreach($tracking10 as $row)
              <li>
                <div class="d-flex flex-column flex-lg-row justify-content-between gap-1 gap-lg-3">
                  <div>
                    <span class="text-dark fw-bold">{{$row->changer_name}}</span> {{$row->change_title}}
                    <p class="fw-bold mb-0">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}
                    </p>
                  </div>
                </div>
              </li>
            @endforeach
          </ul>
          <div class="list align-items-center pt-3">
            <div class="wrapper w-100">
              <p class="mb-0">
                <a href="{{url('/admin/all-activity')}}"
                  class="btn btn-sm py-2 background-secondary text-decoration-none text-dark border border-dark border-1 rounded-3 px-4 fw-bold">Show
                  all</a>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>



</div>
<x-admin-footer />