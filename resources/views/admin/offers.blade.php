<x-Admin-header :profile="$profile" />
<style>
    #image-popper:hover{
        cursor:pointer;
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
            <a href="{{url('')}}">
                    <button type="button" class="pull-right btn btn-success m-2 mt-2 text-light">+ Add New Offer Item</button>
                </a>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
    <div class="card">
        <div class="row">
        <div class="col-sm-12">
            <div class="home-tab" >
                <h4 class="card-title card-title-dash m-4">All Offers</h4>
                @if (Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success mt-2" style="background-color:#58ad2e;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('success')}}</h5>
                    </div><br/>
                @endif
                @if (Illuminate\Support\Facades\Session::has('error'))
                    <div class="alert alert-danger mt-2" style="background-color:#d22a1f;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('error')}}</h5>
                    </div><br/>
                @endif
                <div class="table-box" style="overflow-x:scroll !important;">
                <table class="table" id="datatable" style="overflow-x:scroll !important;">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Offer Image</th>
                            <th scope="col">Offer Title</th>
                            <th scope="col">Offer Text</th>
                            <th scope="col">Offer URL</th>
                            <th scope="col">Auto enable on</th>
                            <th scope="col">Auto disable on</th>
                            <th scope="col">Offer Type</th>
                            <th scope="col">Status</th>
                            <th scope="col">Created On</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                            <tr>
                                <td></td>
                                <td>
                                    <img src="{{Helper::props('admin/inventoryImages') . '/' . 'a'}}" class="img-fluid" 
                                    id="image-popper" onclick="popImage('{{Helper::props('admin/inventoryImages') . '/' . 'a'}}')"/>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        
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
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <img src="#" class="img-fluid" id="popElement" alt="Loading..."/>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<x-admin-footer />
<script>
    function popImage(path){
        $('#popImageModal').modal('show');
        $("#popElement").attr("src",path);
    }
</script>