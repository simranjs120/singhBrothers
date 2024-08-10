<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab mb-4">
                <h4 class="card-title card-title-dash m-4">All Activity</h4>
                <div class="row">
                    <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                            <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                                <div class="card card-rounded">
                                    <div class="card-body">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <h4 class="card-title card-title-dash">Activities</h4>
                                            <p class="mb-0">Timestamps</p>
                                        </div>
                                        <ul class="bullet-line-list">
                                            @foreach($tracking as $row)
                                                <li>
                                                    <div class="d-flex justify-content-between">
                                                        <div><span class="text-light-green">{{$row->changer_name}}</span>
                                                            {{$row->change_title}} <p id="mobile-agent">{{$row->created_at}}</p></div>
                                                        <p id="pc-agent">{{$row->created_at}}</p>
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
        </div>
    </div>
</div>

<x-admin-footer />