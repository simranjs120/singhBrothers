<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>
<div class="row">
    <div class="card">
        <div class="row">
            <div class="col-lg-6 breadcrumbs">
                <h5 class="m-4">
                    <a href="{{url('admin/inventory')}}">Inventory</a> / <a href="{{url('admin/inventory')}}">List
                        Inventory</a> /
                    <span class="breadcrumbs-active">View Inventory</span>
                </h5>
            </div>
            <div class="col-lg-6">
                <a href="{{url('admin/editInventory')}}">
                    <button type="button" class="pull-right btn btn-success m-2 mt-2 text-light">Edit this item</button>
                </a>
            </div>
        </div>
    </div>
</div>
<br />
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab mb-4">
                <h4 class="card-title card-title-dash m-4">Inventory Details for <u>{{$inventory->itemName}}</u></h4>
                @if (Illuminate\Support\Facades\Session::has('success'))
                    <div class="alert alert-success mt-2" style="background-color:#58ad2e;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('success')}}</h5>
                    </div>
                @endif
                @if (Illuminate\Support\Facades\Session::has('error'))
                    <div class="alert alert-danger mt-2" style="background-color:#d22a1f;">
                        <h5 class="text-light">{{Illuminate\Support\Facades\Session::pull('error')}}</h5>
                    </div>
                @endif

                <div class="row">
                    <div class="col-lg-5">
                        <img src="{{Helper::props('admin/inventoryImages') . '/' . $inventory->thumbnailimg}}"
                            class="img-fluid" alt="Image Could Not Be Loaded Due To Some Error"/>
                    </div>
                    <div class="col-lg-7">
                        <h2 class=""><b>{{$inventory->itemName}}</b></h2><br />
                        <h4 class=""><s>₹{{$inventory->strikerPrice}}</s>&nbsp;₹{{$inventory->actualPrice}}</h4>
                        <p class="">{{$inventory->itemDescription}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br />
<div class="row">
    <div class="card">
    <h2 class="mt-3 text-center"><b>Other Information</b></h2><br/>
        <div class="row">
            <div class="col-lg-6">
                <h4 class="">Offer badge: <span class="badge badge-pill badge-danger">{{$inventory->offerBadge}}</span>
                </h4>
            </div>
            <div class="col-lg-6">
                <h4 class="">Dimensions: {{$inventory->dimensions}}</h4>
            </div>
            <div class="col-lg-6">
                <h4 class="">Size: {{$inventory->size}}</h4>
            </div>
            <div class="col-lg-6">
                <h4 class="">Quantity: {{$inventory->quantity}}</h4>
            </div>
            <div class="col-lg-6">
                <h4 class="">Sales Pitch: {{$inventory->salePitch}}</h4>
            </div>
            <div class="col-lg-6">
                <h4 class="">Important Note: {{$inventory->importantNote}}</h4>
            </div>
        </div>
    </div>
</div>
<br />
<div class="row">
    <div class="card">
        <div class="row">
            <h2 class="mt-3 text-center"><b>Other Product Images</b></h2>
            @if($inventory->productimg1 != "" || $inventory->productimg2 != "" || $inventory->productimg3 != "")
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $inventory->productimg1}}"
                        class="img-fluid mt-3" alt="Image Could Not Be Loaded Due To Some Error"/><br/><br/>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $inventory->productimg2}}"
                        class="img-fluid mt-3" alt="Image Could Not Be Loaded Due To Some Error"/><br/><br/>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $inventory->productimg3}}"
                        class="img-fluid mt-3" alt="Image Could Not Be Loaded Due To Some Error"/><br/><br/>
                </div>
            @else
                <h5 class="mt-5 mb-5 text-center" style="color:red;">There are no images added as of now</h5>
            @endif
        </div>
    </div>
</div>
<script>
    $('.nav-category-inventory').addClass('active');
</script>
<x-admin-footer />