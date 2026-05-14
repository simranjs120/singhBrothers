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
            <h1 class="mb-1">Categories & Collections</h1>
            <p class="text-muted small mb-0 mt-2">Admin / Categories & Collections</p>
            <p class="text-muted mb-0 mt-3">
                Create your product structure here. Top-level categories become main product pages like
                <b>/frames</b>. Sub-categories build collection paths like <b>frames / italian / 3mm</b>.
            </p>

            <!-- Buttons -->
            <div class="d-flex gap-2 mt-3">

                <button type="button"
                    class="py-2 px-4 fw-bold background-secondary text-dark border border-dark rounded-3"
                    data-bs-toggle="modal" data-bs-target="#categoryModal">
                    + New Main Category
                </button>

                <button type="button" class="py-2 px-4 fw-bold btn btn-dark rounded-3" data-bs-toggle="modal"
                    data-bs-target="#subCategoryModal">
                    + New Child Category
                </button>

            </div>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <!-- Tabs -->
                    <div class="mt-1 mb-3 d-sm-flex align-items-center justify-content-between">
                        <ul class="nav nav-pills gap-2 tabs-toggle" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active text-dark px-3 py-2" data-bs-toggle="tab" href="#categories">
                                    Main Categories
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link text-dark px-3 py-2" data-bs-toggle="tab" href="#sub-categories">
                                    Child Categories
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Alerts -->
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

                    <!-- Tab Content -->
                    <div class="tab-content">

                        <!-- Categories -->
                        <div class="tab-pane fade show active" id="categories">
                            <p class="mt-2 mb-1 fs-4">Main categories</p>
                            <p class="text-muted">
                                These are the first level of your product catalogue, for example Frames, Pins, Collages.
                                Each active main category should have its own public page.
                            </p>

                            <div class="table-box" style="overflow-x:auto;">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category ID</th>
                                            <th>Main Category</th>
                                            <th>Public Page</th>
                                            <th>Created On</th>
                                            <th>Status</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($categoryData as $key => $row)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$row->id}}</td>
                                                <td>{{$row->category}}</td>
                                                <td>{{$row->slug ? url($row->slug) : '--'}}</td>
                                                <td>{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</td>
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
                                                    <a href="{{url('admin/collections/' . $row->id)}}">
                                                        <button class="py-2 px-2 fw-bold background-secondary text-dark border border-dark rounded-3">View Collections</button>
                                                    </a>
                                                    <a href="{{url('admin/categories/delete-category/' . $row->id)}}">
                                                        <button class="btn btn-dark text-light"
                                                            onclick="return confirm('Are you sure?')">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Sub Categories -->
                        <div class="tab-pane fade" id="sub-categories">
                            <p class="mt-2 mb-1 fs-4">Child categories</p>
                            <p class="text-muted">
                                Use child categories to build nested product paths. Example: create Italian under Frames,
                                then create 3mm under Italian to form Frames / Italian / 3mm.
                            </p>

                            <div class="table-box" style="overflow-x:auto;">
                                <table class="table" id="datatable-2">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Parent</th>
                                            <th>Child Category</th>
                                            <th>Category ID</th>
                                            <th>Status</th>
                                            <th>Created On</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php if (is_array($subCategoryData) || is_object($subCategoryData)) { @endphp
                                        @foreach($subCategoryData as $key => $data)
                                            <tr>
                                                <td>{{$key + 1}}</td>
                                                <td>{{$data['parent']->category}}</td>
                                                <td>{{$data['sub_category']}}</td>
                                                <td>{{$data['id']}}</td>
                                                <td>
                                                    @if($data['status'] == 0)
                                                        <a
                                                            href="{{url('admin/categories/change-status/' . $data['id'] . '/1')}}">
                                                            <span class="badge badge-danger">In-Active</span>
                                                        </a>
                                                    @endif
                                                    @if($data['status'] == 1)
                                                        <a
                                                            href="{{url('admin/categories/change-status/' . $data['id'] . '/0')}}">
                                                            <span class="badge badge-success">Active</span>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>{{App\Helpers\Helper::timeStampProcessed($data['created_at'])}}</td>
                                                <td>
                                                    <a href="{{url('admin/categories/delete-category/' . $data['id'])}}">
                                                        <button class="btn btn-dark text-light">Delete</button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @php } @endphp
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

<!-- Category Modal -->
<div class="modal fade" id="categoryModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Add Main Category</h5>
            </div>

            <div class="modal-body">
                <form action="{{route('add.category')}}" method="POST">
                    @csrf
                    <label>Main category name</label>
                    <input type="text" name="category" class="form-control" required placeholder="Example: Frames">
                    <p class="text-muted small mb-0 mt-2">
                        This is the top level. It will be used for pages like /frames. Spaces will automatically become hyphens in the page URL.
                    </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary">Save</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

            </form>
        </div>
    </div>
</div>

<!-- Sub Category Modal -->
<div class="modal fade" id="subCategoryModal">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5>Add Child Category</h5>
            </div>

            <div class="modal-body">
                <form action="{{route('submit.sub-categories')}}" method="POST">
                    @csrf

                    <label>Select parent category</label>
                    <select class="form-control" id="subCategorySelect" name="parent_id" required>
                        <option disabled selected>--- Select Parent ---</option>
                        @foreach($allCategoryData as $cat)
                            <option value="{{$cat->id}}">{{$cat->category}}</option>
                        @endforeach
                    </select>

                    <label class="mt-2">Child category name</label>
                    <input type="text" name="category" class="form-control mt-2" required
                        placeholder="Example: Italian or 3mm">
                    <p class="text-muted small mb-0 mt-2">
                        Choose Frames as parent and enter Italian to create Frames / Italian.
                        Then choose Italian as parent and enter 3mm to create Frames / Italian / 3mm.
                    </p>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" id="sub-category-submit">Save</button>
                <button class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

            </form>
        </div>
    </div>
</div>

<x-admin-footer />
