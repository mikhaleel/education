 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title">Payment Status </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-currency-ngn menu-icon"></i> Payment Status</p>
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
                    <center><button class="btn btn-primary pull-center" data-bs-toggle="modal" data-bs-target="#exampleModal-4"><b>Add Payment</b> <i class=" mdi mdi-plus "></i></button></center>
                     
                      </div>
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                      <?php  
                      if(isset($_GET["paydl"]))
                      {
                        $id = encryptor('decrypt',$_GET["id"]);
                        $paydel = $pdo->query("DELETE FROM `stu_payloader` WHERE `id`='$id'");
		                    echo '<div class="alert alert-danger">record delete!!</div><script>setTimeout(function(){location.href="payment"},1000)</script>';
                      }
                      $fetchpay = $pdo->prepare("SELECT * FROM `stu_payloader` WHERE `session` = ? AND `semester` = ?");
                      $fetchpay->execute([$school_activesession,$school_activesemester]); ?>
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>Type</th>
                              <!-- <th>Programmes</th> -->
                              <th>Matno</th>
                              <!-- <th>Names</th> -->
                              <th>Session</th>
                              <th>Level</th>
                              <th>Semester</th>
                              <th>Amount</th>
                              <!-- <th>Category</th> -->
                              <!-- <th>REF NO</th> -->
                              <!-- <th>Transaction ID</th> -->
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $sn=0;
                            while($payrow = $fetchpay->fetch()){ $sn++;?>
                            <tr>
                              <td><?php echo $sn;?></td>
                              <td><?php echo $payrow["type"];?></td>
                              <!-- <td><?php //echo $payrow["programme"];?></td> -->
                              <td><?php echo $payrow["matno"];?></td>
                              <!-- <td><?php //echo $payrow["pay_type"];?></td> -->
                              <td><?php echo $payrow["session"];?></td>
                              <td><?php echo $payrow["level"];?></td>
                              <td><?php echo $payrow["semester"];?></td>
                              <td><?php echo $payrow["amount"];?></td>
                              <!-- <td><?php //echo $payrow["category"];?></td> -->
                              <!-- <td><?php //echo $payrow["refno"];?></td> -->
                              <!-- <td><?php //echo $payrow["txid"];?></td> -->
                              <td><?php echo $payrow["status"];?></td>
                              <td class="text-right">
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $sn;?>">
                                  <i class="mdi mdi-eye text-primary"></i> Detail </button>                                
                                  <!--Edit Courses Start-->
                                    <div class="modal fade" id="EditModal<?php echo $sn;?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel"> Payment Details</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                           <p> Name: <?php echo $payrow["pay_type"];?></p>
                                            <p>Matric No: <?php echo $payrow["matno"];?></p>
                                            <hr>
                                            Programme: <?php echo $payrow["programme"];?><br>
                                            <?php echo $payrow["category"];?><br>
                                            Session: <?php echo $payrow["session"];?><br>
                                            Semester: <?php echo $payrow["semester"];?><br>
                                            Level: <?php echo $payrow["level"];?><br>
                                           <hr> 
                                           Refrence No: <?php echo $payrow["refno"];?>
                                          <p> Transaction ID: <?php echo $payrow["txid"];?></p>
                                          Payment Status: <span class="btn btn-info"><?php echo $payrow["status"];?></span>
                                          </div>
                                          <div class="modal-footer">
                                            <a href="?paydl=&id=<?php echo encryptor('encrypt',$payrow["id"]);?>" class="btn"><i class=" mdi mdi-delete text-danger"></i>Delete</a>
                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  <!--Edit Courses End-->
                                <!-- <button class="btn btn-light">
                                  <i class=" mdi mdi-check-all text-danger"></i> Deleted </button> -->
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
                
         <!--Add Courses Start-->
                    <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Add New Payment</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form>
                                <div class="row">
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Matric No:</label>
                                <input type="text" name="matricno" class="form-control">
                              </div>
                              </div>
                                <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Programme:</label>
                                <select type="text" name="programmes" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Session:</label>
                                <select type="text" name="session" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Level:</label>
                                <select type="text" name="level" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Category:</label>
                                <select type="text" name="category" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="occupied" class="col-form-label">Semester:</label>
                                <select type="text" name="status" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" name="amount" class="col-form-label">Amount:</label>
                                <input type="number" class="form-control">
                              </div>
                              </div>
                                </div>
                             
                            </form>
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                <!--Add Courses End-->
         <?php include "footer.php"?>