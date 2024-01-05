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
                  <div class="row">
                    <center><h4>Current Batch: BATCH 7</h4></center>
                      <div class="col-12">
                        <form action="#">
                          <div class="form-group d-flex">
                            <select type="text" class="form-control" placeholder="Search Here">
                                <option>Choose Batch</option>
                            </select>
                            <button type="submit" class="btn btn-primary border ms-3">Search</button>
                          </div>
                        </form>
                      </div>
                      </div>
                      
                      <?php 
                      $app = $pdo->prepare("SELECT * FROM `applicant` WHERE `year` = ?");
                      $app->execute([$school_app_year]);?>
                    <h4 class="card-title">List</h4>
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
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            while($approw = $app->fetch()){ $appnos = $approw["application_no"];?> 
                            <tr>
                              <td>1</td>
                              <td><?php echo $approw["application_no"];?></td>
                              <td><?php echo $approw["names"];?></td>
                              <td><?php echo $approw["gender"];?></td>
                              <td><?php echo $approw["adm_status"];?></td>
                              <td class="text-right">
                                      <button type="button" class="mdi mdi-eye text-info" data-bs-toggle="modal" data-bs-target="#exampleModal">View </button>
                                    
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Applicant details</h5>
                                            <span class="text-right">  <b>Admission status:</b> <?php if($approw["adm_status"] == "No"){ echo "<a class='btn btn-danger'>Application under review</a>"; $btncolor="btn-success"; $adst = "Yes"; $btnact = "Give Offer";}else{ echo "<div class='btn btn-info'>Offered Admission</div>"; $btncolor="btn-danger";  $adst = "No"; $btnact = "Deny Offer";}?></span>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          <div class="row">
                                              <div class="col-6">
                                                Name: <?php echo $approw["names"];?><br>
                                                Application No: <?php echo $approw["application_no"];?><br>
                                                Programme: <?php echo $approw["programme"];?>
                                                
                                              </div>
                                              <div class="col-6">
                                                Date of Birth: <?php echo $approw["dob"];?><br>
                                                State: <?php echo $approw["state"];?><br>
                                                LGA: <?php echo $approw["lga"];?>
                                              </div>
                                          </div>
                                          <hr>
                                            <div class="row">
                                              <div class="col-6">
                                              <h4>A/O-Level</h4>
                                              <?php 
                                              $olevel = $pdo->query("SELECT * FROM `app_olevel` WHERE `appno`='$appnos'");
                                              ?>
                                              <table>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Subject</th>
                                                  <th>Grade</th>
                                                  <th>Body</th>
                                                  <th>Date</th>
                                                </tr>
                                                <?php while($olrow = $olevel->fetch()){?>
                                                <tr>
                                                  <td>1</td>
                                                  <td><?php echo $olrow["subject"];?></td>
                                                  <td><?php echo $olrow["grade"];?></td>
                                                  <td><?php echo $olrow["exambody"];?></td>
                                                  <td><?php echo $olrow["examdate"];?></td>
                                                </tr>
                                                <?php }?>
                                              </table>
                                              </div>
                                              
                                              <div class="col-6">
                                              <h4>Other Qualifications</h4>
                                              <?php 
                                              $olevel = $pdo->query("SELECT * FROM `app_institute` WHERE `appno`='$appnos'");
                                              ?>
                                              <table>
                                                <tr>
                                                  <th>#</th>
                                                  <th>Institute</th>
                                                  <th>Course</th>
                                                  <th>Class</th>
                                                  <th>Date</th>
                                                </tr>
                                                <?php while($olrow = $olevel->fetch()){?>
                                                <tr>
                                                  <td>1</td>
                                                  <td><?php echo $olrow["institute"];?></td>
                                                  <td><?php echo $olrow["class"];?></td>
                                                  <td><?php echo $olrow["course"];?></td>
                                                  <td><?php echo $olrow["date"];?></td>
                                                </tr>
                                                <?php }?>
                                              </table>

                                              </div>
                                              </div>
                                              <div id="offerResult"></div>
                                          </div>
                                          <div class="modal-footer">
                                            <form name="goffer" id="offerForm" method="post">
                                              <input name="appid" value="<?php echo $olrow["id"];?>" type="hidden">
                                              <input name="act" value="<?php echo $adst;?>" type="hidden">
                                              <input class="btn <?php echo $btncolor;?>" type="button" name="offer" value="<?php echo $btnact;?>" id="offerBtn">
                                            </form>
                                            <!-- <form name="doffer" method="post" id="offerForm"><input name="actn" type="hidden" value="0"><input class="btn btn-danger" name="offer" value="Denied Offer" id="offerBtn"></form> -->
                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                    <!-- Modal Ends -->

                                <!-- <button class="btn btn-light">
                                  <i class="mdi mdi-close text-danger"></i>Remove </button> -->
                              </td>
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
    <script>
    $(document).ready(function() {
      $("#offerForm").submit(function(e) {
        e.preventDefault()
        let data = $("#offerForm").serialize()
        let appReq = $.ajax({
          url: "give_offer.php",
          type: "POST",
          data: data,
          beforeSend: () => {
            $("#offerBtn").html("Processing...")
            $("#offerBtn").attr("disabled", "true")
          },
          complete: () => {
            $("#offerBtn").html("Done")
            $("#offerBtn").removeAttr("disabled")
          },
          success: (res) => $("#offerResult").html(res)
        })
      })
    })
    </script>