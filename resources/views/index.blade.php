<x-header/>
<style>
  #queryModal .modal-content {
    background-color: var(--dark-color) !important;
    border: 2px solid #fff;
    border-radius: 10px;
    color: #fff !important;
  }

  #queryModal .modal-header,
  #queryModal .modal-footer {
    border-color: #2a2a2a;
  }

  #queryModal .form-control,
  #queryModal textarea {
    background-color: var(--primary-color) !important;
    border: 1px solid var(--secondary-color) !important;
    color: #fff !important;
  }

  #queryModal .form-control::placeholder {
    color: #aaa !important;
  }

  #queryModal .btn-primary {
    background-color: var(--secondary-color) !important;
    border: none !important;
    color: #000 !important;
    font-weight: 500;
  }

  #queryModal .btn-danger {
    background-color: transparent !important;
    border: 1px solid #fff !important;
    color: #fff !important;
  }
</style>
@php
  $whatsappContact = preg_replace('/\D+/', '', env('WHATSAPP_CONTACT', '919811428583'));
@endphp
<!-- ======= Hero Section ======= -->
<section id="hero" class="d-flex align-items-center justify-content-center">
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
      <div class="col-lg-6">
        <h1 class="text-light fw-bold mt-0 mt-lg-5">Premium <span class="color-secondary">Photo
            Frames</span>.<br />Perfect Finishes.</h1>
        <!-- Pills -->
        <div class="d-flex flex-wrap gap-2 mb-4 mt-3">
          <span class="badge rounded-pill border px-3 py-2 border-light color-secondary">Photo Frames</span>
          <span class="badge rounded-pill border px-3 py-2 border-light color-secondary">Glass</span>
          <span class="badge rounded-pill border px-3 py-2 border-light color-secondary">Pins</span>
          <span class="badge rounded-pill border px-3 py-2 border-light color-secondary">Mouldings</span>
          <span class="badge rounded-pill border px-3 py-2 border-light color-secondary">Art Pieces</span>
          <span class="badge rounded-pill border px-3 py-2 border-light color-secondary">Collages</span>
        </div>
        <h4 class="text-light">Trusted craftsmanship and a wide collection to suit every home and office. Custom orders
          also available</h2>
          <button type="button"
            class="background-secondary px-3 py-3 border border-0 text-dark fw-bold mt-3 rounded-3">Explore our
            collection</button>
      </div>
      <div class="col-lg-6 d-none d-lg-block">
        <img src="{{Helper::props('assets/img/hero-img.png')}}" class="img-fluid" />
      </div>
    </div>
  </div>
</section><!-- End Hero -->

<!-- ======= Why Choose Us Section ======= -->
<section class="py-2">
  <div class="container text-dark">

    <div class="mb-5">
      <h2 class="fw-bold mt-5">Why Choose Us</h2>
      <p class="text-dark">Quality workmanship and reliable service you can trust</p>
    </div>

    <div class="row g-4">

      <div class="col-lg-3 col-md-6">
        <div class="gap-3">
          <i class="bi bi-gem fs-1 color-secondary"></i>
          <div>
            <h4 class="mb-1 fw-bold">Premium Quality</h4>
            <p class="mb-0 text-dark">
              Finest materials used to ensure durability and a refined finish.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="gap-3">
          <i class="bi bi-aspect-ratio fs-1 color-secondary"></i>
          <div>
            <h4 class="mb-1 fw-bold">Custom Sizes</h4>
            <p class="mb-0 text-dark">
              Frames and glass solutions tailored to your exact requirements.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="gap-3">
          <i class="bi bi-grid fs-1 color-secondary"></i>
          <div>
            <h4 class="mb-1 fw-bold">Wide Variety</h4>
            <p class="mb-0 text-dark">
              A large collection of frames, mouldings and art pieces to choose from.
            </p>
          </div>
        </div>
      </div>

      <div class="col-lg-3 col-md-6">
        <div class="gap-3">
          <i class="bi bi-hand-thumbs-up fs-1 color-secondary"></i>
          <div>
            <h4 class="mb-1 fw-bold">Trusted Service</h4>
            <p class="mb-0 text-dark">
              Years of experience with a commitment to customer satisfaction.
            </p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<div class="d-flex justify-content-center my-5">
  <hr style="width:320px; height:2px; background-color:#C8A96A; border:none; opacity:1;">
