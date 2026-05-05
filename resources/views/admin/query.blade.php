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
            <h1 class="mb-1">Customer Queries</h1>
            <p class="text-muted small mb-0 mt-3">Admin / Customer Queries</p>
        </div>
    </div>


    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="mt-3 d-sm-flex align-items-center justify-content-between">
                        <!-- Start: Navigation Bar & Some Useful Buttons -->
                        <div class="mb-3 d-sm-flex align-items-center justify-content-between">
                            <ul class="nav nav-pills gap-2 tabs-toggle" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active text-dark px-3 py-2" id="home-tab" data-bs-toggle="tab"
                                        href="#product" role="tab" aria-controls="product" aria-selected="true">
                                        Product Queries
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark px-3 py-2" id="profile-tab" data-bs-toggle="tab"
                                        href="#contact" role="tab" aria-controls="contact" aria-selected="false">
                                        Contact Form Queries
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- <div>
                        <div class="btn-wrapper">
                            <button type="button" class="btn btn-success m-3 mt-0 text-light" data-bs-toggle="modal"
                                data-bs-target="#categoryModal">+ New Category</button>
                            <button type="button" class="btn btn-primary m-3 mt-0 text-light" data-bs-toggle="modal"
                                data-bs-target="#subCategoryModal">+ New Sub-Category</button>
                        </div>
                    </div> -->

                        <!-- End: Navigation Bar & Some Useful Buttons -->
                    </div>
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
                            <p class="fs-4">Here's the list of all Product Queries</p>
                            <div class="table-box">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">About Product</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Customer Email</th>
                                            <th scope="col">Customer Phone</th>
                                            <th scope="col">Customer's Message</th>
                                            <th scope="col">Asked On</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product as $key => $row)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$row->product}}</td>
                                                <td>{{$row->name}}</td>
                                                <td>{{$row->email}}</td>
                                                <td>{{$row->phone}}</td>
                                                <td>{{$row->message}}</td>
                                                <td>{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</td>
                                                <td>
                                                    <a href="{{url('admin/delete-query/' . $row->id)}}"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <button type="button"
                                                            class="btn btn-danger text-light">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="contact" role="tabpanel">
                            <p class="fs-4">Here's the list of all queries from Contact
                                Form</p>
                            <div class="table-box">
                                <table class="table" id="datatable-2">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Customer Name</th>
                                            <th scope="col">Customer Email</th>
                                            <th scope="col">Customer Phone</th>
                                            <th scope="col">Customer's Message</th>
                                            <th scope="col">Asked On</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($contact as $key => $row1)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$row1->name}}</td>
                                                <td>{{$row1->email}}</td>
                                                <td>{{$row1->phone}}</td>
                                                <td>{{$row1->message}}</td>
                                                <td>{{App\Helpers\Helper::timeStampProcessed($row1->created_at)}}</td>
                                                <td>
                                                    <a href="{{url('admin/delete-query/' . $row1->id)}}"
                                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                                        <button type="button"
                                                            class="btn btn-danger text-light">Delete</button>
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
</div>
<x-admin-footer />