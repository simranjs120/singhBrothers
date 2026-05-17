<x-header />

<section class="py-5 background-primary">
  <div class="container py-5">
    <div class="row align-items-center g-5">
      <div class="col-lg-7">
        <span class="badge background-secondary text-dark mb-3 px-3 py-2">404 Not Found</span>
        <h1 class="text-light fw-bold mb-3">The page you are looking for may have moved, or the category is not available right now.</h1>
        <div class="d-flex flex-wrap gap-3">
          <a href="{{url('/')}}" class="background-secondary text-dark border border-0 rounded-3 fw-bold px-4 py-3 text-decoration-none">
            Back to Home
          </a>
          <a href="{{url('/#contact')}}" class="btn btn-outline-light rounded-3 fw-bold px-4 py-3">
            Contact Us
          </a>
        </div>
      </div>
      <div class="col-lg-5">
        <div class="border border-light p-3">
          <div class="background-secondary p-3">
            <img src="{{Helper::props('assets/img/hero-img.png')}}" class="img-fluid" alt="Singh Brothers Frames">
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<x-footer />
