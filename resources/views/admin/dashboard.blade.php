<x-Admin-header :profile="$profile"/>
          <div class="row">
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="d-sm-flex align-items-center justify-content-between border-bottom">
                <!-- Start: Navigation Bar & Some Useful Buttons -->

                  <!-- <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                      <a class="nav-link active ps-0" id="home-tab" data-bs-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#audiences" role="tab" aria-selected="false">Audiences</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#demographics" role="tab" aria-selected="false">Demographics</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link border-0" id="more-tab" data-bs-toggle="tab" href="#more" role="tab" aria-selected="false">More</a>
                    </li>
                  </ul> -->
                  <!-- <div>
                    <div class="btn-wrapper">
                      <a href="#" class="btn btn-otline-dark align-items-center"><i class="icon-share"></i> Share</a>
                      <a href="#" class="btn btn-otline-dark"><i class="icon-printer"></i> Print</a>
                      <a href="#" class="btn btn-primary text-white me-0"><i class="icon-download"></i> Export</a>
                    </div>
                  </div> -->

                  <!-- End: Navigation Bar & Some Useful Buttons -->
                </div>
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview"> 
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="statistics-details align-items-center justify-content-between">
                          <div class="row">
                          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 dashboard-stats-glance">
                            <p class="statistics-title">Total Inventory Items</p>
                            <h3 class="rate-percentage">100</h3>
                            <p class="text-danger d-flex"><span>0 Added Today</span></p>
                          </div>
                          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 dashboard-stats-glance">
                            <p class="statistics-title">Total Categories</p>
                            <h3 class="rate-percentage">10</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+2 Today</span></p>
                          </div>
                          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 dashboard-stats-glance">
                            <p class="statistics-title">Total Landing Searches</p>
                            <h3 class="rate-percentage">68</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+10 Today</span></p>
                          </div>
                          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 dashboard-stats-glance">
                            <p class="statistics-title">Total Offers</p>
                            <h3 class="rate-percentage">50</h3>
                            <p class="text-danger d-flex"><span>0 Created Today</span></p>
                          </div>
                          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 dashboard-stats-glance">
                            <p class="statistics-title">Product Queries</p>
                            <h3 class="rate-percentage">68</h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span>+5 Today</span></p>
                          </div>
                          <div class="col-lg-2 col-md-4 col-sm-6 col-xs-12 dashboard-stats-glance">
                            <p class="statistics-title">Contact Form Queries</p>
                            <h3 class="rate-percentage">102</h3>
                            <p class="text-danger d-flex"><span>0 Today</span></p>
                          </div>
                          </div>
                        </div>
                      </div>
                    </div> 
<!-- --------------------------------------------------------Row 1------------------------------------------------------------------- -->
                    <div class="row">
                      <div class="col-lg-8 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-12 col-lg-4 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-sm-flex justify-content-between align-items-start">
                                  <div>
                                   <h4 class="card-title card-title-dash">Performance Line Chart</h4>
                                   <h5 class="card-subtitle card-subtitle-dash">Lorem Ipsum is simply dummy text of the printing</h5>
                                  </div>
                                  <div id="performance-line-legend"></div>
                                </div>
                                <div class="chartjs-wrapper mt-5">
                                  <canvas id="performaneLine"></canvas>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-lg-4 d-flex flex-column">
                      <div class="row flex-grow">
                          <div class="col-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="row">
                                  <div class="col-lg-12">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                      <h4 class="card-title card-title-dash">Types of Items</h4>
                                    </div>
                                    <canvas class="my-auto" id="doughnutChart" height="200"></canvas>
                                    <div id="doughnut-chart-legend" class="mt-5 text-center"></div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
<!-- --------------------------------------------------------Row 2------------------------------------------------------------------- -->
                    <div class="row">
                      <div class="col-lg-12 d-flex flex-column">
                        <div class="row flex-grow">
                          <div class="col-md-12 col-lg-12 grid-margin stretch-card">
                            <div class="card card-rounded">
                              <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between mb-3">
                                  <h4 class="card-title card-title-dash">Activities</h4>
                                  <p class="mb-0">Timestamps</p>
                                </div>
                                <ul class="bullet-line-list">
                                  @foreach($tracking10 as $row)
                                  <li>
                                    <div class="d-flex justify-content-between">
                                      <div><span class="text-light-green">{{$row->changer_name}}</span> {{$row->change_title}} <p id="mobile-agent">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</p></div>
                                      <p id="pc-agent">{{App\Helpers\Helper::timeStampProcessed($row->created_at)}}</p>
                                    </div>
                                  </li>
                                  @endforeach
                                </ul>
                                <div class="list align-items-center pt-3">
                                  <div class="wrapper w-100">
                                    <p class="mb-0">
                                      <a href="{{url('/admin/all-activity')}}" class="fw-bold text-primary">Show all <i class="mdi mdi-arrow-right ms-2"></i></a>
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Footer -->
  <x-admin-footer/>