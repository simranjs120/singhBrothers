<x-header/>
<style>
    #header {
        background-color: black;
        margin-bottom: 100px !important;
    }

    .badge-spotlight {
        margin-bottom: 12px;
    }
</style>
<main><br><br>
    <section id="" class="mt-5">
        <div class="container">
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
                <div class="col-sm-12">
                    <div class="mb-4">
                        <div class="row">
                            <div class="col-lg-5">
                                <img src="{{Helper::props('admin/inventoryImages') . '/' . $item->thumbnailimg}}"
                                    class="img-fluid" alt="Image Could Not Be Loaded" />
                            </div>
                            <div class="col-lg-7">
                                <h2 class=""><b>{{$item->itemName}}</b></h2>
                                @if($item->offerBadge != "")<span
                                class='badge badge-spotlight'>{{$item->offerBadge}}</span><br />@endif
                                @if($item->importantNote != "")
                                <h6 class=""><b>**{{$item->importantNote}}**</b></h6>@endif
                                <h4 class="">@if($item->strikerPrice!="")<s>₹{{$item->strikerPrice}}</s>&nbsp;@endif₹{{$item->actualPrice}}</h4>
                                @if($item->salePitch != "")
                                <h6 class="text-danger"><b>{{$item->salePitch}}</b></h6>@endif
                                <p class="">{{$item->itemDescription}}</p>
                                <button type='button' class='btn btn-primary mt-2'
                                    onclick="return popProductModal('{{$item->itemName}}');">Ask Us</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br /><br />
        <div class="container">
            <div class="row">
                <h3 class="text-center"><b>Related Products You Might Like</b></h3>
                @foreach($relatedItems as $row)
                <div class="col-lg-4 mt-4">

                <a href="{{env('APP_URL')}}/listing/{{base64_encode($row->id)}}/{{base64_encode($row->category_id)}}/{{base64_encode($row->sub_category_id)}}">
                    <div class="card">
                        <img src="{{Helper::props('admin/inventoryImages') . '/' . $row->thumbnailimg}}" class="img-fluid p-2" />
                        @if($row->offerBadge!=="")
                        <p style="text-align:left; margin-left:10px;">
                            <span class="badge badge-spotlight">{{$row->offerBadge}}</span>
                        </p>
                        @endif
                        <h4 class="spotlight-itemName">{{$row->itemName}}</h4>
                        @if($row->importantNote!=="")<p class="text-dark text-start" style="margin:0px 0px 0px 10px;">{{$row->importantNote}}</p>@endif
                        <h4 class="spotlight-pricetag">
                            @if($row->strikerPrice!="")<s>₹{{$row->strikerPrice}}</s>&nbsp;@endif₹{{$row->actualPrice}}
                        </h4>
                        @if($row->salePitch!="")
                        <h6 class="text-danger" style="font-weight:bold;text-align:left; padding-left:10px;">{{$row->salePitch}}</h6>
                        @endif
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary"
                                style="width:30%; margin:10px 0px 25px 10px;" onclick="return popProductModal('{{$row->itemName}}');">Ask Us</button>
                        </div>
                    </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>

    </section>
    <!-- Add Product Query Modal -->
    <div class="modal fade" id="queryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ask a query from us</h5>
                </div>
                <div class="modal-body">
                    <form action="{{route('submit.query')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product" class="form-control mt-1 border border-dark product-field"
                            required maxlength="99" placeholder="Product in question" />
                        <input type="text" name="name" class="form-control mt-1 border border-dark" required
                            maxlength="99" placeholder="Your Name" />
                        <input type="email" name="email" class="form-control mt-1 border border-dark mt-3" required
                            maxlength="99" placeholder="Your email" />
                        <input type="text" name="phone" class="form-control mt-1 border border-dark mt-3" required
                            placeholder="Your Phone Number" pattern="[0-9]{10}" title="Enter 10 digit mobile number" />
                        <textarea class="form-control mt-3 border-dark" required name="message"
                            placeholder="Your Query/Message" maxlength="499"></textarea>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send Query</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>
<x-footer />
<script>
    function popProductModal(productName, e) {
        $('#queryModal').modal('show');
        $('.product-field').val(productName);
        $('#exampleModalLabel').text("Product: " + productName);
        e.preventDefault();
    }
</script>