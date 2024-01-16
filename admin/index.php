<?php include "header.php";

?>

        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper pb-0">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Dashboard </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-compass-outline menu-icon"></i> Dashboard</p>
                  </a>
                  <a class="ps-3 me-4" href="#">
                    <p class="m-0">Page</p>
                  </a>
                </div>
              </div>
            </div>
            <!-- first row starts here -->
            <div class="row">
            <div class="col-12 grid-margin">
                <div class="card card-statistics">
                  <div class="row">
                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                          <i class="mdi mdi-account-multiple-outline text-primary mr-0 mr-sm-4 icon-lg"></i>
                          <div class="wrapper text-center text-sm-left">
                            <p class="card-text mb-0">Total Students</p>
                            <div class="fluid-container">
                              <h3 class="mb-0 font-weight-semibold">65,650</h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                          <i class="mdi mdi-account-star text-primary mr-0 mr-sm-4 icon-lg"></i>
                          <div class="wrapper text-center text-sm-left">
                            <p class="card-text mb-0">Total Staff</p>
                            <div class="fluid-container">
                              <h3 class="mb-0 font-weight-semibold">32,604</h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6 border-right">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                          <i class="mdi mdi-book-multiple text-primary mr-0 mr-sm-4 icon-lg"></i>
                          <div class="wrapper text-center text-sm-left">
                            <p class="card-text mb-0">Total Programmes</p>
                            <div class="fluid-container">
                              <h3 class="mb-0 font-weight-semibold">17,583</h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-col col-xl-3 col-lg-3 col-md-3 col-6">
                      <div class="card-body">
                        <div class="d-flex align-items-center justify-content-center flex-column flex-sm-row">
                          <i class="mdi mdi-book-variant text-primary mr-0 mr-sm-4 icon-lg"></i>
                          <div class="wrapper text-center text-sm-left">
                            <p class="card-text mb-0">Total Courses</p>
                            <div class="fluid-container">
                              <h3 class="mb-0 font-weight-semibold">61,119</h3>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Calendar</h4>
                    <!-- <p class="card-description">Calendar</p> -->
                    <div id="inline-datepicker" class="datepicker"></div>
                  </div>
                </div>
              </div>
             
            </div>
          </div>
          <!-- content-wrapper ends -->
         <?php include "footer.php"?>