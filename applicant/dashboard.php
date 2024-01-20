<?php include ("header.php");?>
      <!-- partial:partials/_settings-panel.html -->
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel container">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin d-none d-lg-block">
                <div class="intro-banner">
                  <div class="banner-image">
                    <!-- <img src="../assets/images/dashboard/banner_img.png" alt="banner image"> -->
                  </div>
                  <div class="content-area">
                    <h3 class="mb-0">Welcome, <?php echo $app_infor["names"];?></h3>
                    <h5 class="text-info"><?php echo $admstatus;?></h5>
                    <p class="mb-0">for any enquiry, please contact the following numbers on WhattsApp: 080 0888 679 00.</p>
                  </div>
                  <!-- <a href="#" class="btn btn-light">Subscribe Now</a> -->
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body pb-0">
                    <p class="text-muted">Acceptance Fee (<?php echo $acceptancefee;?>)</p>
                    <div class="d-flex align-items-center">
                      <h4 class="font-weight-semibold text-success "><?php 
                      
                      if($app_infor['adm_status'] == "Yes")
                      {
                         echo $acceptancelink;
                      }?></h4>
                    </div>
                  </div>
                  <canvas class="mt-2" height="40" id="statistics-graph-1"></canvas>
                </div>
              </div><!--
              <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body pb-0">
                    <p class="text-muted">Screening Fee (<?php //echo $screeningfee;?>)</p>
                    <div class="d-flex align-items-center">
                      <h4 class="font-weight-semibold text-danger"><?php //echo $screninglink;?></h4>
                    </div>
                  </div>
                  <canvas class="mt-2" height="40" id="statistics-graph-3"></canvas>
                </div>
              </div>-->
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body pb-0">
                    <p class="text-muted">School Fee (<?php echo $schoolfee;?>)</p>
                    <div class="d-flex align-items-center">
                      <h4 class="font-weight-semibold text-success"><?php
                      
                      if($app_infor['screen_status'] == "Yes")
                      {
                        echo "School Fee: " .$schoolfeelink;
                      }
                      else
                      {
                        echo "<div class='alert alert-info text-danger'>Please go (whith your credentials) <br>for physical screening : </div>";
                      }
                     // echo $schoolfeelink;?></h4>
                    </div>
                  </div>
                  <canvas class="mt-2" height="40" id="statistics-graph-2"></canvas>
                </div>
              </div>
              <div class="col-xl-4 col-lg-4 col-md-4 col-sm-6 grid-margin stretch-card">
                <div class="card card-statistics">
                  <div class="card-body pb-0">
                    <p class="text-muted">Application Status</p>
                    <div class="d-flex align-items-center">
                      <h4 class="font-weight-semibold text-success"><?php echo $admstatus;?></h4>
                    </div>
                  </div>
                  <canvas class="mt-2" height="40" id="statistics-graph-4"></canvas>
                </div>
              </div>
              

              <div class="col-xl-12 col-lg-7 col-md-8 col-sm-12 grid-margin stretch-card">
                <div class="card review-card">
                  <div class="card-header header-sm d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Reports</h4>
                    <div class="wrapper d-flex align-items-center">
                      <p><?php 
                      if($app_infor["school_fee"] == 'paid'){
                        if($app_infor["matno"] == NULL OR $app_infor["matno"] == "")
                        {
                          echo "<a class='btn btn-warning'>Generate Matric Number</a>";
                        }
                        else
                        {
                          echo "Matric No: ".$app_infor["matno"];
                        }
                      }
                      ?></p>
                    </div>
                  </div>
                  <div class="card-body no-gutter">
                    
                    <div class="list-item">
                      <div class="preview-image">
                      </div>
                      <div class="content">
                        <div class="d-flex align-items-center">
                          <h6 class="product-name">Application Form</h6>
                          <div class="ms-auto">
                            <a href="app_print?appno=<?php echo $_GET["appno"];?>" target="_blank">Click here to print your Application Form</a>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="list-item">
                      <div class="preview-image">
                      </div>
                      <div class="content">
                        <div class="d-flex align-items-center">
                          <h6 class="product-name">Addmission Letter</h6>
                          <div class="ms-auto">
                            <?php if($acceptancefee !== 'paid')
                            {
                              echo "<div class='alert alert-info text-danger'>To print your admission offer letter, please click on the pay now to pay for Acceptance fee: ". $acceptancelink. "</div>";
                            }else
                            {?>
                              <a href="offer_letter?appno=<?php echo $_GET["appno"];?>" target="_blank">Click here to print your Addmission Offer Letter. </a>Congratulations!!
                              <?php 
                            }?>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="list-item">
                      <div class="preview-image">
                      </div>
                      <div class="content">
                        <div class="d-flex align-items-center">
                          <h6 class="product-name">Fee Payable</h6>
                          <div class="ms-auto">
                               <a href="payable?appno=<?php echo $_GET["appno"];?>" target="_blank">Click here to print Fees payable</a>
                            <?php if($acceptancefee == 'paid')
                            {
                              
                                if($app_infor['screen_status'] == "Yes")
                                {
                                  echo "School Fee: " .$schoolfeelink;
                                }
                                else
                                {
                                  echo "<div class='alert alert-info text-danger'>Please go (whith your credentials) for physical screening : </div>";
                                }
                              ?>
                            <?php 
                            }
                            else
                            { 
                              echo "<div class='alert alert-info text-danger'>please click on the pay now to pay for Acceptance fee: </div>";
                            }?>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- content-wrapper ends -->
        <?php include "footer.php"?>