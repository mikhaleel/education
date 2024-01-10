 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Screening Confirmation Page </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-account-search menu-icon"></i> List of Applicants for Screening</p>
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
                      if(isset($_POST["screen"]))
                      {
                        $actn = $_POST["screen"];
                     echo   $id = encryptor('decrypt',$_POST["ids"]);
                       echo "<script>alert(".$id.")</script>";
                        $update = $pdo->prepare("UPDATE `applicant` SET `screen_status` = ? WHERE `id` = ?");
                        $update->execute([$actn, $id]);
                        if($update)
                        {
                          echo '<div class="alert alert-success">Updated!!</div><script>setTimeout(function(){location.href="screening"},1000)</script>';
                        }
                      }
                      $screen = $pdo->prepare("SELECT * FROM `applicant` WHERE `year` = ? AND `adm_status` = 'Yes' and `acceptance_fee` = 'paid' AND `screen_status` = 'No'");
                      $screen->execute([$school_app_year]);?>
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
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $sn = 0; while($row=$screen->fetch()){ $sn++;?>
                            <tr>
                              <td><?php echo $sn;?></td>
                              <td><?php echo $row["application_no"];?></td>
                              <td><?php echo $row["names"];?></td>
                              <td><?php echo $row["gender"];?></td>
                              <td><?php echo $row["programme"];?></td>
                              <td class="text-right">
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $sn;?>">
                                  <i class="mdi mdi-eye text-primary"></i>View </button>
                                    
                                    <div class="modal fade" id="exampleModal<?php echo $sn;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Applicant details</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                           Application No: <h4><?php echo $row["application_no"];?></h4>
                                           Name: <h4><?php echo $row["names"];?></h4>
                                           Application Fee: <h4><?php echo $row["application_fee"];?></h4>
                                           Acceptance Fee: <h4><?php echo $row["acceptance_fee"];?></h4>
                                           Is he/she Addmitted: <h4><?php echo $row["adm_status"];?></h4>
                                          </div>
                                          <div class="modal-footer">
                                             <form name="frmn<?php echo $sn;?>" method="post">
                                              <input name="ids" value="<?php echo encryptor('encrypt',$row["id"]);?>" type="hidden">
                                              <?php 
                                              if($row["screen_status"] == 'Yes')
                                              {?>
                                              <input name="screen" value="No" type="hidden">
                                                <button class="btn btn-light" name="act" type="submit" >
                                                  <i class="mdi mdi-close-octagon  text-danger"></i>Un-Confirm 
                                                </button>
                                              <?php 
                                              }else{?>
                                              <input name="screen" value="Yes" type="hidden">
                                              <button class="btn btn-light" name="act" type="submit" >
                                                <i class="mdi mdi-check-decagram  text-success"></i>Confirm 
                                              </button>
                                              <?php 
                                              }?>
                                              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button> 
                                              </form>
                                          </div>
                                          </div>
                                        </div>
                                      </div>
                                    <!-- Modal Ends -->
                              </td>
                            </tr>
                            <?php }?>
                           
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