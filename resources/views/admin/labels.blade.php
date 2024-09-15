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
                    <a href="{{url('admin/offers')}}">Labels</a> /
                    <span class="breadcrumbs-active">Manage Labels</span>
                </h5>
            </div>
            <div class="col-lg-6">
                <button type="button" class="pull-right btn btn-success m-2 mt-2 text-light" onclick="popModal()">+ Add New Label</button>
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
                    <h4 class="card-title card-title-dash m-4">All Labels</h4>
                    <p class="m-3"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Pro Tip: </u></b>You can create labels from here like "Fresh Arrivals", "Mega Sale" & later assign these to intended inventory items. Assigned inventory will show up in the link generated below.</p>
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
                                            <button type="button" class="btn btn-primary text-light" 
                                            onclick="editModal('{{$row->id}}','{{$row->name}}')">Edit</button>
                                        </td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->url}}</td>
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

<!-- Add label Modal -->
<div class="modal fade" id="popModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">New Offer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('submit.labels')}}" method="POST">
                @csrf
                <div class="modal-body">
                    <label>Enter the Label Name</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="100" name="name"
                        required placeholder="Start Typing..."/>
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
                    <input type="hidden" name="id" id="id"/>
                    <label>Enter the label name</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="100" name="name" id="title"
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
    function popModal() {
        $('#popModal').modal('show');
    }

    function editModal(id,title) {
        $('#editModal').modal('show');
        $('#id').val(id);
        $('#title').val(title);
    }

</script>