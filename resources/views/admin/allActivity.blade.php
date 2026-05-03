<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="container-fluid px-3">
    <!-- Header -->
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="mb-1">User Activity</h1>
            <p class="text-muted small mb-0 mt-3">Admin / Show All Activity</p>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 d-flex flex-column">
            <div class="row flex-grow">
                <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                    <div class="card card-rounded">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <p class="fw-normal mb-0 fs-4">Activities</p>
                            </div>
                            <ul class="list-unstyled ps-3 mb-0 small sb-timeline">
                                @foreach($tracking as $row)
                                    <li>
                                        <div class="d-flex flex-column flex-lg-row justify-content-between gap-1 gap-lg-3">
                                            <div>
                                                <span class="text-dark fw-bold">{{$row->changer_name}}</span>
                                                {{$row->change_title}}
                                                <p class="fw-bold mb-0">
                                                    {{App\Helpers\Helper::timeStampProcessed($row->created_at)}}
                                                </p>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <div class="list align-items-center pt-3">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<x-admin-footer />