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
                    <a href="{{url('admin/inner-sections')}}">Inner Sections</a> /
                    <span class="breadcrumbs-active">Manage Inner Sections</span>
                </h5>
            </div>
            <div class="col-lg-6">
                <button type="button" class="pull-right btn btn-primary m-2 mt-2 text-light" onclick="popModal()">+ Add Inventory Display Section</button>
            </div>
        </div>
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
                                            <button type="button" class="btn btn-primary text-light mt-1" onclick="editModal('{{$row->id}}','{{$row->name}}','{{$row->type}}','{{$row->button}}','{{$row->url}}','{{$row->button}}')">Edit</button>
                                            <button type="button" class="btn btn-dark text-light mt-1" title="Assign Inventory Items">Assign Inventory</button>
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->type}}</td>
                                        @if($row->button==1)
                                            <td>Yes</td>
                                        @else
                                            <td>No</td>
                                        @endif
                                        @if($row->url!="")
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
                    <input type="hidden" name="created_at" value="{{App\Helpers\Helper::timeStamp()}}"/>
                    <label>Enter the section name</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="99" name="name"
                        required placeholder="Start Typing..."/>

                    <label class="mt-2">Select section type</label>
                    <select class="form-control" style="color:black !important;" name="type" required>
                        <option value="" selected disabled>--Select--</option>
                        <option value="star">Star</option>
                        <option value="galaxy">Galaxy</option>
                        <option value="nebula">Nebula</option>
                    </select>

                    <label class="mt-2">Need a button?</label>
                    <select class="form-control" style="color:black !important;" name="button" id="button-submit" required>
                        <option value="" selected disabled>--Select--</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>

                    <label class="mt-2">Button's URL</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="499" name="url" id="url-submit"
                         placeholder="Start Typing..."/>

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
            <form action="{{route('edit.section')}}" method="POST">
                @csrf
                <div class="modal-body">
                <label>Enter the section name</label>
                <input type="hidden" name="id" id="id"/>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="99" name="name"
                        required id="name" placeholder="Start Typing..."/>

                    <label class="mt-2">Select section type</label>
                    <select class="form-control" style="color:black !important;" name="type" id="type" required>
                        <option value="" selected disabled>--Select--</option>
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
                        required placeholder="Start Typing..."/>
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
    function popModal(path) {
        $('#popModal').modal('show');
    }

    function editModal(id,name,type,button,url,button) {
        $('#editModal').modal('show');
        $('#id').val(id);
        $('#name').val(name);
        $('#url').val(url);
        $("#type").val(type).change();
        $("#button").val(button).change();
    }
    $(document).ready(function(){
        $('#url-submit').hide();
    });
    $('#button-submit').on('change', function() {
        var val=this.value;
        if(val==1){
            $('#url-submit').show();
            $('#url-submit').attr("required", "true");
        } else {
            $('#url-submit').hide();
            $('#url-submit').removeAttr("required", "false");
        }
    });

    $('#button').on('change', function() {
        var val=this.value;
        if(val==1){
            $('#url').attr("required", "true");
        } else {
            $('#url').removeAttr("required", "false");
        }
    });
</script>