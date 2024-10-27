<x-header :web="$web" />
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
    <div class="row justify-content-center landing-content">
      <div class="col-xl-10 col-lg-10">
        <h1>{{$web->title}} <span>{{$web->title_color}}</span></h1>
        <h2>{{$web->tagline}}</h2>
      </div>
    </div>

    <div class="row gy-4 mt-3 justify-content-center">

      <!-- <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-store-line"></i>
            <h3><a href="">Lorem Ipsum</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-bar-chart-box-line"></i>
            <h3><a href="">Dolor Sitema</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-calendar-todo-line"></i>
            <h3><a href="">Sedare Perspiciatis</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-paint-brush-line"></i>
            <h3><a href="">Magni Dolores</a></h3>
          </div>
        </div>
        <div class="col-xl-2 col-md-4">
          <div class="icon-box">
            <i class="ri-database-2-line"></i>
            <h3><a href="">Nemos Enimade</a></h3>
          </div>
        </div> -->
      <div class="searchpanelbase">
        <h4>{{$web->search_line}}</h4>
        <div id="search-container">
          <i class="ri-search-line"></i>
          <input type="text" class="form-control" id="search-tool" placeholder="Search here..." />
        </div>
        <button type="button" class="btn btn-success btn-lg">Search</button>
      </div>
    </div>

  </div>
</section><!-- End Hero -->

