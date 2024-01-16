 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title">Exam Result </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-television-guide menu-icon"></i> My Results</p>
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

                  <?php 
                  if($school_results==1){
                  $resultsls= $pdo->query("SELECT `level`, `semester`, `matno` FROM `results` WHERE  `matno`='$student_matno' GROUP BY `level`, `semester`");?>
                  <?php while($fecthLS = $resultsls->fetch()){?>
                    <a class="btn btn-outline-primary btn-icon-text" href="javascript:void(0);" NAME="Error Handling"title="ZeroDivisionError handling" onClick=window.open("result_page?matno=<?php echo encryptor('encrypt',$fecthLS["matno"]);?>&level=<?php echo encryptor('encrypt',$fecthLS["level"]);?>&semester=<?php echo encryptor('encrypt',$fecthLS["semester"]);?>","Ratting","width=850,height=670,left=150,top=200,toolbar=0,status=0,");>

                  <i class="mdi mdi-book-open-page-variant mdi-30px"></i>
                  <span class="d-inline-block text-left">
                  <small class="font-weight-light d-block"><?php echo $fecthLS["level"];?></small>
                  <?php echo $semester_arr[$fecthLS["semester"]];?></span>
                  </a>
                  <?php }?>
                  <?php $results= $pdo->query("SELECT * FROM `results` WHERE  `matno`='$student_matno'");?>
                  <div class="table-responsive">
                    <table id="order-listing" class="table" cellspacing="0" width="100%">
                    <tr class="bg-primary text-white">
                    <th>#</th>
                    <th>Title/Code</th>
                    <th>Unit</th>
                    <th>Mark</th>
                    <th>Grade</th><!--
                    <th>Points</th>
                    <th>WPts</th>-->
                    <th>Semester</th>
                    <th>Session</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $unit = 0; $gp = 0;
                      $idn = 1; while($resRow =$results->fetch()){
                        $unit = ($unit + $resRow["unit"]);
                        $gp = ($gp + $resRow["gp"]);
                        ?>
                    <tr>
                    <td>1</td>
                    <td><?php echo $resRow["title"];?>(<?php echo $resRow["code"];?>)</td>
                    <td><?php echo $resRow["unit"];?></td>
                    <td><?php echo $resRow["score"];?></td>
                    <td><?php echo $resRow["grade"];?></td>
                    <td><?php echo $semester_arr[$resRow["semester"]];?></td>
                    <td><?php echo $resRow["session"];?></td>
                    </tr>
                    <?php }?>
                    </tbody>
                    </table>
                  </div>
                  <div class="table-responsive">
                  <table id="order-listing" class="table table-bordered table-striped ">
                  <tr class="bg-success text-white">
                  <th>Total Unit</th>
                  <th>GP</th>
                  <th>GPA</th>
                  </tr>
                  </thead>
                  <tbody>
                  <td><?php echo @$unit;?></td>
                  <td><?php echo number_format(@$gp,2);?></td>
                  <td><?php if($unit ==0){echo "0.00";} else{ echo number_format((@$gp/@$unit), 2);}?></td>
                  </tbody>
                  </table>
                  </div>
                  <?php 
                }
                else{?>
Result page page is susspended at the moment
                <?php }?>
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