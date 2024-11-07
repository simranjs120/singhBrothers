<x-Admin-header :profile="$profile" />
<style>
    #image-popper:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <h2 class="panel-headings">Dynamic Sections</h2>
    <p class="panel-breadcrumbs">Inner Sections/Dynamic Sections</p>
    <div class="d-flex">
        <button type="button" class="btn btn-success mt-2 text-light all-btns" onclick="popModal()">+ New
            Section</button>
    </div>
</div>
<br />
<div class="row">
    <div class="card">
        <div class="row">
            <div class="col-sm-12">
                <div class="home-tab">
                    <h4 class="card-title card-title-dash m-4">All Inner Section List</h4>
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
                                    <th scope="col">Edit/Assign</th>
                                    <th scope="col">Section Name</th>
                                    <th scope="col">Section Description</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Button</th>
                                    <th scope="col">URL</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($innerSection as $key => $row)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            <button type="button" class="btn btn-primary text-light mt-1"
                                                onclick="editModal('{{$row->id}}','{{$row->name}}','{{$row->type}}','{{$row->button}}','{{$row->url}}','{{$row->button}}','{{$row->description}}')">Edit</button>
                                            <button type="button" class="btn btn-dark text-light mt-1"
                                                title="Assign Inventory Items"
                                                onclick="popToAssign('{{$row->name}}',{{$row->id}})">Assign
                                                Inventory</button>
                                        </td>
                                        <td>{{$row->name}}</td>
                                        @if($row->description != "")
                                            <td>{{$row->description}}</td>
                                        @else
                                            <td>N/A</td>
                                        @endif
                                        @if($row->type == 'spotlight')
                                            <td><span
                                                    style="background-color:red; color:white; padding:2px;font-weight:bold;">{{$row->type}}</span>
                                            </td>
                                        @else
                                            <td>{{$row->type}}</td>
                                        @endif
                                        @if($row->button == 1)
                                            <td class="text-success"><b>Yes</b></td>
                                        @else
                                            <td class="text-danger"><b>No</b></td>
                                        @endif
                                        @if($row->url != "")
                                            <td>{{$row->url}}</td>
                                        @else
                                            <td>N/A</td>
                                        @endif
                                        <td>
                                            @if($row->status == 0)
                                                <a href="{{url('admin/change-section-status/1/' . $row->id)}}">
                                                    <span class="badge badge-danger"
                                                        onclick="return confirm('Do you want to switch this to active?')">In-Active</span>
                                                </a>
                                            @endif
                                            @if($row->status == 1)
                                                <a href="{{url('admin/change-section-status/0/' . $row->id)}}">
                                                    <span class="badge badge-success"
                                                        onclick="return confirm('Do you want to switch this to In-active?')">Active</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</td>
                                        <td>
                                            <a href="{{url('/admin/delete-section/' . $row->id)}}"
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

<!-- Add section Popper Modal -->
<div class="modal fade" id="popModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Section</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('submit.section')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="created_at" value="{{App\Helpers\Helper::timeStamp()}}" />
                    <label>Enter the section name <span class="asterik">*</span></label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="99" name="name" required
                        placeholder="Start Typing..." />
                    <label>Enter the section Description (If Any)</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="99" name="description"
                        placeholder="Start Typing..." />

                    <label class="mt-2">Select section type <span class="asterik">*</span></label>
                    <select class="form-control" style="color:black !important;" name="type" required>
                        <option value="" selected disabled>--Select--</option>
                        <option value="spotlight">**Spotlight**</option>
                        <option value="star">Star</option>
                        <option value="galaxy">Galaxy</option>
                        <option value="nebula">Nebula</option>
                    </select>

                    <label class="mt-2">Need a button? <span class="asterik">*</span></label>
                    <select class="form-control" style="color:black !important;" name="button" id="button-submit"
                        required>
                        <option value="" selected disabled>--Select--</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>

                    <label class="mt-2">Button's URL</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="499" name="url"
                        id="url-submit" placeholder="Please enter full URL like https://www.google.com" />

                    <label class="mt-2">Select status</label>
                    <select class="form-control" style="color:black !important;" name="status" required>
                        <option value="1" selected>Active</option>
                        <option value="0">In-Active</option>
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

<!-- Edit Offer Popper Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true" style="margin-top:-30px !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Section</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <p class="mt-3" style="margin:0px 0px 0px 10px;"><b><span class="mdi mdi-lightbulb-on"
                        style="color:orange;"></span>&nbsp;<u>Pro Tip:</u></b> Don't want button anymore? Just set "Need
                a button" to No & submit.</p>
            <form action="{{route('edit.section')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Enter the section name <span class="asterik">*</span></label>
                    <input type="hidden" name="id" id="id" />
                    <input type="text" class="form-control border border-dark mb-2" maxlength="99" name="name" required
                        id="name" placeholder="Start Typing..." />
                    <label>Enter the section description</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="99" name="description"
                        id="description" placeholder="Start Typing..." />

                    <label class="mt-2">Select section type <span class="asterik">*</span></label>
                    <select class="form-control" style="color:black !important;" name="type" id="type" required>
                        <option value="" selected disabled>--Select--</option>
                        <option value="spotlight">**Spotlight**</option>
                        <option value="star">Star</option>
                        <option value="galaxy">Galaxy</option>
                        <option value="nebula">Nebula</option>
                    </select>

                    <label class="mt-2">Need a button?</label>
                    <select class="form-control" style="color:black !important;" id="button" name="button" required>
                        <option value="" selected disabled>--Select--</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>

                    <label for="url" class="mt-2">Button's URL</label>
                    <input type="text" class="form-control border border-dark mb-2" id="url" maxlength="499" name="url"
                        required placeholder="Please enter full URL like https://www.google.com" />
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
<div class="modal fade" id="popAssignModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
            <form action="{{route('assign.inventory')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <p class="text-danger inventory-warning">Items colored Red are Inactive, These items won't show on
                        main pages even if you add them here. Kindly enable them first from inventory section if you
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
    function popModal(path) {
        $('#popModal').modal('show');
    }

    function editModal(id, name, type, button, url, button, description) {
        $('#editModal').modal('show');
        $('#id').val(id);
        $('#name').val(name);
        $('#url').val(url);
        $('#description').val(description);
        $("#type").val(type).change();
        $("#button").val(button).change();
    }
    $(document).ready(function () {
        $('#url-submit').hide();
    });
    $('#button-submit').on('change', function () {
        var val = this.value;
        if (val == 1) {
            $('#url-submit').show();
            $('#url-submit').attr("required", "true");
        } else {
            $('#url-submit').hide();
            $('#url-submit').removeAttr("required", "false");
        }
    });

    $('#button').on('change', function () {
        var val = this.value;
        if (val == 1) {
            $('#url').attr("required", "true");
        } else {
            $('#url').removeAttr("required", "false");
        }
    });

    function popToAssign(elename, itemId) {
        // Clicking outside of modal is disabled to handle the ajax data removal...
        $('#popAssignModal').modal('show');
        $("#elename").text("Assign inventory to " + elename);
        $("#itemId").val(itemId);
        $("#loader").text("Loading...");

        // Fetch the labels & process the selected labels for this particular inventory item with this ajax request.
        $.ajax({
            url: "{{url('admin/fetch-inventory-to-assign')}}",
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