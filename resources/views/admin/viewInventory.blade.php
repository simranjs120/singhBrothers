<x-Admin-header :profile="$profile" />
<style>
    .badge:hover {
        cursor: pointer;
    }
</style>

<div class="container-fluid px-3">
  <!-- Header -->
  <div class="row mb-3">
    <div class="col-12">
      <h1 class="mb-1">Add New User</h1>
      <p class="text-muted small mb-0 mt-3">Admin / Add New User</p>
    </div>
  </div>

  <div class="row mb-4">
    <div class="col-12">
      <div class="card shadow-sm">
        <div class="card-body">
            <a href="{{url('admin/edit-inventory/'.$inventoryId)}}">
                    <button type="button" class="pull-right btn btn-success m-2 mt-2 text-light">Edit this item</button>
                </a>
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
                            class="img-fluid" alt="Image Could Not Be Loaded"/>
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
        <h2 class="mt-3 text-center"><b><u>Other Information</u></b></h2><br/>
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
            <h2 class="mt-3 text-center"><b><u>Other Product Images</u></b></h2>
            @if($inventory->productimg1 != "" || $inventory->productimg2 != "" || $inventory->productimg3 != "")
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $inventory->productimg1}}"
                        class="img-fluid mt-3" alt="Image Could Not Be Loaded"/><br/><br/>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12">
                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $inventory->productimg2}}"
                        class="img-fluid mt-3" alt="Image Could Not Be Loaded"/><br/><br/>
                </div>
                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 ">
                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $inventory->productimg3}}"
                        class="img-fluid mt-3" alt="Image Could Not Be Loaded"/><br/><br/>
                </div>
            @else
                <h5 class="mt-5 mb-5 text-center" style="color:red;">There are no images added as of now</h5>
            @endif
        </div>
    </div>
</div>
</div>
<script>
    $('.nav-category-inventory').addClass('active');
</script>
<x-admin-footer />