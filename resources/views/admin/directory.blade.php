<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="row">
            <div class="col-lg-6 breadcrumbs">
                <h5 class="m-4">
                    <a href="{{url('admin/directory')}}">Directory</a> /
                    <span class="breadcrumbs-active">List Directory Items</span>
                </h5>
            </div>
        </div>
    </div>
</div>
<br />
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab">
                @if (Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success mt-2" style="background-color:#58ad2e;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('success')}}</h5>
                    </div>
                @endif
                @if (Illuminate\Support\Facades\Session::has('error'))
                    <div class="alert alert-danger mt-2" style="background-color:#d22a1f;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('error')}}</h5>
                    </div>
                @endif
                <div class="tab-content" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="product" role="tabpanel">
                        <h4 class="card-title card-title-dash mt-1 mb-2">Application Directory</h4>
                        <div class="table-box">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone</th>
                                        <th scope="col">Created From</th>
                                        <th scope="col">Created On</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($directory as $key => $row)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td>{{$row->name}}</td>
                                            <td>{{$row->email}}</td>
                                            <td>{{$row->phone}}</td>
                                            <td>{{$row->created_from}}</td>
                                            <td>{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</td>
                                            <td>
                                                <a href=""
                                                    onclick="return confirm('Are you sure you want to delete this item?')">
                                                    <button type="button" class="btn btn-danger text-light">Delete</button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<x-admin-footer />