</div>
<!-- ======= Our way of working Section ======= -->
<section class="py-2">
  <div class="container">

    <!-- Heading -->
    <div class="mb-5">
      <h2 class="fw-bold">Our Way of Working</h2>
      <p class="text-muted mb-0">
        Simple process, just like you visit a shop
      </p>
    </div>

    <div class="row g-4 text-center">

      <!-- Step 1 -->
      <div class="col-lg-3 col-md-6">
        <div class="p-4 h-100 border rounded-3 background-primary">
          <div class="mb-3 d-flex align-items-center justify-content-center rounded-circle mx-auto background-secondary"
            style="width:85px; height:85px;">
            <i class="bi bi-telephone fs-1 text-dark"></i>
          </div>
          <h4 class="fw-semibold text-light">Call or Message Us</h4>
          <p class="small mb-0 text-light">
            Just give us a call or message on WhatsApp.
          </p>
        </div>
      </div>

      <!-- Step 2 -->
      <div class="col-lg-3 col-md-6">
        <div class="p-4 h-100 border rounded-3 background-primary">
          <div class="mb-3 d-flex align-items-center justify-content-center rounded-circle mx-auto background-secondary"
            style="width:85px; height:85px;">
            <i class="bi bi-images fs-1 text-dark"></i>
          </div>
          <h4 class="fw-semibold text-light">See Options</h4>
          <p class="small mb-0 text-light">
            We will show you designs and samples.
          </p>
        </div>
      </div>

      <!-- Step 3 -->
      <div class="col-lg-3 col-md-6">
        <div class="p-4 h-100 border rounded-3 background-primary">
          <div class="mb-3 d-flex align-items-center justify-content-center rounded-circle mx-auto background-secondary"
            style="width:85px; height:85px;">
            <i class="bi bi-check-circle fs-1 text-dark"></i>
          </div>
          <h4 class="fw-semibold text-light">Confirm Order</h4>
          <p class="small mb-0 text-light">
            Finalize your choice and place the order.
          </p>
        </div>
      </div>

      <!-- Step 4 -->
      <div class="col-lg-3 col-md-6">
        <div class="p-4 h-100 border rounded-3 background-primary">
          <div class="mb-3 d-flex align-items-center justify-content-center rounded-circle mx-auto background-secondary"
            style="width:85px; height:85px;">
            <i class="bi bi-box-seam fs-1 text-dark"></i>
          </div>
          <h4 class="fw-semibold text-light">Ready & Delivered</h4>
          <p class="small mb-0 text-light">
            Your order will be ready or delivered safely.
          </p>
        </div>
      </div>

    </div>

  </div>
</section>

<div class="d-flex justify-content-center my-5">
  <hr style="width:320px; height:2px; background-color:#C8A96A; border:none; opacity:1;">
</div>


