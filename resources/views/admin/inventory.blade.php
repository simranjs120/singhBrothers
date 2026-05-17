<x-Admin-header :profile="$profile" />
<style>
    #image-popper:hover {
        cursor: pointer;
    }
</style>

<div class="container-fluid px-3">
    <!-- Header -->
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="mb-1">Manage Inventory</h1>
            <p class="text-muted small mb-0 mt-3">Admin / Manage Inventory</p>
        </div>
    </div>

    <a href="{{url('admin/add-inventory')}}"
        class="btn btn-sm py-2 px-4 fw-bold rounded-3 background-secondary text-dark border border-dark text-decoration-none"
        title="Create New Inventory Item">
        + New Inventory Item
    </a>
    <div class="row mb-4 mt-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center gap-2 flex-wrap">
                        <p class="fs-4 mb-4">List Of Your Inventory</p>
                    </div>
                    <!-- <h4 class="card-title card-title-dash m-4">All Your Inventory</h4> -->
                    @if (Illuminate\Support\Facades\Session::has('success'))
                        <div class="alert alert-success mt-2" style="background-color:#58ad2e;">
                            <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('success')}}</h5>
                        </div><br />
                    @endif
                    @if (Illuminate\Support\Facades\Session::has('error'))
                        <div class="alert alert-danger mt-2" style="background-color:#d22a1f;">
                            <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('error')}}</h5>
                        </div><br />
                    @endif
                    <div class="table-responsive">
                        <table class="table table-striped" id="datatable" width="100%">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Item Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Striker Price</th>
                                    <th scope="col">Actual Price</th>
                                    <th scope="col">Offer Badge</th>
                                    <th scope="col">Stock</th>
                                    <th scope="col">Collection</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">View/Edit/Labelling</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($inventory as $key => $row)
                                    <tr>
                                        <td>{{$key + 1}}</td>

                                        <td><a href="{{url('admin/view-inventory/' . $row->id)}}" class="text-decoration-none color-secondary fw-bold">{{$row->itemName}}</a>
                                        </td>

                                        <td>
                                            <img src="{{Helper::props('admin/inventoryImages') . '/' . $row->thumbnailimg}}"
                                                class="img-fluid" id="image-popper"
                                                onclick="popImage('{{Helper::props('admin/inventoryImages') . '/' . $row->thumbnailimg}}')" />
                                        </td>
                                        <td><s>{{$row->strikerPrice}}</s></td>
                                        <td>{{$row->actualPrice}}</td>
                                        <td>{{$row->offerBadge}}</td>
                                        <td>{{$row->quantity}}</td>
                                        <td>{{$row->collection_name}}</td>
                                        <td>{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</td>
                                        <td>
                                            @if($row->status == 0)
                                                <a href="{{url('admin/change-inventory-status/1/' . $row->id)}}">
                                                    <span class="badge badge-danger"
                                                        onclick="return confirm('Do you want to switch this to active?')">In-Active</span>
                                                </a>
                                            @endif
                                            @if($row->status == 1)
                                                <a href="{{url('admin/change-inventory-status/0/' . $row->id)}}">
                                                    <span class="badge badge-success"
                                                        onclick="return confirm('Do you want to switch this to In-active?')">Active</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>&nbsp;
                                            <a href="{{url('admin/view-inventory/' . $row->id)}}">
                                                <button type="button"
                                                    class="btn btn-sm py-2 px-2 fw-bold rounded-3 background-secondary text-dark border border-dark text-decoration-none"
                                                    title="View Item">View</button>
                                            </a>
                                            <a href="{{url('admin/edit-inventory/' . $row->id)}}">
                                                <button type="button" class="btn btn-dark text-light"
                                                    title="Edit Item">Edit</button>
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{url('/admin/delete-inventory/' . $row->id)}}"
                                                onclick="return confirm('Are you sure you want to delete this item?')">
                                                <button type="button" class="btn btn-dark text-light">Delete</button>
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
<!-- Image Popper Modal -->
<div class="modal fade" id="popImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thumbnail Preview</h5>
            </div>
            <div class="modal-body">
                <img src="#" class="img-fluid" id="popElement" alt=" Image couldn't be loaded" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<x-admin-footer />
<script>
    function popImage(path) {
        $('#popImageModal').modal('show');
        $("#popElement").attr("src", path);
    }
</script>