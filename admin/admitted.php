 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Admitted Applicant List </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-account-multiple menu-icon"></i> Admitted Applicant List</p>
                  </a>
                  <a class="ps-3 me-4" href="#">
                    <p class="m-0">Page</p>
                  </a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">List</h4>
                      <!-- <div class="row grid-margin">
                        <div class="col-12">
                          <div class="alert alert-warning" role="alert">
                            <strong>Heads up!</strong> This alert needs your attention, but it's not super important. </div>
                        </div>
                      </div> -->
                      <?php 
                      $admitted = $pdo->prepare("SELECT * FROM `applicant` WHERE `year` = ? AND `adm_status` = ?");
                      $admitted->execute([$school_app_year, 'Yes']);?>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>Application No</th>
                              <th>Names</th>
                              <th>Gender</th>
                              <th>Programmes</th>
                              <!-- <th>Acceptance Fee</th>
                              <th>Screening Fee</th> -->
                              <!-- <th>Batch</th>
                              <th>Action</th> -->
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            while($admrow = $admitted->fetch()){?>
                            <tr>
                              <td>1</td>
                              <td><?php echo $admrow["application_no"];?></td>
                              <td><?php echo $admrow["names"];?></td>
                              <td><?php echo $admrow["gender"];?></td>
                              <td><?php echo $admrow["programme"];?></td>
                              <!-- <td><?php //echo $admrow["acceptance_fee"];?></td>
                              <td><?php //echo $admrow["screening_fee"];?></td> -->
                              <!-- <td><?php // echo $admrow["admission_batch"];?></td> -->
                              <!-- <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="mdi mdi-eye text-primary"></i>View </button>
                                <button class="btn btn-light">
                                  <i class="mdi mdi-close text-danger"></i>Remove </button>
                              </td> -->
                            </tr>
                           <?php 
                            }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         <?php include "footer.php"?>