<!-- ======= Categories Section ======= -->
<section class="py-5">
  <div class="container">

    <!-- Heading -->
    <div class="mb-5">
      <h2 class="fw-bold">Our Categories</h2>
      <p class="text-muted">Explore our range of products</p>
    </div>

    @php
      $categoryImages = [
        'photo frames' => Helper::props('assets/img/portfolio/portfolio-1.jpg'),
        'frames' => Helper::props('assets/img/portfolio/portfolio-2.jpg'),
        'pins' => Helper::props('assets/img/portfolio/portfolio-3.jpg'),
        'mouldings' => Helper::props('assets/img/portfolio/portfolio-4.jpg'),
        'glass' => Helper::props('assets/img/portfolio/portfolio-5.jpg'),
        'art' => Helper::props('assets/img/portfolio/portfolio-6.jpg'),
        'art pieces' => Helper::props('assets/img/portfolio/portfolio-6.jpg'),
      ];
      $genericCategoryImage = Helper::props('assets/img/hero-img.png');
    @endphp

    <!-- Grid -->
    <div class="row g-4">
      @foreach($category->where('parent_id', 0)->where('slug', '!=', null) as $categoryItem)
        @php
          $categoryName = strtolower(trim($categoryItem->category));
          $categoryImage = $categoryImages[$categoryName] ?? $genericCategoryImage;
        @endphp
        <div class="col-12 col-sm-6 col-lg-3">
          <a href="{{url($categoryItem->slug)}}" class="text-decoration-none text-dark">
            <div class="card h-100 border border-dark border-opacity-10 shadow-sm overflow-hidden">
              <img src="{{$categoryImage}}" class="card-img-top" alt="{{$categoryItem->category}}" style="height:190px; object-fit:cover;">
              <div class="card-body text-start">
                <h3 class="h5 fw-bold mb-0">{{$categoryItem->category}}</h3>
              </div>
            </div>
          </a>
        </div>
      @endforeach

    </div>
  </div>
</section>


<main id="main">

  <!----------------------------------------------------------------Spotlight Section Start ------------------------------------------------------------------------------------>
  @if($inner_section_spotlight != "" && !empty(json_decode($inventory_section_spotlight)) && $inventoryItemsCount > 0)
    @php
      /* Fetching all the inventory IDs from $inventory_section_spotlight array & put them in dynamic hidden fields, then fetch those hidden field's
       value from javascript & put them in a js array, Then make an ajax call with those IDs & fetch actual inventory items. */
      $spotlightCount = 0;
      foreach ($inventory_section_spotlight as $row) {
        echo "<input type='hidden' id='inventory_item_" . $spotlightCount . "' value='" . $row->inventory_id . "' />";
        $spotlightCount++;
      }
    @endphp
    <section id="spotlight" class="spotlight">
      <div class="container">
        <div>
          <h2 class="spotlight-heading">{{$inner_section_spotlight->name}}</h2>
          <p>{{$inner_section_spotlight->description}}</p>
          <center>
            <div class="loader-spotlight"></div>
          </center>
          <div class='container'>
            <div class="spotlight-render-here">
            </div>
          </div>

          @if($inner_section_spotlight->button == 1)<a class="spotlight-btn" href="{{$inner_section_spotlight->url}}">Take
          a look</a>@endif

        </div>
      </div>
    </section>
  @endif
  <!----------------------------------------------------------------Spotlight Section End ------------------------------------------------------------------------------------>

  <!----------------------------------------------------------------Dynamic Sections Start ------------------------------------------------------------------------------------>
  @if($inner_sections != "" && !empty(json_decode($inventory_section_dynamic)) && $inventoryItemsCount > 0)
    @php
      /* Setup the $inventory_section_dynamic variable here that is coming from indexController, it contains the ids of the inventory items 
       and sections, Later fetch this in ajax function fetchDynamicSections() below from ID of this field. */
      echo "<input type='hidden' id='dynamic_section_array' value='" . $inventory_section_dynamic . "' />";
    @endphp
    <section id="dynamicSections" class="dynamicSections">
      <div class="container">
        <center>
          <div class="loader-sections"></div>
        </center>
        <div class="render-dynamic-sections">
        </div>
      </div>
    </section>
  @endif
  <!----------------------------------------------------------------Dynamic Sections End ------------------------------------------------------------------------------------>
  <!-- ======= Counts Section ======= -->