<main id="main">
  @if($web->category_pills == 1 && count($category)>0)
    <section id="categories">
    <div class="container d-flex justify-content-center">
      <div class="row">
      <div class="col-12">
        <h2 class="text-center mb-4">{{$web->pills_heading}}</h2>
        @foreach($category as $categoryset)
      <a href="#">
      <button class="button category-pill btn-lg">{{$categoryset->category}}</button>
      </a>
    @endforeach
      </div>
      </div>
    </div>
    </section>
  @endif
  <!-- ======= About Section ======= -->
  <section id="about" class="about">
    <div class="container">

      <div class="row">
        <div class="col-lg-6 order-1 order-lg-2">
          <img src="assets/img/about.jpg" class="img-fluid" alt="">
        </div>
        <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
          <h3>Why we provide you not only with frames but picture perfect memories. 🖼️</h3>
          <p class="fst-italic">
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
            dolore
            magna aliqua.
            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
          </p>
        </div>
      </div>

    </div>
  </section><!-- End About Section -->

  <!----------------------------------------------------------------Spotlight Section Start ------------------------------------------------------------------------------------>
  @if($inner_section_spotlight != "" && !empty(json_decode($inventory_section_spotlight)) && $inventoryItemsCount>0)
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
      <div class="text-center">
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
  @if($inner_sections != "" && !empty(json_decode($inventory_section_dynamic)) && $inventoryItemsCount>0)
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
            <h3>Voluptatem dignissimos provident quasi</h3>
            <p>
              Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et
              dolore magna aliqua. Duis aute irure dolor in reprehenderit
            </p>
            <div class="row">
              <div class="col-md-6 d-md-flex align-items-md-stretch">
                <div class="count-box">
                  <i class="bi bi-emoji-smile"></i>
                  <span data-purecounter-start="0" data-purecounter-end="65" data-purecounter-duration="2"
                    class="purecounter"></span>
                  <p><strong>Happy Clients</strong> consequuntur voluptas nostrum aliquid ipsam architecto ut.</p>
                </div>
              </div>

              <div class="col-md-6 d-md-flex align-items-md-stretch">
                <div class="count-box">
                  <i class="bi bi-journal-richtext"></i>
                  <span data-purecounter-start="0" data-purecounter-end="85" data-purecounter-duration="2"
                    class="purecounter"></span>
                  <p><strong>Projects</strong> adipisci atque cum quia aspernatur totam laudantium et quia dere tan</p>
                </div>
              </div>

              <div class="col-md-6 d-md-flex align-items-md-stretch">
                <div class="count-box">
                  <i class="bi bi-clock"></i>
                  <span data-purecounter-start="0" data-purecounter-end="35" data-purecounter-duration="4"
                    class="purecounter"></span>
                  <p><strong>Years of experience</strong> aut commodi quaerat modi aliquam nam ducimus aut voluptate non
                    vel</p>
                </div>
              </div>

              <div class="col-md-6 d-md-flex align-items-md-stretch">
                <div class="count-box">
                  <i class="bi bi-award"></i>
                  <span data-purecounter-start="0" data-purecounter-end="20" data-purecounter-duration="4"
                    class="purecounter"></span>
                  <p><strong>Awards</strong> rerum asperiores dolor alias quo reprehenderit eum et nemo pad der</p>
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

      <div>
        <iframe style="border:0; width: 100%; height: 270px;"
          src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d12097.433213460943!2d-74.0062269!3d40.7101282!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xb89d1fe6bc499443!2sDowntown+Conference+Center!5e0!3m2!1smk!2sbg!4v1539943755621"
          frameborder="0" allowfullscreen></iframe>
      </div>

      <div class="row mt-5">

        <div class="col-lg-4">
          <div class="info">
            <div class="address">
              <i class="bi bi-geo-alt"></i>
              <h4>Location:</h4>
              <p>A108 Adam Street, New York, NY 535022</p>
            </div>

            <div class="email">
              <i class="bi bi-envelope"></i>
              <h4>Email:</h4>
              <p>info@example.com</p>
            </div>

            <div class="phone">
              <i class="bi bi-phone"></i>
              <h4>Call:</h4>
              <p>+1 5589 55488 55s</p>
            </div>

          </div>

        </div>

        <div class="col-lg-8 mt-5 mt-lg-0">

          <form action="{{route('submit.contact')}}" method="POST" class="php-email-form">
            @csrf
            <div class="row">
              <div class="col-md-6 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required maxlength="99">
              </div>
              <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required maxlength="99">
              </div>
            </div>
            <div class="form-group mt-3">
              <input type="text" class="form-control" name="phone" id="phone" placeholder="Your Phone Number" required pattern="[0-9]{10}" title="Enter 10 digit mobile number">
            </div>
            <div class="form-group mt-3">
              <textarea class="form-control" name="message" rows="5" placeholder="Message" required maxlength="499"></textarea>
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
    // Placeholder animation
    initiateSearchAnimation();
    <?php
      # Validate if spotlight section is not empty for any reason then only trigger the ajax.

      /* NOTE: If spotlight items are present, then we'll be initiating the function to fetch dynamic sections from SUCCESS of fetchSpotlightItems(),
      so that first spotlight items will be fetched then all dynamic sections will be fetched, Only motive is to make app efficient. */
      if ($inner_section_spotlight != "" && !empty(json_decode($inventory_section_spotlight)) && $inventoryItemsCount>0) {
    ?>
    // Spotlight items
    fetchSpotlightItems();
    <?php
      } else {
      # NOTE: If spotlight items section is not present, Not initiated from admin, function to fetch dynamic section would be triggered instantly. 
    ?>
    fetchDynamicSections();
    <?php
      }
    ?>
  });

  function popProductModal(productName, e) {
    $('#queryModal').modal('show');
    $('.product-field').val(productName);
    $('#exampleModalLabel').text("Product: " + productName);
    e.preventDefault();
  }

  /******************************** Placeholder Animation Start *************************************/
  // Add something to given element placeholder
  function addToPlaceholder(toAdd, el) {
    el.attr('placeholder', el.attr('placeholder') + toAdd);
    // Delay between symbols "typing" 
    return new Promise(resolve => setTimeout(resolve, 100));
  }

  // Cleare placeholder attribute in given element
  function clearPlaceholder(el) {
    el.attr("placeholder", "");
  }

  // Print one phrase
  let i = 0;
  function printPhrase(phrase, el) {
    return new Promise(resolve => {
      // Clear placeholder before typing next phrase
      clearPlaceholder(el);
      let letters = phrase.split('');
      // For each letter in phrase
      letters.reduce(
        (promise, letter, index) => promise.then(_ => {
          // Resolve promise when all letters are typed
          if (index === letters.length - 1) {
            // Delay before start next phrase "typing"
            setTimeout(resolve, 3000);
          }
          return addToPlaceholder(letter, el);
        }),
        Promise.resolve()
      );
      i++;
      if (i == 3) {
        // Recursion
        setTimeout(() => {
          initiateSearchAnimation();
        }, 3000);
      }
    });
  }

  // Print given phrases to element
  function printPhrases(phrases, el) {
    // For each phrase, wait for phrase to be typed before start typing next
    phrases.reduce(
      (promise, phrase) => promise.then(_ => printPhrase(phrase, el)),
      Promise.resolve()
    );
  }

  // Start typing for search box animation
  function initiateSearchAnimation() {
    let phrases = [
      "{{$web->search_tool_line_1}}",
      "{{$web->search_tool_line_2}}",
      "{{$web->search_tool_line_3}}"
    ];
    if (phrases.includes("")) {
      $('#search-tool').attr('placeholder', 'Search Here...')
    } else {
      printPhrases(phrases, $('#search-tool'));
    }
  }
  /********************************* Placeholder Animation End *******************************************/


  <?php
