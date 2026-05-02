<x-Admin-header :profile="$profile" />
<div class="row">
  <div class="col-sm-12">
    <div class="home-tab">
      <div class="tab-content tab-content-basic">
        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
          <h2 class="h4 fw-bold mb-3">Activity Logger</h2>
          <div class="row g-3">
            <div class="col-12">
              <div class="card border shadow-sm rounded-1">
                <div class="card-body p-4">
                      <div class="d-flex align-items-center justify-content-between mb-4">
                        <h4 class="h5 fw-bold mb-0"><i class="mdi mdi-clock"></i> Activity Logger</h4>
                      </div>
                      <ul class="list-unstyled ps-3 mb-0 small sb-timeline">
                        @foreach($tracking10 as $row)
                          <li>
                            <div class="d-flex flex-column flex-lg-row justify-content-between gap-1 gap-lg-3">
                              <div>
                                <span class="text-primary fw-bold">{{$row->changer_name}}</span> {{$row->change_title}}
                                <p class="d-lg-none fw-bold mb-0">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</p>
                              </div>
                              <p class="d-none d-lg-block fw-bold mb-0 text-nowrap small">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</p>
                            </div>
                          </li>
                        @endforeach
                      </ul>
                      <div class="list align-items-center pt-3">
                        <div class="wrapper w-100">
                          <p class="mb-0">
                            <a href="{{url('/admin/all-activity')}}" class="btn btn-primary px-4">Show all</a>
                          </p>
                        </div>
                      </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<x-admin-footer />
