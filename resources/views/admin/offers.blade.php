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