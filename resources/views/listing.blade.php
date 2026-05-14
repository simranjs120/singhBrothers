<x-header/>
<style>
    .product-image-frame {
        background: #f8f8f8;
        min-height: 420px;
    }

    .product-image-frame img {
        width: 100%;
        max-height: 520px;
        object-fit: contain;
    }

    .product-card-img {
        height: 240px;
        object-fit: contain;
        background: #f8f8f8;
    }

    .product-price {
        font-size: 32px;
    }
</style>
<main>
    <section class="py-5">
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

            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="product-image-frame d-flex align-items-center justify-content-center border border-dark rounded-3 p-3">
                        <img src="{{Helper::props('admin/inventoryImages') . '/' . $item->thumbnailimg}}"
                            class="img-fluid" alt="{{$item->itemName}}" />
                    </div>
                </div>
                <div class="col-lg-6">
                    @if($item->offerBadge != "")
                        <span class="badge background-secondary text-dark mb-3">{{$item->offerBadge}}</span>
                    @endif
                    <h1 class="text-dark fw-bold mb-3">{{$item->itemName}}</h1>
                    @if($item->importantNote != "")
                        <p class="color-secondary fw-bold mb-3">{{$item->importantNote}}</p>
                    @endif
                    <div class="product-price text-dark fw-bold mb-3">
                        @if($item->strikerPrice!="")
                            <span class="text-muted text-decoration-line-through me-2">Rs. {{$item->strikerPrice}}</span>
                        @endif
                        <span>Rs. {{$item->actualPrice}}</span>
                    </div>
                    @if($item->salePitch != "")
                        <p class="text-danger fw-bold mb-3">{{$item->salePitch}}</p>
                    @endif
                    <p class="text-muted mb-4">{{$item->itemDescription}}</p>
                    <div class="d-flex gap-3 flex-wrap">
                        <button type="button" class="background-secondary text-dark border border-1 border-dark rounded-3 fw-bold px-4 py-2"
                            onclick="return popProductModal('{{$item->itemName}}', event);">
                            Ask Us
                        </button>
                        <a href="{{url('/')}}" class="text-dark border border-dark rounded-3 fw-normal px-4 py-2 text-decoration-none">
                            Back to Home
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if(count($relatedItems) > 0)
        <section class="py-5">
            <div class="container">
                <div class="mb-4">
                    <h2 class="fw-bold"><span class="background-secondary text-dark px-1">Related</span> products</h2>
                    <p class="text-muted mb-0">More items from this category</p>
                </div>
                <div class="row g-4">
                    @foreach($relatedItems as $row)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{url('listing/' . base64_encode($row->id) . '/' . base64_encode($row->category_id) . '/' . base64_encode($row->sub_category_id))}}" class="text-decoration-none">
                                <div class="card h-100 border-0 shadow-sm">
                                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $row->thumbnailimg}}" class="img-fluid p-2 product-card-img" alt="{{$row->itemName}}" />
                                    <div class="card-body">
                                        @if($row->offerBadge!=="")
                                            <span class="badge background-secondary text-dark mb-2">{{$row->offerBadge}}</span>
                                        @endif
                                        <h4 class="text-dark fw-bold">{{$row->itemName}}</h4>
                                        @if($row->importantNote!=="")
                                            <p class="text-muted small mb-2">{{$row->importantNote}}</p>
                                        @endif
                                        <h5 class="text-dark fw-bold">
                                            @if($row->strikerPrice!="")
                                                <span class="text-muted text-decoration-line-through me-2">Rs. {{$row->strikerPrice}}</span>
                                            @endif
                                            Rs. {{$row->actualPrice}}
                                        </h5>
                                        @if($row->salePitch!="")
                                            <p class="text-danger fw-bold small mb-0">{{$row->salePitch}}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

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
                    <button type="submit" class="background-secondary text-dark border border-1 border-dark rounded-3 fw-bold px-4 py-2">Send Query</button>
                    <button type="button" class="btn btn-dark text-light" data-bs-dismiss="modal">Close</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</main>
<x-footer />
<script>
    function popProductModal(productName, e) {
        if (e) {
            e.preventDefault();
        }
        $('.product-field').val(productName);
        $('#exampleModalLabel').text("Product: " + productName);
        var queryModal = new bootstrap.Modal(document.getElementById('queryModal'));
        queryModal.show();
    }
</script>
