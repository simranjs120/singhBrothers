</div>
<!-- content-wrapper ends -->
<!-- partial:partials/_footer.html -->
<footer class="footer">
  <div class="d-sm-flex justify-content-center justify-content-sm-between">
    <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Designed by <a
        href="https://www.sjuniq.com/" target="_blank">sjuniq</a> from Simranjeet Singh.</span>
    <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2024. Singh Brothers Frames.</span>
  </div>
</footer>
<!-- partial -->
</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

<script src="{{Helper::props('admin/js/off-canvas.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>

<script type="text/javascript">
  $('#sub-category-submit').attr("disabled",'disabled');
  $(document).ready(function () {
    $('[data-sidebar-close]').on('click', function () {
      $('.sidebar-offcanvas').removeClass('active');
    });

    $('.sb-admin-sidebar .nav-link').on('click', function () {
      if ($(window).width() < 992 && !$(this).attr('data-bs-toggle')) {
        $('.sidebar-offcanvas').removeClass('active');
      }
    });

    // Responsive header and buttons start
    var width = $(window).width();
    if (width < 767){
      $('.off-canvas-custom-buttons').removeClass('d-none'); 
      $('.all-btns').addClass('btn-sm');
    }
    // Responsive header and buttons end
    new DataTable('#datatable', {
    responsive: true,
    bLengthChange: true,
    oLanguage: {
        sLengthMenu: "_MENU_",
    },
});

new DataTable('#datatable-2', {
    responsive: true,
    bLengthChange: true,
    oLanguage: {
        sLengthMenu: "_MENU_",
    },
});

    setTimeout(function () {
      $('.alert').hide();
    }, 4000);

    $('#subCategoryModal').on('change', function () {
      $('.please-wait-msg').text('Please Wait....');
      setTimeout(function () {
      $('.please-wait-msg').hide();
      $('#sub-category-submit').removeAttr("disabled",'disabled');
    }, 500);
    });
  });

  // Responsive header and buttons start
  $(window).resize(function() {
    var width = $(window).width();
    if (width < 950){
      $('.nav-custom-button').addClass('btn-sm');
      $('.all-btns').addClass('btn-sm');
    }
    if (width > 767){
      $('.off-canvas-custom-buttons').addClass('d-none');
    } else {
      $('.off-canvas-custom-buttons').removeClass('d-none'); 
    }
  });
  // Responsive header and buttons end
</script>