<section id="counts" class="counts">
  <div class="container">

    <div class="row no-gutters">
      <div class="image col-xl-5 d-flex align-items-stretch justify-content-center justify-content-lg-start"></div>

      <div class="col-xl-7 ps-4 ps-lg-5 pe-4 pe-lg-1 d-flex align-items-stretch">
        <div class="content d-flex flex-column justify-content-center">

          <h3>Preserving Your Precious Memories with Beautiful Frames</h3>

          <p>
            We offer a wide collection of premium photo frames designed to turn your special moments into timeless memories.
            From modern designs to classic wooden frames, we help you decorate your home and gift your loved ones with elegance.
          </p>

          <div class="row">

            <div class="col-md-6 d-md-flex align-items-md-stretch">
              <div class="count-box">
                <i class="bi bi-emoji-smile"></i>

                <span data-purecounter-start="0" data-purecounter-end="500"
                  data-purecounter-duration="2" class="purecounter"></span>

                <p>
                  <strong>Happy Customers</strong> who trusted us to frame their beautiful memories with quality and care.
                </p>
              </div>
            </div>

            <div class="col-md-6 d-md-flex align-items-md-stretch">
              <div class="count-box">
                <i class="bi bi-images"></i>

                <span data-purecounter-start="0" data-purecounter-end="1200"
                  data-purecounter-duration="2" class="purecounter"></span>

                <p>
                  <strong>Frames Delivered</strong> in various styles, sizes, and custom designs for every occasion.
                </p>
              </div>
            </div>

            <div class="col-md-6 d-md-flex align-items-md-stretch">
              <div class="count-box">
                <i class="bi bi-clock-history"></i>

                <span data-purecounter-start="0" data-purecounter-end="10"
                  data-purecounter-duration="3" class="purecounter"></span>

                <p>
                  <strong>Years of Experience</strong> in crafting elegant photo frame solutions with attention to detail.
                </p>
              </div>
            </div>

            <div class="col-md-6 d-md-flex align-items-md-stretch">
              <div class="count-box">
                <i class="bi bi-award"></i>

                <span data-purecounter-start="0" data-purecounter-end="50"
                  data-purecounter-duration="3" class="purecounter"></span>

                <p>
                  <strong>Custom Designs</strong> created for weddings, birthdays, family portraits, and special gifts.
                </p>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

  </div>
</section>
  <!-- End Counts Section -->

  <!-- ======= Contact Section ======= -->
  <section id="contact" class="contact">
    <div class="container">

      <div class="section-title">
        <h2>Contact</h2>
        <p>Contact Us</p>
      </div>

      <!-- <div>
        <iframe style="border:0; width: 100%; height: 270px;"
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
          frameborder="0" allowfullscreen></iframe>
      </div> -->

      <div class="row mt-5">

        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>RZ-201-A, Sayed Village, Paschim Vihar, New Delhi-110087</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>satnam9811428583@gmail.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>+91 9811428583</p>
            </div>

          </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">

          <form action="{{route('submit.contact')}}" method="POST" class="php-email-form">
            @csrf
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required
                  maxlength="99">
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required
                  maxlength="99">
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone Number" required
                pattern="[0-9]{10}" title="Enter 10 digit mobile number">
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required
                maxlength="499"></textarea>
            </div>
            <div class="text-center"><button type="submit">Send Message</button></div>
          </form>

        </div>

      </div>

    </div>
  </section><!-- End Contact Section -->

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
            <input type="hidden" name="product" class="form-control mt-1 border border-dark product-field" required
              maxlength="99" placeholder="Product in question" />
            <input type="text" name="name" class="form-control mt-1 border border-dark" required maxlength="99"
              placeholder="Your Name" />
            <input type="email" name="email" class="form-control mt-1 border border-dark mt-3" required maxlength="99"
              placeholder="Your email" />
            <input type="text" name="phone" class="form-control mt-1 border border-dark mt-3" required
              placeholder="Your Phone Number" pattern="[0-9]{10}" title="Enter 10 digit mobile number" />
            <textarea class="form-control mt-3 border-dark" required name="message" placeholder="Your Query/Message"
              maxlength="499"></textarea>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary">Send Query</button>
          <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>
        </form>
      </div>
    </div>
  </div>

