<x-Admin-header :profile="$profile" />
<style>
    .badge-danger{
        background-color: red;
        color: white;
        font-weight: bold;
    }
    textarea {
        /* width: 300px !important; */
        height: 150px !important;
    }
</style>
<div class="row">
    <div class="card">
        <div class="col-sm-12">
            <div class="home-tab">
                <h4 class="card-title card-title-dash mt-4 mb-4">Add New Inventory Item</h4>
                <form action="" method="" enctype="multipart/form-data" id="inventory_form">

                    <!-- Row 1 -->
                    <div class="row mb-4">
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3" style="background-color:red; color:white;">&nbsp;<b>Add Thumbnail Image</b></label><br/>
                            <img src="#" id="thumbnailpreview" class="img-fluid mb-3 mt-3" height="40%" width="40%" alt="Upload Image for Preview"/>
                            <input type="file" name="thumbnailimg" id="thumbnailimg" class="form-control" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Product Image 1</b></label><br/>
                            <img src="#" id="productpreview1" class="img-fluid mb-3 mt-3" height="40%" width="40%" alt="Upload Image for Preview"/>
                            <input type="file" name="productimg1" id="productimg1" class="form-control" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Product Image 2</b></label><br/>
                            <img src="#" id="productpreview2" class="img-fluid mb-3 mt-3" height="40%" width="40%" alt="Upload Image for Preview"/>
                            <input type="file" name="productimg2" id="productimg2" class="form-control" />
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Product Image 3</b></label><br/>
                            <img src="#" id="productpreview3" class="img-fluid mb-3 mt-3" height="40%" width="40%" alt="Upload Image for Preview"/>
                            <input type="file" name="productimg3" id="productimg3" class="form-control" />
                        </div>
                    </div>

                    <!-- Row 2 -->
                     <div class="row mb-4">
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Item Name</b></label>
                            <input type="text" name="itemName" class="form-control" maxlength="180" required placeholder="Enter Item Name..."/>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Striker Price <s>₹1000</s></b></label>
                            <input type="text" name="strikerPrice" class="form-control" maxlength="80" placeholder="₹ Only Enter Number Here..."/>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Actual Price</b></label>
                            <input type="text" name="actualPrice" class="form-control" maxlength="80" placeholder="₹ Only Enter Number Here..."/>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Any Offer Badge Text</b> <span class="badge badge-pill badge-danger">Diwali Special</span></label>
                            <input type="text" name="offerBadge" class="form-control" maxlength="180" placeholder="Enter any type of offer..."/>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Item Description</b></label>
                            <textarea name="itemDescription" class="form-control" maxlength="1400"  placeholder="Enter Item Description..."></textarea>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Dimensions (200x150)</b></label>
                            <input type="text" name="dimensions" class="form-control" maxlength="80" placeholder="Enter like: 20x30..."/>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Size (cm/inches)</b></label>
                            <input type="text" name="size" class="form-control" maxlength="80" placeholder="Enter like: 20 cm/20 Inches..."/>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Quantity</b></label>
                            <input type="text" name="quantity" class="form-control" maxlength="80" placeholder="Enter only number here..."/>
                        </div>
                        <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Sale Pitch (Only Few Left,Hurry !!)</b></label>
                            <input type="text" name="salePitch" class="form-control" maxlength="180" placeholder="Something like: Only a few left !!"/>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Any Important Notes</b></label>
                            <input type="text" name="importantNote" class="form-control" maxlength="500" placeholder="Any important note for customer..."/>
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <label class="mt-3">&nbsp;<b>Select Collection</b></label>
                            <select class="form-control" name="collection_id" style="color:black !important;" required>
                                <option selected disabled value="">--Select--</option>
                                @foreach($collections as $row)
                                    <option value="{{$row->id}}">{{$row->collection}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-5">
                            <button type="submit" class="w-100 btn btn-success btn-lg text-light">Submit</button>
                        </div>
                     </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    $('.nav-category-inventory').addClass('active');

    $('#inventory_form').submit(function(e){
        e.preventDefault();
        Swal.fire({
            position: "center",
            icon: "info",
            title: "<b>Please do not refresh the page, Site will auto-refresh...</b>",
            background:'white',
            showConfirmButton: false,
        });
        $('#inventory_form').submit();
    })

    // Set Thumnail Image Preview
    thumbnailimg.onchange = evt => {
        const [file] = thumbnailimg.files
        if (file) {
            thumbnailpreview.src = URL.createObjectURL(file)
        }
    }

    // Set Product 1 Image Preview
    productimg1.onchange = evt => {
        const [file] = productimg1.files
        if (file) {
            productpreview1.src = URL.createObjectURL(file)
        }
    }

    // Set Product 2 Image Preview
    productimg2.onchange = evt => {
        const [file] = productimg2.files
        if (file) {
            productpreview2.src = URL.createObjectURL(file)
        }
    }

    // Set Product 3 Image Preview
    productimg3.onchange = evt => {
        const [file] = productimg3.files
        if (file) {
            productpreview3.src = URL.createObjectURL(file)
        }
    }
</script>
<x-admin-footer />