<x-Admin-header :profile="$profile" />
<style>
    .badge-danger {
        background-color: red;
        color: white;
        font-weight: bold;
    }

    textarea {
        /* width: 300px !important; */
        height: 150px !important;
    }
</style>
<div class="container-fluid px-3">
    <!-- Header -->
    <div class="row mb-3">
        <div class="col-12">
            <h1 class="mb-1">Manage Inventory</h1>
            <p class="text-muted small mb-0 mt-3">Admin / Manage Inventory / New Inventory Item</p>
        </div>
    </div>

    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <a href="javascript:history.back()" class="mb-4 text-decoration-none text-dark d-inline-flex align-items-center gap-2 fw-semibold">
                        <i class="bi bi-arrow-left"></i>Back
                    </a>
                    <p class="fs-4">Add New Inventory Item</p>
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
                    <form action="{{route('submit.inventory')}}" method="POST" enctype="multipart/form-data"
                        id="inventory_form">
                        @csrf
                        <!-- Row 1 -->
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3" style="background-color:red; color:white;">&nbsp;<b>Add Thumbnail
                                        Image</b></label><span class="asterik">*</span><br />
                                <img src="#" id="thumbnailpreview" class="img-fluid mb-3 mt-3" height="40%" width="40%"
                                    alt="Upload Image for Preview" />
                                <input type="file" name="thumbnailimg" id="thumbnailimg" class="form-control"
                                    required />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Product Image 1</b></label><br />
                                <img src="#" id="productpreview1" class="img-fluid mb-3 mt-3" height="40%" width="40%"
                                    alt="Upload Image for Preview" />
                                <input type="file" name="productimg1" id="productimg1" class="form-control" />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Product Image 2</b></label><br />
                                <img src="#" id="productpreview2" class="img-fluid mb-3 mt-3" height="40%" width="40%"
                                    alt="Upload Image for Preview" />
                                <input type="file" name="productimg2" id="productimg2" class="form-control" />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Product Image 3</b></label><br />
                                <img src="#" id="productpreview3" class="img-fluid mb-3 mt-3" height="40%" width="40%"
                                    alt="Upload Image for Preview" />
                                <input type="file" name="productimg3" id="productimg3" class="form-control" />
                            </div>
                        </div>

                        <!-- Row 2 -->
                        <div class="row mb-4">
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Item Name<span class="asterik">*</span></b></label>
                                <input type="text" name="itemName" class="form-control" maxlength="180" required
                                    placeholder="Enter Item Name..." required />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Striker Price <s>₹1000</s></b></label>
                                <input type="text" name="strikerPrice" class="form-control" maxlength="80"
                                    placeholder="₹ Only Enter Number Here..." />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Actual Price<span class="asterik">*</span></b></label>
                                <input type="text" name="actualPrice" class="form-control" maxlength="80"
                                    placeholder="₹ Only Enter Number Here..." required />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Any Offer Badge Text</b> <span
                                        class="badge badge-pill badge-danger">Festive sale</span></label>
                                <input type="text" name="offerBadge" class="form-control" maxlength="180"
                                    placeholder="30% Off" />
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Item Description<span class="asterik">*</span></b></label>
                                <textarea name="itemDescription" class="form-control" maxlength="1400"
                                    placeholder="Enter Item Description..." required></textarea>
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Dimensions (200x150)</b></label>
                                <input type="text" name="dimensions" class="form-control" maxlength="80"
                                    placeholder="Enter like: 20x30..." />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Size (cm/inches)</b></label>
                                <input type="text" name="size" class="form-control" maxlength="80"
                                    placeholder="Enter like: 20 cm/20 Inches..." />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Quantity<span class="asterik">*</span></b></label>
                                <input type="text" name="quantity" class="form-control" maxlength="80"
                                    placeholder="Enter only number here..." required />
                            </div>
                            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Sale Pitch (<span class="text-danger">Only Few Left,Hurry
                                            !!</span>)</b></label>
                                <input type="text" name="salePitch" class="form-control" maxlength="180"
                                    placeholder="Great Festival Sale !!" />
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Any Important Notes</b></label>
                                <input type="text" name="importantNote" class="form-control" maxlength="500"
                                    placeholder="Free delivery till tomorrow or pay delivery charge" />
                            </div>
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                                <label class="mt-3">&nbsp;<b>Select Product Collection<span class="asterik">*</span></b></label>
                                <p class="text-muted small mb-2">
                                    Choose the final path for this item, for example Frames / Italian / 3mm.
                                </p>
                                <select class="form-control" name="collection_id" style="color:black !important;"
                                    required>
                                    <option selected disabled value="">-- Select collection path --</option>
                                    @foreach($collections as $row)
                                        <option value="{{$row->id}}">{{$row->collection}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                                <button type="submit" class="btn btn-sm py-2 px-4 fw-bold rounded-3 background-secondary text-dark border border-dark text-decoration-none">Submit</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('.nav-category-inventory').addClass('active');

    $('#inventory_form').submit(function (e) {
        e.preventDefault();
        Swal.fire({
            position: "center",
            icon: "info",
            title: "<b>Please do not refresh the page, Site will auto-refresh...</b>",
            background: 'white',
            showConfirmButton: false,
        });
        $('#inventory_form').submit();
    })

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
    // Check file sizes, if less than 10 MB set preview
    const thumbnailUpload = document.getElementById("thumbnailimg");
    thumbnailUpload.onchange = function () {
        if (this.files[0].size > 10943040) {
            fileSizeError();
            this.value = "";
        } else {
            const [file] = thumbnailUpload.files
            if (file) {
                thumbnailpreview.src = URL.createObjectURL(file)
            }
        }
    };

    // Check file sizes, if less than 10 MB set preview
    const productpreview1File = document.getElementById("productimg1");
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

    // Check file sizes, if less than 10 MB set preview
    const productpreview2File = document.getElementById("productimg2");
    productpreview2File.onchange = function () {
        if (this.files[0].size > 10943040) {
            fileSizeError();
            this.value = "";
        } else {
            const [file] = productpreview2File.files
            if (file) {
                productpreview2.src = URL.createObjectURL(file)
            }
        }
    };

    // Check file sizes, if less than 10 MB set preview
    const productpreview3File = document.getElementById("productimg3");
    productpreview3File.onchange = function () {
        if (this.files[0].size > 10943040) {
            fileSizeError();
            this.value = "";
        } else {
            const [file] = productpreview3File.files
            if (file) {
                productpreview3.src = URL.createObjectURL(file)
            }
        }
    };
</script>
<x-admin-footer />
