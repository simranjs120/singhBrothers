<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab">
                <div class="mt-3 d-sm-flex align-items-center justify-content-between border-bottom">
                    <!-- Start: Navigation Bar & Some Useful Buttons -->

                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#categories"
                                role="tab" aria-controls="overview" aria-selected="true">Categories</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#sub-categories" role="tab"
                                aria-selected="false">Sub-categories</a>
                        </li>
                    </ul>
                    <div>
                        <div class="btn-wrapper">
                            <button type="button" class="btn btn-success m-3 mt-0 text-light" data-bs-toggle="modal"
                                data-bs-target="#categoryModal">+ New Category</button>
                            <button type="button" class="btn btn-primary m-3 mt-0 text-light" data-bs-toggle="modal"
                                data-bs-target="#subCategoryModal">+ New Sub-Category</button>
                        </div>
                    </div>

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
                    <div class="tab-pane fade show active" id="categories" role="tabpanel">
                        <h4 class="card-title card-title-dash mt-1 mb-2">Here's the list of all your categories</h4>
                        <table class="table" id="datatable" style="overflow-x:scroll;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Category ID</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categoryData as $key => $row)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$row->id}}</td>
                                        <td>{{$row->category}}</td>
                                        <td>{{$row->created_at}}</td>
                                        <td>
                                            @if($row->status == 0)
                                                <a href="{{url('admin/categories/change-status/' . $row->id . '/1')}}">
                                                    <span class="badge badge-danger"
                                                        onclick="return confirm('Do you want to switch this to active?')">In-Active</span>
                                                </a>
                                            @endif
                                            @if($row->status == 1)
                                                <a href="{{url('admin/categories/change-status/' . $row->id . '/0')}}">
                                                    <span class="badge badge-success"
                                                        onclick="return confirm('Do you want to switch this to In-active?')">Active</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{url('admin/hierarchies/' . $row->id)}}">
                                                <button type="button" class="btn btn-success text-light">View Hierarchies</button>
                                            </a> 
                                            <a href="{{url('admin/categories/delete-category/' . $row->id)}}">
                                                <button type="button" class="btn btn-danger text-light"
                                                    onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane fade" id="sub-categories" role="tabpanel">
                    <h4 class="card-title card-title-dash mt-1 mb-2">Here's the list of all your Sub-categories</h4>
                        <table class="table" id="datatable-2" style="overflow-x:scroll; width:100%;">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Parent Category</th>
                                    <th scope="col">Sub-Category</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                if (is_array($subCategoryData) || is_object($subCategoryData))
                                {
                                @endphp
                                @foreach($subCategoryData as $key => $data)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>{{$data['category_id']->category}}</td>
                                        <td>{{$data['sub_category']}}</td>
                                        <td>{{$data['created_at']}}</td>
                                        <td>
                                            <a href="{{url('' . $data['id'])}}">
                                                <button type="button" class="btn btn-danger text-light"
                                                    onclick="return confirm('Are you sure you want to delete this?')">Delete</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @php 
                                }
                                @endphp
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Category Modal -->
<div class="modal fade" id="categoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add a new category to the system from here.</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('add.category')}}" method="POST">
                    @csrf
                    <label>Enter Your New Category: </label>
                    <input type="text" name="category" class="form-control mt-1 border border-dark" required
                        maxlength="100" placeholder="Start Typing...." />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<!-- Add Sub-Category Modal -->
<div class="modal fade" id="subCategoryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create new Sub-Categories in the system from here.</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('submit.sub-categories')}}" method="POST">
                    @csrf
                    <label>Select parent category from this dropdown: </label>
                    <select class="form-control" id="subCategoryModal" name="category_id"
                        style="color:black !important;" required>
                        <option selected disabled value="">--- Select Category ---</option>
                        @foreach($categoryData as $cat)
                            <option value="{{$cat->id}}">{{$cat->category}}</option>
                        @endforeach
                    </select>
                    <p class="mt-2 please-wait-msg"></p>
                    <label class="mt-2">Enter Your New Sub-Category: </label>
                    <input type="text" name="sub_category" class="form-control mt-1 border border-dark" required
                        maxlength="100" placeholder="Start Typing...." />
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" id="sub-category-submit">Save changes</button>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
            </form>
        </div>
    </div>
</div>

<x-admin-footer />