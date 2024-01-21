 <?php include "header.php";?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title">Payment/Recipt </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-currency-ngn menu-icon"></i> Payment/Recipt</p>
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
                    <div class="alert alert-success text-black"> 
                    Any issue on Payment, Kindly contact the following;<br>
                    Whatsapp : +234 8135711660 OR +234 7038691624<br>
                    Email : payment@domainname.edu.ng
                    </div>
                    <ul class="list-group">
                    <?php
                    if(isset($_GET['geninv']))
                    {
                      $category = encryptor('decrypt',$_GET['geninv']);
                      $level = encryptor('decrypt',$_GET['level']);
                      $semester = encryptor('decrypt',$_GET['semester']);
                      $session = encryptor('decrypt',$_GET['session']);
                      $col_id = $student_college_id;
                      $fetc_fsch = $pdo->prepare("SELECT * FROM `payment_schedule` WHERE `session`=? AND `semester`=? AND `level` = ? AND `category`=?");
                      $fetc_fsch->execute([$session, $semester,$level,$category]);
                     $paym_row =  $fetc_fsch->fetch();
                      $instpl = $pdo->prepare("INSERT INTO `stu_payloader` (`matno`, `programme`, `type`, `session`, `semester`, `level`, `pay_type`, `amount`,`college_id`) VALUES (?,?,?,?,?,?,?,?,?)");
                      $instpl->execute([$student_matno,$student_programme,$category,$session,$semester,$level,$student_name,$paym_row["amount_indigene"],$col_id]);
                      echo "<script>alert('Invoice generated, Click on Pay now from Payment/Reciept Menu to make payment')</script>";
                      echo '<div class="alert alert-info">Invoice Generated!!</div><script>setTimeout(function(){location.href="payment?matno='.encryptor('encrypt',$student_id).'"},1000)</script>';

                    }

                      if($stu_p->rowCount() > 0)
                      {}
                      else
                      {?>
                        <a href="?matno=<?php echo encryptor('encrypt',$student_id);?>&geninv=<?php echo encryptor('encrypt','School Fees');?>&session=<?php echo encryptor('encrypt',$school_activesession);?>&semester=<?php echo encryptor('encrypt',$school_activesemester);?>&level=<?php echo encryptor('encrypt',$student_level);?>" class="btn btn-warning float-right">Generate School Fee Payment Invoice for <?php echo $student_level;?> <?php echo $school_activesession;?> <?php echo $semester_arr[$school_activesemester];?></a>
                        <?php  
                      }?>
                    <?php          
                    //fetch all payments
                    $stu_pay = $pdo->query("SELECT * FROM `stu_payloader` WHERE `matno`='$student_matno'");
                    while($pay_row = $stu_pay->fetch())
                    {?>
                      <li class="list-group-item"><strong class="text-primary"><?php echo $pay_row["level"];?> <?php echo $semester_arr[$pay_row['semester']];?> </strong> : [<?php echo $pay_row["type"];?>] - <?php echo $pay_row["session"];?></strong>  
                      <strong class="text-success"> &#8358;<?php echo $pay_row["amount"];?></strong> 
                      <?php 
                      if($pay_row['status']=="paid")
                      {?>
                        <a href="stu_reciept?stpid=<?php echo encryptor('encrypt',$pay_row["id"]);?>" class="btn btn-success pull-right" target="_blank" >View Receipt</a>
                      <?php 
                      }else
                      {?>
                        <a href="stu_invoice?matno=<?php echo encryptor('encrypt',$student_matno);?>&invtyp=<?php echo encryptor('encrypt',"School Fees");?>" class="btn btn-danger pull-right">Pay Now</a>
                     <?php
                      }?>
                      
                      </li>
                    <?php 
                    };?>
                    </ul>
                      <div class="blockquote blockquote-primary alert-dismissible fade show" role="alert"><i class="zmdi zmdi-natification"></i>
                      <h5><b> NOTICE! </b><br><hr>This is to inform all students that the 2021/2022 Academic session student registration ends as follows:<br><br>
                      <ol><li>	Student Late Registration
                      Date: Friday, 25th November, 2022
                      Time:</li><br>
                      <li>Closing of Registration Portal
                      Date: Saturday, 3rd December, 2022
                      Time: 12am</li></h5>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!--Edit Courses Start-->
                    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Payment</h5>
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
                <!--Edit Courses End-->
                
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