</main><!-- End #main -->

<x-footer />
<script>

  $(document).ready(function () {
    fetchDynamicSections();
  });

  function popProductModal(productName, e) {
    if (e) {
      e.preventDefault();
    }
    $('.product-field').val(productName);
    $('#exampleModalLabel').text("Product: " + productName);
    var queryModal = new bootstrap.Modal(document.getElementById('queryModal'));
    queryModal.show();
  }

  function productPriceHtml(item) {
    var strikerPrice = item.strikerPrice ? "<span class='text-muted text-decoration-line-through me-2'>&#8377;" + item.strikerPrice + "</span>" : "";
    return "<div class='mb-2'>" + strikerPrice + "<span class='fw-bold text-dark'>&#8377;" + item.actualPrice + "</span></div>";
  }

  function productCardHtml(item, imgPath, href) {
    var offerBadge = item.offerBadge ? "<span class='badge bg-danger mb-2'>" + item.offerBadge + "</span>" : "";
    var importantNote = item.importantNote ? "<p class='text-muted small mb-2'>" + item.importantNote + "</p>" : "";
    var salePitch = item.salePitch ? "<p class='text-danger fw-semibold small mb-3'>" + item.salePitch + "</p>" : "";
    var whatsAppText = encodeURIComponent("Hi, I want to ask about " + item.itemName);
    var whatsAppUrl = "https://wa.me/{{$whatsappContact}}?text=" + whatsAppText;
    var imageHtml = "<img src='" + imgPath + "/" + item.thumbnailimg + "' class='card-img-top' alt='Image could not be loaded' style='height:220px; object-fit:cover;'>";
    var titleHtml = "<h5 class='fw-semibold mb-2 text-dark'>" + item.itemName + "</h5>";

    if (href) {
      imageHtml = "<a href='" + href + "'>" + imageHtml + "</a>";
      titleHtml = "<a href='" + href + "' class='text-decoration-none'><h5 class='fw-semibold mb-2 text-dark'>" + item.itemName + "</h5></a>";
    }

    var card =
      "<div class='card h-100 border border-dark border-opacity-10 shadow-sm overflow-hidden'>" +
      imageHtml +
      "<div class='card-body'>" +
      titleHtml +
      offerBadge +
      importantNote +
      productPriceHtml(item) +
      salePitch +
      "<div class='d-flex justify-content-start align-items-center gap-2 flex-wrap'>" +
      "<button type='button' class='background-secondary text-dark border border-1 border-dark rounded-3 fw-bold px-4 py-2 redirectBlock' onclick='return popProductModal(\"" + item.itemName + "\");'>Ask Now</button>" +
      "<a href='" + whatsAppUrl + "' target='_blank' class='d-inline-flex align-items-center gap-2 fw-bold px-4 py-2 rounded-3 text-white text-decoration-none border border-1 border-dark' style='background-color:#25D366;'><i class='bi bi-whatsapp'></i>Ask on WhatsApp</a>" +
      "</div>" +
      "</div>" +
      "</div>";

    return card;
  }

  <?php