# Validate if spotlight section is not empty for any reason then only trigger the ajax.
if ($inner_section_spotlight != "" && !empty(json_decode($inventory_section_spotlight)) && $inventoryItemsCount>0) {
    ?>
  /************************************************** Fetch Spotlight content Start************************************************************/
  function fetchSpotlightItems() {
    const spotlightArray = [];
    var spotlightCount ={{$spotlightCount}};
    for (var s = 0; s < spotlightCount; s++) {
      spotlightArray.push($('#inventory_item_' + s).val());
    }

    // Ajax call to fetch inventory items based on IDs
    $.ajax({
      url: "{{url('admin/fetch-spotlight-item-from-id')}}",
      method: 'GET',
      dataType: 'json',
      data: {
        ids: spotlightArray
      },
      success: function (response) {
        var imgPath = "{{Helper::props('admin/inventoryImages/')}}";
        var count = response.countOfSpotlightInventory;
        for (let i = 0; i <= count - 1; i++) {
          var content =
            "<div class='box p-3'>" +
            "<div class='card'>" +
            "<img src='" + imgPath + '/' + response.data[i].thumbnailimg + "' class='img-fluid p-2'/>" +
            "<p style='text-align:left; margin-left:10px;'>" +
            "<span class='badge badge-spotlight'>" + (response.data[i].offerBadge || '') + "</span>" +
            "</p>" +
            "<h4 class='spotlight-itemName'>" + response.data[i].itemName + "</h4>" +
            "<p class='text-dark text-start' style='margin:0px 0px 0px 10px;'>" + (response.data[i].importantNote || '') + "</p>" +
            "<h4 class='spotlight-pricetag'><s>" + (response.data[i].strikerPrice || '') + "</s> ₹" + response.data[i].actualPrice + "</h4>" +
            "<h6 class='text-danger' style='font-weight:bold;text-align:left; padding-left:10px;'>" + (response.data[i].salePitch || '') + "</h6>" +
            "<div class='d-flex'>" +
            "<button type='button' class='btn btn-primary' onclick='return popProductModal(\"" + response.data[i].itemName + "\");' style='width:30%; margin:10px 0px 25px 10px;'>Ask Us</button>" +
            "<br/><br/>" +
            "</div>" +
            "</div>" +
            "</div>";

          // Append the content to HTML
          $('.spotlight-render-here').append(content);
        }

        $(".loader-spotlight").hide();

        // Trigger slick slider after the content has been loaded, Otherwise slick won't work if pre-initialised.
        triggerSlickSlider();
        fetchDynamicSections();
      },
      error: function (error) {
        // alert(JSON.stringify(error));
        alert("Fatal Error: Some content could not be loaded !!");
      }
    });
  }
  /************************************************ Fetch Spotlight content End ************************************************************/
  <?php } ?>

  <?php
