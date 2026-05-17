<x-header/>
<style>
    .category-product-img {
        height: 250px;
        object-fit: contain;
        background: #f8f8f8;
    }
</style>
<main>
    <section class="background-primary py-5">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-8">
                    <span class="badge background-secondary text-dark mb-3">Product Category</span>
                    <h1 class="text-light fw-bold mb-3">{{$category->category}}</h1>
                    <p class="text-light mb-0">
                        Browse active products from this category. Select any item to view details and send an enquiry.
                    </p>
                </div>
                <div class="col-lg-4">
                    <div class="border border-light rounded-3 p-4 text-light">
                        <h4 class="fw-bold mb-1">{{count($inventory)}}</h4>
                        <p class="mb-0">Active products available</p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="py-5">
        <div class="container">

            @if(count($inventory) > 0)
                <div class="row g-4">
                    @foreach($inventory as $row)
                        <div class="col-lg-4 col-md-6">
                            <a href="{{url('listing/' . base64_encode($row->id) . '/' . base64_encode($row->category_id) . '/' . base64_encode($row->sub_category_id))}}" class="text-decoration-none">
                                <div class="card h-100 shadow-sm border border-1 border-dark">
                                    <img src="{{Helper::props('admin/inventoryImages') . '/' . $row->thumbnailimg}}" class="img-fluid p-2 category-product-img" alt="{{$row->itemName}}" />
                                    <div class="card-body">
                                        @if($row->offerBadge !== "")
                                            <span class="badge background-secondary text-dark mb-2">{{$row->offerBadge}}</span>
                                        @endif
                                        <h4 class="text-dark fw-bold">{{$row->itemName}}</h4>
                                        @if($row->importantNote !== "")
                                            <p class="text-muted small mb-2">{{$row->importantNote}}</p>
                                        @endif
                                        <h5 class="text-dark fw-bold">
                                            @if($row->strikerPrice != "")
                                                <span class="text-muted text-decoration-line-through me-2">Rs. {{$row->strikerPrice}}</span>
                                            @endif
                                            Rs. {{$row->actualPrice}}
                                        </h5>
                                        @if($row->salePitch != "")
                                            <p class="text-danger fw-bold small mb-0">{{$row->salePitch}}</p>
                                        @endif
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="border border-dark rounded-3 p-5 text-center">
                    <h3 class="fw-bold">No products found</h3>
                    <p class="text-muted mb-0">There are no active products in this category yet.</p>
                </div>
            @endif
        </div>
    </section>
</main>
<x-footer />
