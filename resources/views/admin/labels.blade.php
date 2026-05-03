<x-Admin-header :profile="$profile" />
<style>
    #image-popper:hover {
        cursor: pointer;
    }

    .copyBtn:hover {
        color: black;
    }
</style>
<div class="container-fluid px-3">

    <!-- Header -->
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="mb-1">Product Pages</h1>
            <p class="text-muted small mb-0 mt-3">Admin / Product Pages</p>
            <button type="button"
                class="py-2 px-4 fw-bold background-secondary text-dark border border-dark rounded-3 mt-4"
                onclick="popModal()">+ New Product Page</button>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">

                    <p class="fs-4">All Labels</p>
                    <p class="text-muted">Create dedicated page for items from here like "Fresh Arrivals", "Mega Sale" & later
                        assign
                        these to intended inventory items. Assigned inventory will show up in the link generated below.
                    </p>
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
                    <div class="table-box" style="overflow-x:scroll !important;">
                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Edit</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Link</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($label as $key => $row)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <button type="button" class="btn btn-sm py-1 my-2 px-4 fw-bold background-secondary text-dark border border-dark rounded-3 mt-4"
                                                onclick="editModal('{{$row->id}}','{{$row->name}}')">Edit</button>
                                            <button type="button" class="btn btn-dark btn-sm text-light"
                                                onclick="popLabel('{{$row->id}}','{{$row->name}}')">Assign
                                                Inventory</button>
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->url}}&nbsp;&nbsp;<button type="button" class="btn btn-secondary copyBtn"
                                                onclick="copyToClipboard('{{$row->url}}','{{$row->id}}')"
                                                id="copied_{{$row->id}}">Copy</button></td>
                                        <td>
                                            @if($row->status == 0)
                                                <a href="{{url('admin/change-label-status/1/' . $row->id)}}">
                                                    <span class="badge badge-danger"
                                                        onclick="return confirm('Do you want to switch this to active?')">In-Active</span>
                                                </a>
                                            @endif
                                            @if($row->status == 1)
                                                <a href="{{url('admin/change-label-status/0/' . $row->id)}}">
                                                    <span class="badge badge-success"
                                                        onclick="return confirm('Do you want to switch this to In-active?')">Active</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</td>
                                        <td>
                                            <a href="{{url('/admin/delete-label/' . $row->id)}}"
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
<!-- Add label Modal -->
<div class="modal fade" id="popModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Offer</h5>
            </div>
            <form action="{{route('submit.labels')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Enter the Label Name</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="100" name="name" required
                        placeholder="Start Typing..." />
                    <label>Status</label>
                    <select class="form-control" style="color:black !important;" name="status" id="type" required>
                        <option value="1" selected>Active</option>
                        <option value="0">Inactive</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit label Popper Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style=",argin-top:-30px !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Offer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('edit.labels')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id" />
                    <label>Enter the label name</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="100" name="name"
                        id="title" required placeholder="Start Typing..." />
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Assign Inventory Popper Modal -->
<div class="modal fade" id="popLabelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="elename"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" onclick="erase()" aria-label="Close"
                    title="Close Popup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('assign.labels')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-danger inventory-warning">Items colored Red are Inactive, These items won't show on
                        label pages even if you add them here. Kindly enable them first from inventory section if you
                        want.</p>
                    <div class="row">
                        <input type="hidden" id="itemId" name="itemId" />
                        <p id="loader"></p>
                        <div class="html-render"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success assign-btn">Assign</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" onclick="erase()"
                        title="Close Popup">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<x-admin-footer />
<script>
    function popModal() {
        $('#popModal').modal('show');
    }

    function editModal(id, title) {
        $('#editModal').modal('show');
        $('#id').val(id);
        $('#title').val(title);
    }
    function copyToClipboard(copyText, id) {
        navigator.clipboard.writeText(copyText);
        $('#copied_' + id).text('Link Copied !!');
        $('#copied_' + id).css('color', 'black');
        setTimeout(() => {
            $('#copied_' + id).text('Copy');
        }, 3000);
    }

    function popLabel(itemId, elename) {
        // Clicking outside of modal is disabled to handle the ajax data removal...
        $('#popLabelModal').modal('show');
        $("#elename").text("Assign Inventory to " + elename);
        $("#itemId").val(itemId);
        $("#loader").text("Loading...");

        // Fetch the inventory & process the selected inventories for this particular label with this ajax request.
        $.ajax({
            url: "{{url('admin/fetch-id-specific-records')}}",
            method: 'POST',
            dataType: 'json',
            data: {
                id: itemId,
                _token: '{{csrf_token()}}'
            },
            success: function (response) {
                var warning = 0;
                $("#loader").text("Autofilling...");
                // Response format is here in this alert //Uncomment this and use.....
                // alert(JSON.stringify(response));
                var count = response.countOfTotalInventoryItems;
                if (count > 0) {
                    for (let i = 0; i <= count - 1; i++) { // -1 to reduce an extra index, coz array starts from 0. Initiating i from 0 did not work.
                        // Append labels
                        if (response.data[i].status == 0) {
                            var checkboxes = "<div class='col-12'><input type='checkbox' name='inventory[]' id='name_" + response.data[i].id + "' value='" + response.data[i].id + "'/> <label for='vehicle' class='text-danger'>" + response.data[i].itemName + "</label></div>";
                            warning++;
                        } else {
                            var checkboxes = "<div class='col-12'><input type='checkbox' name='inventory[]' id='name_" + response.data[i].id + "' value='" + response.data[i].id + "'/> <label for='vehicle'>" + response.data[i].itemName + "</label></div>";
                        }
                        if (warning == 0) {
                            $('.inventory-warning').hide();
                        } else {
                            $('.inventory-warning').show();
                        }
                        $('.html-render').append(checkboxes);
                    }

                    for (let i = 0; i <= response.selected.length - 1; i++) {
                        if (response.countOfTotalInventoryItems != 0 || response.countOfTotalInventoryItems != undefined) {
                            // Where label_id from selected table matches the ID of label, Set that select box checked.
                            $('#name_' + response.selected[i].inventory_id).prop('checked', true);
                        }
                    }
                    $("#loader").text("");
                } else {
                    // No inventory items found
                    $("#loader").text("No inventory items found ☹️ Please add some inventory first from Manage Inventory Section");
                    $('.inventory-warning').text("");
                    $('.assign-btn').hide();
                }

            },
            error: function (error) {
                // alert(JSON.stringify(error));
                alert("Fatal Error: Could not load label options, Please try again !!");
            }
        });
    }
    // Handling condition: Everytime button is clicked without refreshing, Ajax re-renders the same checkboxes again
    function erase() {
        $('.html-render').html("");
    }
</script>