# Validate if dynamic section is not empty for any reason then only trigger the ajax.
if ($inner_sections != "" && !empty(json_decode($inventory_section_dynamic)) && $inventoryItemsCount > 0) {
  ?>
  /************************************************** Fetch dynamic content Start ************************************************************/
  function fetchDynamicSections() {
    var json = $("#dynamic_section_array").val();
    // Ajax call to fetch inventory items based on IDs
    $.ajax({
      url: "{{url('admin/fetch-dynamic-item-from-id')}}",
      method: 'GET',
      dataType: 'json',
      data: {
        array: json
      },
      success: function (response) {
        var imgPath = "{{Helper::props('admin/inventoryImages/')}}";
        var count = response.countOfDynamicItems;
        for (let i = 0; i <= count - 1; i++) {
          
          if (response.data[i].section_data.type == "horizontal" && response.data[i].inventory_ids.length != 0) {
            var heading = "<div class='galaxy container mt-4'>" +
              "<div class='section-title'>" +
              "<h2 class='text-dark'>" + response.data[i].section_data.name + "</h2>" +
              "<p class='text-dark'>" + (response.data[i].section_data.description || '') + "</p>" +
              "</div>" +
              "<div class='row'>";

            $('.render-dynamic-sections').append(heading);

            for (var g = 0; g <= response.data[i].inventory_ids.length - 1; g++) { // Count and render the internal inventory details.
              var content =
                "<div class='col-lg-4 col-md-6 d-flex align-items-stretch p-2'>" +
                "<a href='{{env('APP_URL')}}/listing/" + btoa(response.data[i].inventory_ids[g].id) + "/" + btoa(response.data[i].inventory_ids[g].category_id) + "/" + btoa(response.data[i].inventory_ids[g].sub_category_id) + "'>" +
                "<div class='icon-box'>" +
                "<img src='" + imgPath + '/' + response.data[i].inventory_ids[g].thumbnailimg + "' class='img-fluid text-dark' alt='Image could not be loaded'>" +
                "<h4 class='mt-4 text-dark'>" + response.data[i].inventory_ids[g].itemName + "</h4>" +
                "<span class='badge badge-spotlight'>" + (response.data[i].inventory_ids[g].offerBadge || '') + "</span>" +
                "<h6 class='text-dark mt-2'>" + (response.data[i].inventory_ids[g].importantNote || '') + "</h6>" +
                "<h5 class='dynamic-amount text-dark mt-2'><s>" + (response.data[i].inventory_ids[g].strikerPrice || '') + "</s> ₹" + response.data[i].inventory_ids[g].actualPrice + "</h5>" +
                "<h6 class='text-danger'><b>" + (response.data[i].inventory_ids[g].salePitch || '') + "</b></h6>" +
                "<button type='button' class='btn btn-primary mt-2 redirectBlock' onclick='return popProductModal(\"" + response.data[i].inventory_ids[g].itemName + "\");'>Ask Now</button>" +
                "</div>" +
                "</a>" +
                "</div>";

              var itemHref = "{{env('APP_URL')}}/listing/" + btoa(response.data[i].inventory_ids[g].id) + "/" + btoa(response.data[i].inventory_ids[g].category_id) + "/" + btoa(response.data[i].inventory_ids[g].sub_category_id);
              content = "<div class='col-lg-4 col-md-6 d-flex align-items-stretch p-2'>" + productCardHtml(response.data[i].inventory_ids[g], imgPath, itemHref) + "</div>";
              $('.render-dynamic-sections').children().last().find('.row').append(content);
            }

            // Ending the ROW & div here as all the items are already rendered. validate if button is there
            var footer;
            if (response.data[i].section_data.button == 1) {
              footer = "</div><br/>" +
                "<div class='text-center'><a href='" + response.data[i].section_data.url + "' class='background-secondary text-dark border border-1 border-dark rounded-3 fw-bold px-5 py-2 text-decoration-none'>View More <i class='bi bi-arrow-right'></i></a></div>" +
                "</div><br/><br/>";
            } else {
              footer = "</div>" +
                "</div><br/><br/>";
            }

            // Render
            $('.render-dynamic-sections').append(footer);
            // Prevent click inside on buttons in cards
            $('.redirectBlock').on('click', function (e) {
              if ($(e.target).is('.redirectBlock')) {
                e.preventDefault();
              }
            });
          }
          
          if (response.data[i].section_data.type == "vertical" && response.data[i].inventory_ids.length != 0) {
            var heading = "<div class='star container mt-4'>" +
              "<div class='section-title'>" +
              "<h2 class='text-dark'>" + response.data[i].section_data.name + "</h2>" +
              "<p class='text-dark'>" + (response.data[i].section_data.description || '') + "</p>" +
              "</div>" +
              "<div class='star-box'>";

            // Append heading to the section
            $('.render-dynamic-sections').append(heading);

            // Loop through inventory items
            for (var g = 0; g < response.data[i].inventory_ids.length; g++) { // Use < for length check
              var content =
                "<a href='{{env('APP_URL')}}/listing/" + btoa(response.data[i].inventory_ids[g].id) + "/" + btoa(response.data[i].inventory_ids[g].category_id) + "/" + btoa(response.data[i].inventory_ids[g].sub_category_id) + "'>" +
                "<div class='box m-3'>" +
                "<div class='row'>" +
                "<div class='col-lg-6 order-1 order-lg-2'>" +
                "<img src='" + imgPath + '/' + response.data[i].inventory_ids[g].thumbnailimg + "' class='img-fluid' alt='Image could not be loaded'>" +
                "</div>" +
                "<div class='col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content'>" +
                "<h3 class='text-dark'>" + response.data[i].inventory_ids[g].itemName + "</h3>" +
                "<span class='badge badge-spotlight'>" + (response.data[i].inventory_ids[g].offerBadge || '') + "</span>" +
                "<h6 class='text-dark mt-2'>" + (response.data[i].inventory_ids[g].importantNote || '') + "</h6>" +
                "<h5 class='dynamic-amount text-dark mt-2'><s>" + (response.data[i].inventory_ids[g].strikerPrice || '') + "</s> ₹" + response.data[i].inventory_ids[g].actualPrice + "</h5>" +
                "<h6 class='text-danger'><b>" + (response.data[i].inventory_ids[g].salePitch || '') + "</b></h6>" +
                "<p class='text-dark'>" + response.data[i].inventory_ids[g].itemDescription.substring(0, 400) + "...</p>" +
                "<button type='button' class='btn btn-primary mt-2 redirectBlock' onclick='return popProductModal(\"" + response.data[i].inventory_ids[g].itemName + "\");'>Ask Now</button>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</a><br/><br/><br/><br/>";
              var itemHref = "{{env('APP_URL')}}/listing/" + btoa(response.data[i].inventory_ids[g].id) + "/" + btoa(response.data[i].inventory_ids[g].category_id) + "/" + btoa(response.data[i].inventory_ids[g].sub_category_id);
              content = "<div class='mb-4'>" + productCardHtml(response.data[i].inventory_ids[g], imgPath, itemHref) + "</div>";
              // Append content to the last row
              $('.render-dynamic-sections').children().last().find('.star-box').append(content);
            }
            // Ending the ROW & div here as all the items are already rendered. validate if button is there
            var footer;
            if (response.data[i].section_data.button == 1) {
              footer = "</div>" +
                "<div class='text-center'><a href='" + response.data[i].section_data.url + "' class='background-secondary text-dark border border-1 border-dark rounded-3 fw-bold px-5 py-2 text-decoration-none'>View More <i class='bi bi-arrow-right'></i></a></div>" +
                "</div><br/><br/><br/>";
            } else {
              footer = "</div>" +
                "</div><br/><br/><br/>";
            }
            // Append footer
            $('.render-dynamic-sections').append(footer);
            // Prevent click inside on buttons in cards
            $('.redirectBlock').on('click', function (e) {
              if ($(e.target).is('.redirectBlock')) {
                e.preventDefault();
              }
            });
          }

        }
        $(".loader-sections").hide();

      },
      error: function (error) {
        // alert(JSON.stringify(error));
        alert("Fatal Error: Some content could not be loaded !!");
      }
    });
  }
  /************************************************** Fetch dynamic content End ************************************************************/
  <?php } ?>
</script>


