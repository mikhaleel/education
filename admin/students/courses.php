 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Course Registration Page </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-book-variant menu-icon"></i> Course Registration</p>
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
                  if($stu_pay->rowCount() > 0)
                  {
                    if($stu_course_reg->rowCount() == 0)
                    {
                      ?>
                      <p class="alert alert-warning"> 
                        <span>New Course Registration for [<?php echo $student_level;?> <?php echo $semester_arr[$school_activesession];?>]</span>                                         
                        <a class="btn btn-warning pull-right" href="javascript:void(0);" NAME="coursereg" title="CourseRegistration" onClick=window.open("stu_course_reg?tid=<?php echo encryptor('encrypt',$student_id);?>","Ratting","width=1500,height=1170,left=150,top=50,toolbar=0,status=0,");>Register Now</a>
                       
                      </p>
                      <?php 
                    }
                  }
                  else
                  {
                    ?>
                    <p class="alert alert-info"> 
                      <span>Please make sure you pay your school fee to enable you access the course Registration page</span>                                         
                    </p>
                    <?php 
                  }?>
                  <hr>
                  <p>
                  <ul class="list-group"> 
                    <?php 
                    //fatch all courses reg
                    $stu_course_reg = $pdo->query("SELECT * FROM `stu_course_reg` WHERE `matno`='$student_matno'");
                    if($course_reg_row = $stu_course_reg->fetch())
                    {
                    ?>
                    <li class="list-group-item"><a href="stu_course_form?matno=<?php echo encryptor('encrypt',$student_matno);?>&semster=<?php echo encryptor('encrypt',$school_activesemester);?>&level=<?php echo encryptor('encrypt',$course_reg_row["level"]);?>&session=<?php echo encryptor('encrypt',$school_activesession);?>&name=<?php echo encryptor('encrypt',$student_name);?>&prog=<?php echo encryptor('encrypt',$student_programme);?>" target="_new"><?php echo $course_reg_row['level'];?> <?php echo $semester_arr[$course_reg_row['semester']];?> </a> 
                    
                    <a class="pull-right btn btn-primary" href="javascript:void(0);" NAME="coursereg" title="CourseRegistration" onClick=window.open("stu_course_reg?tid=<?php echo encryptor('encrypt',$student_id);?>","Ratting","width=1500,height=1170,left=150,top=50,toolbar=0,status=0,");> Edit</a></li>
                    <?php 
                    }?>
                  </ul>
                 </p>
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
                            <h5 class="modal-title" id="ModalLabel">Edit Courses</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form>
                                <div class="row">
                                <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">College:</label>
                                <select type="text" name="college" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">School:</label>
                                <select type="text" name="college" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Programme:</label>
                                <select type="text" name="programme" class="form-control">
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
                                <label for="recipient-name" class="col-form-label">Semester:</label>
                                <select type="text" name="sememter" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" name="title" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="code" class="col-form-label">Code:</label>
                                <input type="text" class="form-control">
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
                            <h5 class="modal-title" id="ModalLabel">Add New Courses</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form>
                                <div class="row">
                                <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">College:</label>
                                <select type="text" name="college" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">School:</label>
                                <select type="text" name="college" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Programme:</label>
                                <select type="text" name="programme" class="form-control">
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
                                <label for="recipient-name" class="col-form-label">Semester:</label>
                                <select type="text" name="sememter" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" name="title" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="code" class="col-form-label">Code:</label>
                                <input type="text" class="form-control">
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