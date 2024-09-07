<x-Admin-header :profile="$profile" />
<style>
    #image-popper:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="row">
            <div class="col-lg-6 breadcrumbs">
                <h5 class="m-4">
                    <a href="{{url('admin/inventory')}}">Inventory</a> /
                    <span class="breadcrumbs-active">List Inventory</span>
                </h5>
            </div>
            <div class="col-lg-6">
                <a href="{{url('admin/add-inventory')}}">
                    <button type="button" class="pull-right btn btn-success m-2 mt-2 text-light">+ New Inventory
                        item</button>
                </a>
            </div>
        </div>
    </div>
</div>
<br />
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab">
                <h4 class="card-title card-title-dash m-4">All Your Inventory</h4>
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
                    <table class="table" id="datatable" style="overflow-x:scroll !important;">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">View</th>
                                <th scope="col">Image</th>
                                <th scope="col">Item Name</th>
                                <th scope="col">Striker Price</th>
                                <th scope="col">Actual Price</th>
                                <th scope="col">Offer Badge</th>
                                <th scope="col">Dimensions</th>
                                <th scope="col">Size</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Collection</th>
                                <th scope="col">Created On</th>
                                <th scope="col">Status</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($inventory as $key => $row)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        <a href="{{url('admin/view-inventory/' . $row->id)}}">
                                            <button type="button" class="btn btn-success text-light"><span class="mdi mdi-eye"></span></button>
                                        </a>
                                        <a href="{{url('admin/edit-inventory/' . $row->id)}}">
                                            <button type="button" class="btn btn-dark text-light"><span class="mdi mdi-pencil"></span></button>
                                        </a>
                                            <button type="button" class="btn btn-primary text-light" onclick="popLabel('{{$row->itemName}}','{{$row->id}}')">Labels</button>
                                    </td>
                                    <td>
                                        <img src="{{Helper::props('admin/inventoryImages') . '/' . $row->thumbnailimg}}"
                                            class="img-fluid" id="image-popper"
                                            onclick="popImage('{{Helper::props('admin/inventoryImages') . '/' . $row->thumbnailimg}}')" />
                                    </td>
                                    <td>{{$row->itemName}}</td>
                                    <td><s>{{$row->strikerPrice}}</s></td>
                                    <td>{{$row->actualPrice}}</td>
                                    <td>{{$row->offerBadge}}</td>
                                    <td>{{$row->dimensions}}</td>
                                    <td>{{$row->size}}</td>
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
                                    <td>
                                        <a href="{{url('/admin/delete-inventory/' . $row->id)}}"
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

<!-- Image Popper Modal -->
<div class="modal fade" id="popImageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thumbnail Preview</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="#" class="img-fluid" id="popElement" alt="Loading..." />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Label Popper Modal -->
<div class="modal fade" id="popLabelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="elename"></h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" id="itemId" name="itemId"/>
                        <p id="loader"></p>
                        <div class="html-render">
                            
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Assign</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<x-admin-footer />
<script>
    function popImage(path) {
        $('#popImageModal').modal('show');
        $("#popElement").attr("src", path);
    }
    function popLabel(elename,itemId) {
        $('#popLabelModal').modal('show');
        $("#elename").text("Assign labels to "+elename);
        $("#itemId").val(itemId);
        $("#loader").text("Loading...");
        $.ajax({
          url: "{{url('admin/fetch-id-specific-records')}}",
          method: 'POST',
          dataType: 'json',
          data: {
            id: itemId,
            _token: '{{csrf_token()}}'
          },
          success: function (response) {
            $("#loader").text("");
            // Response format is here in this alert //Uncomment this and use.....
            // alert(JSON.stringify(response));
            var count=response.countOfTotalLabels;
            for(let i=0;i<=count-1;i++){ // -1 to reduce an extra index, coz array starts from 0. Initiating i from 0 did not work :(
                // Check if we have this label_id in label_inventory table with this inventory Id, If yes then this option is already selected.
                if(response.selected!="" && response.selected[i].label_id==response.allLabels[i].id){
                    var checkboxes="<div class='col-12'><input type='checkbox' name='vehicle' value='"+response.allLabels[i].id+"' checked/> <label for='vehicle'>"+response.allLabels[i].name+"</label></div>";
                } else {
                    var checkboxes="<div class='col-12'><input type='checkbox' name='vehicle' value='"+response.allLabels[i].id+"'/> <label for='vehicle'>"+response.allLabels[i].name+"</label></div>";
                }
                $('.html-render').append(checkboxes);
            }
            
          },
          error: function (error) {
            // alert(JSON.stringify(error));
            alert("Fatal Error: Could not load label options, Please try again !!");
          }
        });
    }
</script>