# Validate if dynamic section is not empty for any reason then only trigger the ajax.
if ($inner_sections != "" && !empty(json_decode($inventory_section_dynamic)) && $inventoryItemsCount>0) {
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
          // If section type is "Galaxy" start.
          if (response.data[i].section_data.type == "galaxy" && response.data[i].inventory_ids.length != 0) {
            // Render heading first because inside we've multiple items inside, but outside we only have 1 heading & description,
            // We'll render the boxes inside this rendered ROW.
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
                "<a href='{{env('APP_URL')}}/listing/"+btoa(response.data[i].inventory_ids[g].id)+"/"+btoa(response.data[i].inventory_ids[g].category_id)+"/"+btoa(response.data[i].inventory_ids[g].sub_category_id)+"'>" +
                "<div class='icon-box'>" +
                "<img src='" + imgPath + '/' + response.data[i].inventory_ids[g].thumbnailimg + "' class='img-fluid text-dark' alt='Image could not be loaded'>" +
                "<h4 class='mt-4 text-dark'>" + response.data[i].inventory_ids[g].itemName + "</h4>" +
                "<span class='badge badge-spotlight'>" + (response.data[i].inventory_ids[g].offerBadge || '') + "</span>" +
                "<h6 class='text-dark mt-2'>" + (response.data[i].inventory_ids[g].importantNote || '') + "</h6>" +
                "<h5 class='dynamic-amount text-dark mt-2'><s>" + (response.data[i].inventory_ids[g].strikerPrice || '') + "</s> ₹" + response.data[i].inventory_ids[g].actualPrice + "</h5>" +
                "<h6 class='text-danger'><b>" + (response.data[i].inventory_ids[g].salePitch || '') + "</b></h6>" +
                "<button type='button' class='btn btn-primary mt-2 redirectBlock' onclick='return popProductModal(\"" + response.data[i].inventory_ids[g].itemName + "\");'>Ask Us</button>" +
                "</div>" +
                "</a>" +
                "</div>";

              $('.render-dynamic-sections').children().last().find('.row').append(content);
            }

            // Ending the ROW & div here as all the items are already rendered. validate if button is there
            var footer;
            if (response.data[i].section_data.button == 1) {
              footer = "</div><br/>" +
                "<a href='" + response.data[i].section_data.url + "'><center><button type='button' class='btn btn-success btn-lg'>View all items <i class='bx bxs-right-arrow'></i></button></center></a>" +
                "</div><br/><br/>";
            } else {
              footer = "</div>" +
                "</div><br/><br/>";
            }

            // Render
            $('.render-dynamic-sections').append(footer);
            // Prevent click inside on buttons in cards
            $('.redirectBlock').on('click',function(e) {
              if( $(e.target).is('.redirectBlock') ) {
                e.preventDefault();
              }
            });
          }
          // If section type is "Galaxy" end.

          // If setion type is "Star" start.
          if (response.data[i].section_data.type == "star" && response.data[i].inventory_ids.length != 0) {
            // Create the section heading
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
                "<a href='{{env('APP_URL')}}/listing/"+btoa(response.data[i].inventory_ids[g].id)+"/"+btoa(response.data[i].inventory_ids[g].category_id)+"/"+btoa(response.data[i].inventory_ids[g].sub_category_id)+"'>" +
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
                "<button type='button' class='btn btn-primary mt-2 redirectBlock' onclick='return popProductModal(\"" + response.data[i].inventory_ids[g].itemName + "\");'>Ask Us</button>" +
                "</div>" +
                "</div>" +
                "</div>" +
                "</a><br/><br/><br/><br/>";
              // Append content to the last row
              $('.render-dynamic-sections').children().last().find('.star-box').append(content);
            }
            // Ending the ROW & div here as all the items are already rendered. validate if button is there
            var footer;
            if (response.data[i].section_data.button == 1) {
              footer = "</div>" +
                "<a href='" + response.data[i].section_data.url + "'><center><button type='button' class='btn btn-success btn-lg' style='margin-top:-40px;'>View all items <i class='bx bxs-right-arrow'></i></button></center></a>" +
                "</div><br/><br/><br/>";
            } else {
              footer = "</div>" +
                "</div><br/><br/><br/>";
            }
            // Append footer
            $('.render-dynamic-sections').append(footer);
           // Prevent click inside on buttons in cards
           $('.redirectBlock').on('click',function(e) {
              if( $(e.target).is('.redirectBlock') ) {
                e.preventDefault();
              }
           });
          }
          // Section type "Star" end.

          // If section type "Nebula" start.
          if (response.data[i].section_data.type == "nebula" && response.data[i].inventory_ids.length != 0) {
            // Create the section heading
            var heading = "<div class='nebula container mt-4'>" +
              "<div class='section-title'>" +
              "<h2 class='text-dark'>" + response.data[i].section_data.name + "</h2>" +
              "<p class='text-dark'>" + (response.data[i].section_data.description || '') + "</p>" +
              "</div>" +
              "<div class='container nebula-slick'>";

            // Append heading to the section
            $('.render-dynamic-sections').append(heading);

            // Loop through inventory items
            for (var g = 0; g < response.data[i].inventory_ids.length; g++) { // Use < for length check
              var content =
               "<a href='{{env('APP_URL')}}/listing/"+btoa(response.data[i].inventory_ids[g].id)+"/"+btoa(response.data[i].inventory_ids[g].category_id)+"/"+btoa(response.data[i].inventory_ids[g].sub_category_id)+"'>" +
                "<div class='member'>" +
                "<div class='member-img'>" +
                "<img src='" + imgPath + '/' + response.data[i].inventory_ids[g].thumbnailimg + "' class='img-fluid text-dark' alt='Image could not be loaded'>" +
                "</div>" +
                "<div class='member-info'>" +
                "<h4>" + response.data[i].inventory_ids[g].itemName + "</h4>" +
                "<span class='badge badge-spotlight'>" + (response.data[i].inventory_ids[g].offerBadge || '') + "</span>" +
                "<h6 class='text-dark mt-2'>" + (response.data[i].inventory_ids[g].importantNote || '') + "</h6>" +
                "<h5 class='dynamic-amount text-dark mt-2'><s>" + (response.data[i].inventory_ids[g].strikerPrice || '') + "</s> ₹" + response.data[i].inventory_ids[g].actualPrice + "</h5>" +
                "<h6 class='text-danger'><b>" + (response.data[i].inventory_ids[g].salePitch || '') + "</b></h6>" +
                "<button type='button' class='btn btn-primary mt-2 redirectBlock' onclick='return popProductModal(\"" + response.data[i].inventory_ids[g].itemName + "\");'>Ask Us</button>" +
                "</div>" +
                "</div>" +
                "</a>";

              // Append content to the last row
              $('.render-dynamic-sections').children().last().find('.nebula-slick').append(content);
            }

            // Ending the ROW & div here as all the items are already rendered. validate if button is there
            var footer;
            if (response.data[i].section_data.button == 1) {
              footer =
                "<a href='" + response.data[i].section_data.url + "'><center><button type='button' class='btn btn-success btn-lg'>View all items <i class='bx bxs-right-arrow'></i></button></center></a>" +
                "<br/><br/></div>" +
                "</div><br/>";
            } else {
              footer = "</div>" +
                "</div><br/>";
            }

            // Append footer
            $('.render-dynamic-sections').append(footer);
            // Prevent click inside on buttons in cards
            $('.redirectBlock').on('click',function(e) {
              if( $(e.target).is('.redirectBlock') ) {
                e.preventDefault();
              }
            });
          }
          // Section type "nebula" end.
        }
        $(".loader-sections").hide();

        // Trigger slick slider after the content has been loaded, Otherwise slick won't work if pre-initialised.
        triggerSlickSlider();
      },
      error: function (error) {
        // alert(JSON.stringify(error));
        alert("Fatal Error: Some content could not be loaded !!");
      }
    });
  }
  /************************************************** Fetch dynamic content End ************************************************************/
  <?php } ?>


  function triggerSlickSlider() {
    $('.nebula-slick').slick({
      infinite: true,
      dots: false,
      speed: 800,
      autoplay: true,
      autoplaySpeed: 2000,
      prevArrow: false,
      nextArrow: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 994,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
    // $('.star-box').slick({
    //   infinite: true,
    //   dots: false,
    //   speed: 1000,
    //   autoplay: true,
    //   autoplaySpeed: 2000,
    //   prevArrow: false,
    //   nextArrow: false,
    //   slidesToShow: 1,
    //   slidesToScroll: 1,
    // });
    $('.spotlight-render-here').slick({
      infinite: true,
      dots: false,
      speed: 300,
      autoplay: true,
      autoplaySpeed: 2000,
      prevArrow: false,
      nextArrow: false,
      slidesToShow: 3,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 994,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    });
  }
</script>