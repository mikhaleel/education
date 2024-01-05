<?php include "header.php"?>
  <!-- partial -->
  <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title">Report Page</h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-thumb-up menu-icon"></i> Report</p>
                  </a>
                  <a class="ps-3 me-4" href="#">
                    <p class="m-0">Page</p>
                  </a>
                </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-4 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Select Reports</h4>
                  <form class="forms-sample">
                    <div class="form-group">
                      <!-- <label for="exampleInputUsername1">Username</label> -->
                      <select class="form-control" id="report" name="report">
                         <option>Choose</option>
                         <option value="report_payment_log"> Payment Logs</option>
                                <option value="report_payment_summary"> Payments Summary</option>
                                <option value="report_transaction_log"> Transaction Logs</option>

                                <option value="report_payment_schedule"> Payment Schedule </option>
                                                                                        
                                <option value="report_student_list"> Student Lists</option>
                                <option value="report_applicants"> Applicants</option>                                
                                <option value="report_accomodation"> Accommodation</option>
                        </select>
                    </div>
                   
                  </form>
                </div>
              </div>
            </div>
            	 <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
              
                <div class="card-body">
                  <h4 class="card-title">Report Parameter </h4>
                  <div class="alert alert-success dark" role="alert">
                      CITIZENS LIST                    </div>
                  <hr>
                  <form name="frmpg" class="forms-sample" action="report_citizens_list" method="GET" id="frmpg" target="_blank">

                                      <div class="form-group row">
                      <label for="datefrom" class="col-sm-3 col-form-label">From</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="datefrom" name="datefrom" placeholder="From" required>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="dateto" class="col-sm-3 col-form-label">To</label>
                      <div class="col-sm-9">
                        <input type="date" class="form-control" id="dateto" name="dateto" placeholder="To" required>
                      </div>
                    </div>
                  
                    <div class="form-group row">
                      <label for="status" class="col-sm-3 col-form-label">Status</label>
                      <div class="col-sm-9">
                      <select class="form-control" name="status" id="status" required>

                        <option value="paid">Paid</option>
                          <option value="unpaid">Unpaid</option>
                        </select>                      </div>
                    </div>
                  <p align="right">
                    <button type="submit" class="btn btn-primary mr-2">Display</button>
                  </p>
                  </form>
                </div>
                              </div>
            </div>
                </div>
                
          
          </div>
  
        <!-- content-wrapper ends -->


      <?php include "footer.php"?>