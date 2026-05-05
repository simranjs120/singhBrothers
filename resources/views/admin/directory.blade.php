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
            <h1 class="mb-1">Directory</h1>
            <p class="text-muted small mb-0 mt-2">Admin / Directory</p>
            <button type="button" onclick="popModalDirectoryItem()"
                class="btn btn-sm py-2 px-4 fw-bold rounded-3 background-secondary text-dark border border-dark text-decoration-none mt-4"
                title="Add new Item">+ Add New Item</button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">

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
                            <p class="fs-4 mb-4">Application Directory</p>
                            <div class="table-box">
                                <table class="table" id="datatable">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Name</th>
                                            <th scope="col">Email</th>
                                            <th scope="col">Phone</th>
                                            <th scope="col">Created By</th>
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
                                                    <button type="button" class="btn btn-dark text-light"
                                                        onclick="popModalDirectoryItemEdit('{{$row->name}}','{{$row->email}}','{{$row->phone}}','{{$row->id}}')">Edit</button>
                                                    <a href="{{url('admin/delete-directory-item/' . $row->id)}}"
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
<!-- Add new directory item -->
<div class="modal fade" id="popModalDirectoryItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('submit.insertEntryFromAdmin')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add new directory item</h5>
                </div>
                <div class="modal-body">
                    <label class="">&nbsp;Name<span class="asterik">*</span></label>
                    <input type="text" name="name" class="form-control" maxlength="80" placeholder="Enter name..."
                        required />
                    <label class="mt-3">&nbsp;Email<span class="asterik">*</span></label>
                    <input type="email" name="email" class="form-control" maxlength="80" placeholder="Enter email..."
                        required />
                    <label class="mt-3">&nbsp;Phone<span class="asterik">*</span></label>
                    <input type="text" name="phone" class="form-control" maxlength="80" placeholder="Enter phone..."
                        required />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="popModalDirectoryItemEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{route('edit.insertEntryFromAdmin')}}" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit directory item</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" class="form-control" maxlength="80" id="editId" required />
                    <label class="">&nbsp;Name<span class="asterik">*</span></label>
                    <input type="text" name="name" class="form-control" maxlength="80" id="editName"
                        placeholder="Enter name..." required />
                    <label class="mt-3">&nbsp;Email<span class="asterik">*</span></label>
                    <input type="email" name="email" class="form-control" maxlength="80" id="editEmail"
                        placeholder="Enter email..." required />
                    <label class="mt-3">&nbsp;Phone<span class="asterik">*</span></label>
                    <input type="text" name="phone" class="form-control" maxlength="80" id="editPhone"
                        placeholder="Enter phone..." required />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<x-admin-footer />
<script>
    function popModalDirectoryItem() {
        $('#popModalDirectoryItem').modal('show');
    }
    function popModalDirectoryItemEdit(name, email, phone, id) {
        $('#popModalDirectoryItemEdit').modal('show');
        $('#editEmail').val(email);
        $('#editName').val(name);
        $('#editPhone').val(phone);
        $('#editId').val(id);
    }
</script>