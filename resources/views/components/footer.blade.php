  <!-- ======= Footer ======= -->
  <footer id="footer" class="site-footer">
    <div class="footer-cta">
      <div class="container">
        <div class="row align-items-center g-4">
          <div class="col-lg-8">
            <span class="footer-eyebrow">Custom framing made simple</span>
            <h2>Bring your photos, artwork, and memories to a finish worth keeping.</h2>
          </div>
          <div class="col-lg-4 text-lg-end">
            <a href="{{url('/#contact')}}" class="footer-cta-btn">
              <i class="bi bi-chat-dots"></i>
              Start an enquiry
            </a>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-main">
      <div class="container">
        <div class="row g-4 g-lg-5">
          <div class="col-lg-4 col-md-6">
            <a class="footer-brand" href="{{url('/')}}">
              <img src="{{Helper::props('assets/img/logo.png')}}" alt="Singh Brothers Frames">
            </a>
            <p class="footer-about">
              Singh Brothers Frames crafts custom photo frames, glass work, mouldings, art pieces, and collage displays
              with careful finishing for homes, offices, and gifting.
            </p>
            <div class="footer-badges">
              <span>Photo Frames</span>
              <span>Glass</span>
              <span>Mouldings</span>
            </div>
          </div>

          <div class="col-lg-2 col-md-6">
            <h3>Explore</h3>
            <ul class="footer-links">
              <li><a href="{{url('/')}}">Home</a></li>
              <li><a href="{{url('/#about')}}">About</a></li>
              <li><a href="{{url('/#categories')}}">Categories</a></li>
              <li><a href="{{url('/search')}}">Search</a></li>
              <li><a href="{{url('/#contact')}}">Contact</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6">
            <h3>What We Make</h3>
            <ul class="footer-links">
              <li><a href="{{url('/#categories')}}">Custom Photo Frames</a></li>
              <li><a href="{{url('/#categories')}}">Glass Solutions</a></li>
              <li><a href="{{url('/#categories')}}">Frame Mouldings</a></li>
              <li><a href="{{url('/#categories')}}">Art Pieces</a></li>
              <li><a href="{{url('/#categories')}}">Photo Collages</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6">
            <h3>Visit Or Call</h3>
            <ul class="footer-contact">
              <li>
                <i class="bi bi-geo-alt"></i>
                <span>RZ-201-A, Sayed Village, Paschim Vihar, New Delhi-110087</span>
              </li>
              <li>
                <i class="bi bi-telephone"></i>
                <a href="tel:+919811428583">+91 9811428583</a>
              </li>
              <li>
                <i class="bi bi-envelope"></i>
                <a href="mailto:satnam9811428583@gmail.com">satnam9811428583@gmail.com</a>
              </li>
            </ul>
            <div class="footer-social">
              <a href="tel:+919811428583" aria-label="Call Singh Brothers Frames"><i class="bi bi-telephone-fill"></i></a>
              <a href="mailto:satnam9811428583@gmail.com" aria-label="Email Singh Brothers Frames"><i class="bi bi-envelope-fill"></i></a>
              <a href="{{url('/#contact')}}" aria-label="Open contact form"><i class="bi bi-send-fill"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="footer-bottom">
      <div class="container">
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-2">
          <p class="mb-0">&copy; {{date('Y')}} Singh Brothers Frames. All Rights Reserved.</p>
          <p class="mb-0">Designed by <a href="#">Simranjeet Singh</a></p>
        </div>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{Helper::props('assets/vendor/purecounter/purecounter_vanilla.js')}}"></script>
  <script src="{{Helper::props('assets/vendor/aos/aos.js')}}"></script>
  <!-- <script src="{{Helper::props('assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script> -->
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="{{Helper::props('assets/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{Helper::props('assets/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{Helper::props('assets/vendor/swiper/swiper-bundle.min.js')}}"></script>


  <!-- Template Main JS File -->
  <script src="{{Helper::props('assets/js/main.js')}}"></script>
  <script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
</body>

</html>
<script>
  setTimeout(function () {
      $('.alert').hide();
    }, 4000);
</script>
