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
                    <a href="{{url('admin/offers')}}">Offers</a> /
                    <span class="breadcrumbs-active">Manage Offers</span>
                </h5>
            </div>
            <div class="col-lg-6">
                <button type="button" class="pull-right btn btn-success m-2 mt-2 text-light" onclick="popModal()">+ Add
                    New Offer Item</button>
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
                    <h4 class="card-title card-title-dash m-4">All Offers</h4>
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
                                    <th scope="col">Offer Image</th>
                                    <th scope="col">Offer Title</th>
                                    <th scope="col">Offer URL</th>
                                    <th scope="col">Auto enable on</th>
                                    <th scope="col">Auto disable on</th>
                                    <th scope="col">Offer Type</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Created On</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($offers as $key => $row)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td> 
                                            <button type="button" class="btn btn-primary text-light mt-1" onclick="editModal('{{$row->id}}','{{$row->title}}','{{$row->url}}','{{$row->auto_enable}}','{{$row->auto_disable}}','{{$row->type}}')">Edit</button>
                                        </td>
                                        <td>
                                            <img src="{{Helper::props('admin/offerImages') . '/' . $row->image}}"
                                                class="img-fluid" id="image-popper"
                                                onclick="imagePopModal('{{Helper::props('admin/offerImages') . '/' . $row->image}}')" />
                                        </td>
                                        <td>{{$row->title}}</td>
                                        <td>{{$row->url}}</td>
                                        <td>{{App\Helpers\Helper::timeStampProcessed(str_replace('T','   ',$row->auto_enable))}}</td>
                                        <td>{{App\Helpers\Helper::timeStampProcessed(str_replace('T','   ',$row->auto_disable))}}</td>
                                        @if($row->type == "top")
                                            <td>Top Bar</td>
                                        @elseif($row->type == "pop")
                                            <td>Pop-up Offer</td>
                                        @elseif($row->type == "section")
                                            <td>Offer Section</td>
                                        @endif
                                        <td>
                                            @if($row->status == 0)
                                                <a href="{{url('admin/change-offer-status/1/' . $row->id)}}">
                                                    <span class="badge badge-danger"
                                                        onclick="return confirm('Do you want to switch this to active?')">In-Active</span>
                                                </a>
                                            @endif
                                            @if($row->status == 1)
                                                <a href="{{url('admin/change-offer-status/0/' . $row->id)}}">
                                                    <span class="badge badge-success"
                                                        onclick="return confirm('Do you want to switch this to In-active?')">Active</span>
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</td>
                                        <td>
                                            <a href="{{url('/admin/delete-offers/' . $row->id)}}"
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

<!-- Add Offer Popper Modal -->
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
            <form action="{{route('submit.offers')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <label>Enter the offer title</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="100" name="title"
                        required placeholder="Start Typing..."/>
                    <label>Enter the offer URL</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="300" name="url"
                        required placeholder="Start Typing..."/>
                    <label>Auto Start Date/Time</label>
                    <input type="datetime-local" class="form-control border border-dark mb-2" name="auto_enable" />
                    <label>Auto End Date/Time</label>
                    <input type="datetime-local" class="form-control border border-dark mb-2" name="auto_disable" />
                    <label>Select offer Image</label>
                    <input type="file" class="form-control border border-dark mb-2" id="offerimg1" name="image" />
                    <label>Select the offer type</label>
                    <select class="form-control" style="color:black !important;" name="type" required>
                        <option selected disabled>-- Select Offer Type --</option>
                        <option value="top">Top Offer Bar</option>
                        <option value="pop">Pop-up Offer</option>
                        <option value="section">Offer in section</option>
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
    aria-hidden="true" style=",argin-top:-30px !important;">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Offer</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('edit.offers')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" name="id" id="id"/>
                    <label>Enter the offer title</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="100" name="title" id="title"
                        required placeholder="Start Typing..."/>
                    <label>Enter the offer URL</label>
                    <input type="text" class="form-control border border-dark mb-2" maxlength="300" name="url" id="url"
                        required placeholder="Start Typing..."/>
                    <label>Auto Start Date/Time</label>
                    <input type="datetime-local" class="form-control border border-dark mb-2" name="auto_enable" id="auto_enable"/>
                    <label>Auto End Date/Time</label>
                    <input type="datetime-local" class="form-control border border-dark mb-2" name="auto_disable" id="auto_disable"/>
                    <label>Select offer Image</label>
                    <input type="file" class="form-control border border-dark mb-2" id="offerimg1" name="image" id="image"/>
                    <label>Select the offer type</label>
                    <select class="form-control" style="color:black !important;" name="type" id="type" required>
                        <option selected disabled>-- Select Offer Type --</option>
                        <option value="top">Top Offer Bar</option>
                        <option value="pop">Pop-up Offer</option>
                        <option value="section">Offer in section</option>
                    </select>
                    <p class="mt-3"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Pro Tip: </u>
                    </b>If you don't want to change the image, Leave it as it is, Select the new image only if you want to change.</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Add Offer Popper Modal -->
<div class="modal fade" id="imagePopModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Offer Image Preview</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="#" class="img-fluid" alt="Loading..." id="popElement" />
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<x-admin-footer />
<script>
    function popModal(path) {
        $('#popModal').modal('show');
    }

    function editModal(id,title,url,auto_enable,auto_disable,type) {
        $('#editModal').modal('show');
        $('#id').val(id);
        $('#title').val(title);
        $('#url').val(url);
        $('#auto_enable').val(auto_enable);
        $('#auto_disable').val(auto_disable);
        $("#type").val(type).change();
    }

    function imagePopModal(path) {
        $('#imagePopModal').modal('show');
        $("#popElement").attr("src", path);
    }

    // Check file sizes, if less than 10 MB set preview
    const productpreview1File = document.getElementById("offerimg1");
    productpreview1File.onchange = function () {
        if (this.files[0].size > 10943040) {
            fileSizeError();
            this.value = "";
        } else {
            const [file] = productpreview1File.files
            if (file) {
                productpreview1.src = URL.createObjectURL(file)
            }
        }
    };
    function fileSizeError() {
        Swal.fire({
            position: "center",
            icon: "error",
            title: "<b>File size should not exceed more than 10 MB, Removing file !!</b>",
            showConfirmButton: false,
            background: 'white',
            timer: 3500
        });
    }
</script>