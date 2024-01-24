 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Applicant List </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-account-multiple menu-icon"></i> Applicant List</p>
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
                      
                    
                      
                  <a href="applicant_list_dwnld?csvss" target="_blank" class="btn btn-warning" >Download applicantant list</a>
                    <a href="applicant_list_dwnld" target="_blank" class="btn btn-success pull-right" data-bs-toggle="modal" data-bs-target="#exampleModal" >Upload admitted applicants</a>
                                  
                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Applicant details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">

                          </div>
                          <div class="modal-footer">
                            <form name="goffer" id="offerForm" method="post">
                              <input class="btn btn-success" type="submit" name="offer" value="Submit" id="offerBtn">
                            </form>
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>

                      <?php 
                      $app = $pdo->prepare("SELECT * FROM `applicant` WHERE `year` = ? AND `adm_status` = ? AND `application_fee`= ?");
                      $app->execute([$school_app_year, 'No','paid']);?>
                    <h4 class="card-title">List</h4>
                    <div id="offerResult">
                      <?php 
                      if( isset($_POST["offer"]))
                      { 
                          $appid = $_POST["appid"];
                          $actn = $_POST["act"];
                          $message = $appid."".$actn;
                        //  echo '<script>alert('.$message.')</script>';
                          $updtapp = $pdo->prepare("UPDATE `applicant` SET `adm_status`= ? WHERE `id`=?");
                          $updtapp->execute([$actn, $appid]);
                          if($updtapp)
                          {
                            echo '<div class="alert alert-success">Updated!!</div><script>setTimeout(function(){location.href="applicant"},1000)</script>';
                          }
                      }?>
                    </div>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>Application No</th>
                              <th>Names</th>
                              <th>Gender</th>
                              <th>Adm_status</th>
                              <th>App_status</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $srn = 0;
                            while($approw = $app->fetch()){ $appnos = $approw["application_no"]; $srn++;?> 
                            <tr>
                              <td><?php echo $srn;?></td>
                              <td><?php echo $approw["application_no"];?></td>
                              <td><?php echo $approw["names"];?></td>
                              <td><?php echo $approw["gender"];?></td>
                              <td><?php echo $approw["adm_status"];?></td>
                              <td><?php echo $approw["app_status"];?></td>
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
         <?php include("footer.php");?>