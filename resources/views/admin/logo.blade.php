<x-Admin-header :profile="$profile" />
<style>
    #image-popper:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <h2 class="panel-headings">Logos & Color</h2>
    <p class="panel-breadcrumbs">Configuration/Logos & Color</p>
</div>
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
<div class="row">
<div class="col-lg-12 mt-4">
    <div class="card">
        <div class="row">
            <div class="col-lg-12 breadcrumbs">
            <p class="m-3"><b><span class="mdi mdi-alert" style="color:red;"></span>&nbsp;<u>Please Note:</u></b> Only ".png" images are allowed, Other formats won't work here, Please upload accordingly. Click save below to update.</p>
            </div>
        </div>
    </div>
    </div>
</div>
<br />
<form action="{{route('submit.logos')}}" method="POST" enctype="multipart/form-data" id="logo_form">
    @csrf
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home-tab">
                        <h4 class="card-title card-title-dash m-4">Front Page logo</h4>
                        <p class="m-3"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Recommended Size:</u></b> Width 374*Height 102 Pixels.</p>
                        <img src="{{Helper::props('assets/img/logo.png')}}" class="img-fluid m-2" alt="Couldn't load image"/>
                        <input type="file" class="form-control m-3 w-50" name="front_logo" id="front_logo"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home-tab">
                        <h4 class="card-title card-title-dash m-4">Website Favicon (Icon in the browser tab)</h4>
                        <p class="m-3"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Recommended Size:</u></b> Width 40*Height 40 Pixels.</p>
                        <img src="{{Helper::props('assets/img/favicon.png')}}" class="img-fluid m-2" alt="Couldn't load image"/>
                        <input type="file" class="form-control m-3 w-50" name="favicon" id="favicon"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/><br/>
<div class="row">
    <div class="col-lg-6">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home-tab">
                        <h4 class="card-title card-title-dash m-4">Website Admin Panel Logo</h4>
                        <p class="m-3"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Recommended Size:</u></b> Width 374*Height 102 Pixels..</p>
                        <img src="{{Helper::props('admin/images/logo.png')}}" class="img-fluid m-2" alt="Couldn't load image"/>
                        <input type="file" class="form-control m-3 w-50" name="admin_logo" id="admin_logo"/>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home-tab">
                        <h4 class="card-title card-title-dash m-4">Website Front Footer Logo</h4>
                        <p class="m-3"><b><span class="mdi mdi-lightbulb-on" style="color:orange;"></span>&nbsp;<u>Recommended Size:</u></b> Width 374*Height 102 Pixels.</p>
                        <img src="{{Helper::props('assets/img/logo-dark.png')}}" class="img-fluid m-2" alt="Couldn't load image"/>
                        <input type="file" class="form-control m-3 w-50" name="front_footer_logo" id="front_footer_logo"/>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<div class="row">
<div class="col-lg-12">
    <div class="card">
        <div class="row">
            <div class="col-lg-12">
                <button type="submit" class="btn btn-success m-3">Submit</button>
            </div>
        </div>
    </div>
    </div>
</div>
</form>
<x-admin-footer />
<script>
    function fileSizeError(){
        Swal.fire({
                position: "center",
                icon: "error",
                title: "<b>File size should not exceed more than 10 MB, Removing file !!</b>",
                showConfirmButton: false,
                background:'white',
                timer: 3500
            });   
    }
    // Check file sizes, if less than 10 MB set preview
    const front_logo = document.getElementById("front_logo");
    front_logo.onchange = function() {
        if(this.files[0].size > 10943040) {
            fileSizeError();
            this.value = "";
        } else {
            const [file] = front_logo.files
        }
    };

    // Check file sizes, if less than 10 MB set preview
    const favicon = document.getElementById("favicon");
    favicon.onchange = function() {
        if(this.files[0].size > 10943040) {
            fileSizeError();
            this.value = "";
        } else {
            const [file] = favicon.files
        }
    };

    // Check file sizes, if less than 10 MB set preview
    const admin_logo = document.getElementById("admin_logo");
    admin_logo.onchange = function() {
        if(this.files[0].size > 10943040) {
            fileSizeError();
            this.value = "";
        } else {
            const [file] = admin_logo.files
        }
    };

    // Check file sizes, if less than 10 MB set preview
    const front_footer_logo = document.getElementById("front_footer_logo");
    front_footer_logo.onchange = function() {
        if(this.files[0].size > 10943040) {
            fileSizeError();
            this.value = "";
        } else {
            const [file] = front_footer_logo.files
        }
    };

</script>