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
                    <div class="form-group">
                      <!-- <label for="exampleInputUsername1">Username</label> -->
                      <ul>
                          <li><a href="?title=COURSES&report_course_summary"> Courses</a></li> 
                          <li><a href="?title=PAYMENT&report_payment_summary"> Payments Summary</a></li> 
                          <li><a href="?title=TRANSACTION&report_transaction_log"> Transaction Logs</a></li> 
                          <li><a href="?title=SCHEDULE&report_payment_schedule"> Payment Schedule </a></li> 
                          <li><a href="?title=STUDENTS&report_student_list"> Student Lists</a></li> 
                          <li><a href="?title=APPLICANTS&report_applicants"> Admission</a></li>                                 
                       <!-- <option value="?report_accomodation"> Accommodation</option> -->
                      </ul>
                    </div>
                </div>
              </div>
            </div>
            	 <div class="col-md-8 grid-margin stretch-card">
              <div class="card">
              <?php if(isset($_POST['report_course']))
              {
                $programme = $_POST["programme"];
                $level = $_POST["level"];
                $semester = $_POST["semester"]; //,,
                echo '<div class="alert alert-info"><b>Please wait</b> Generating Report....</div><script>setTimeout(function(){window.open("report_course_list?programme='.$programme.'&level='.$level.'&semester='.$semester.'", "_blank")},1000)</script>';

              }
              if(isset($_POST['report_payment']))
              {
                $programme = $_POST["programme"];
                $level = $_POST["level"];
                $type = $_POST["type"];
                $session = $_POST["session"];
                $status = $_POST["status"];
                $semester = $_POST["semester"]; //,,
                echo '<div class="alert alert-info"><b>Please wait</b> Generating Report....</div><script>setTimeout(function(){window.open("report_payment_list?programme='.$programme.'&level='.$level.'&semester='.$semester.'&session='.$session.'&type='.$type.'&status='.$status.'", "_blank")},1000)</script>';

              }
              if(isset($_POST['report_schedule']))
              {
                $category = $_POST["category"];
                $level = $_POST["level"];
                //$type = $_POST["type"];
                $session = $_POST["session"];
                //$status = $_POST["status"];
                $semester = $_POST["semester"]; //,,
                echo '<div class="alert alert-info"><b>Please wait</b> Generating Report....</div><script>setTimeout(function(){window.open("report_schedule_list?category='.$category.'&level='.$level.'&semester='.$semester.'&session='.$session.'", "_blank")},1000)</script>';

              }
              if(isset($_POST['report_student']))
              {
                $programme = $_POST["programme"];
                $level = $_POST["level"];
                $session = $_POST["session"];
                echo '<div class="alert alert-info"><b>Please wait</b> Generating Report....</div><script>setTimeout(function(){window.open("report_student_list?programme='.$programme.'&level='.$level.'&session='.$session.'", "_blank")},1000)</script>';

              }
              if(isset($_POST['report_applicant']))
              {
                $admstatus = $_POST["admstatus"];
                $level = $_POST["level"];
                $session = $_POST["session"];
                echo '<div class="alert alert-info"><b>Please wait</b> Generating Report....</div><script>setTimeout(function(){window.open("report_applicant_list?admstatus='.$admstatus.'&level='.$level.'&session='.$session.'", "_blank")},1000)</script>';

              }?>
                <div class="card-body">
                  <h4 class="card-title">Report Parameter </h4>
                  <div class="alert alert-success dark" role="alert">
                  <?php if(isset($_GET["title"])){ echo $_GET["title"];}?>              
                </div>
                  <hr>
                  <!-- <form name="frmpg" class="forms-sample" action="report_citizens_list" method="GET" id="frmpg" target="_blank"> -->
                  <?php if(isset($_GET["title"])){
                    if($_GET["title"]=="COURSES")
                    {?>
                    <form name="coursefrm" method="post" action="">
                      <div class="form-group row">
                        <div class="col-sm-12">
                        <label for="recipient-name" class="col-form-label">Programme:</label>
                        <select class="form-control" name="programme" id="status" required>
                          <option value="all">All programmes</option>
                          <?php 
                          $coursprog = $pdo->query("SELECT programme from course GROUP BY programme");
                          while($prow = $coursprog->fetch()){?>
                            <option value="<?php echo $prow["programme"];?>"><?php echo $prow["programme"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">Level:</label>
                        <select class="form-control" name="level" id="status" required>
                          <option value="all">All Level</option>
                          <?php 
                          $courslev = $pdo->query("SELECT `level` from course GROUP BY level");
                          while($lrow = $courslev->fetch()){?>
                            <option value="<?php echo $lrow["level"];?>"><?php echo $lrow["level"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">Semester:</label>
                        <select class="form-control" name="semester" id="status" required>
                          <option value="all">All Semester</option>
                          <?php 
                          $courssem = $pdo->query("SELECT `semester` from course GROUP BY semester");
                          while($serow = $courssem->fetch()){?>
                            <option value="<?php echo $serow["semester"];?>"><?php echo $serow["semester"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <p>
                        <hr>
                        </p>
                        <p align="right">
                          <button type="submit" class="btn btn-primary mr-2" name="report_course">Display</button>
                        </p>
                      </div>
                    </form>
                     <?php
                    }
                    if($_GET["title"]=="PAYMENT")
                    {?>
                    <form method="post" action="" name="frmn">
                      <div class="form-group row">
                        <div class="col-sm-12">
                        <label for="recipient-name" class="col-form-label">Programme:</label>
                        <select class="form-control" name="programme" id="status" required>
                          <option value="all">All programmes</option>
                          <?php 
                          $coursprog = $pdo->query("SELECT programme from `stu_payloader` GROUP BY programme");
                          while($pyrow = $coursprog->fetch()){?>
                            <option value="<?php echo $pyrow["programme"];?>"><?php echo $pyrow["programme"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">Payment type:</label>
                        <select class="form-control" name="type" id="status" required>
                          <option value="all">All type</option>
                          <?php 
                          $courslev = $pdo->query("SELECT `type` from `stu_payloader` GROUP BY type");
                          while($lrow = $courslev->fetch()){?>
                            <option value="<?php echo $lrow["type"];?>"><?php echo $lrow["type"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">Level:</label>
                        <select class="form-control" name="level" id="status" required>
                          <option value="all">All Level</option>
                          <?php 
                          $courslev = $pdo->query("SELECT `level` from `stu_payloader` GROUP BY level");
                          while($lrow = $courslev->fetch()){?>
                            <option value="<?php echo $lrow["level"];?>"><?php echo $lrow["level"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">session:</label>
                        <select class="form-control" name="session" id="status" required>
                          <option value="">Choose Session</option>
                          <?php 
                          $courssem = $pdo->query("SELECT `session` from `stu_payloader` GROUP BY session");
                          while($serow = $courssem->fetch()){?>
                            <option value="<?php echo $serow["session"];?>"><?php echo $serow["session"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">Semester:</label>
                        <select class="form-control" name="semester" id="status" required>
                          <option value="">Choose Semester</option>
                          <?php 
                          $courssem = $pdo->query("SELECT `semester` from `stu_payloader` GROUP BY semester");
                          while($serow = $courssem->fetch()){?>
                            <option value="<?php echo $serow["semester"];?>"><?php echo $serow["semester"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <div class="col-sm-6">
                        <label for="recipient-name" class="col-form-label">Status:</label>
                        <select class="form-control" name="status" id="status" required>
                          <option value="">Choose Status</option>
                          <?php 
                          $courss = $pdo->query("SELECT `status` from `stu_payloader` GROUP BY status");
                          while($serow = $courss->fetch()){?>
                            <option value="<?php echo $serow["status"];?>"><?php echo $serow["status"];?></option>
                          <?php }?>
                          </select>                      
                        </div>
                        <p>
                        <hr>
                        </p>
                        <p align="right">
                          <button type="submit" class="btn btn-primary mr-2" name="report_payment">Display</button>
                        </p>
                      </div>
                    </form>
                     <?php
                    }
                    if($_GET["title"]=="SCHEDULE")
                    {?>
                      <form method="post" action="" name="frmnsc">
                        <div class="form-group row">
                          <div class="col-sm-12">
                          <label for="recipient-name" class="col-form-label">Category:</label>
                          <select class="form-control" name="category" id="status" required>
                            <option value="all">All Category</option>
                            <?php 
                            $coursprog = $pdo->query("SELECT category from `payment_schedule` GROUP BY category");
                            while($pyrow = $coursprog->fetch()){?>
                              <option value="<?php echo $pyrow["category"];?>"><?php echo $pyrow["category"];?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <div class="col-sm-6">
                          <label for="recipient-name" class="col-form-label">Level:</label>
                          <select class="form-control" name="level" id="status" required>
                            <option value="all">All Level</option>
                            <?php 
                            $courslev = $pdo->query("SELECT `level` from `payment_schedule` GROUP BY level");
                            while($lrow = $courslev->fetch()){?>
                              <option value="<?php echo $lrow["level"];?>"><?php echo $lrow["level"];?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <div class="col-sm-6">
                          <label for="recipient-name" class="col-form-label">session:</label>
                          <select class="form-control" name="session" id="status" required>
                            <option value="">Choose Session</option>
                            <?php 
                            $courssem = $pdo->query("SELECT `session` from `payment_schedule` GROUP BY session");
                            while($serow = $courssem->fetch()){?>
                              <option value="<?php echo $serow["session"];?>"><?php echo $serow["session"];?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <div class="col-sm-6">
                          <label for="recipient-name" class="col-form-label">Semester:</label>
                          <select class="form-control" name="semester" id="status" required>
                            <option value="">Choose Semester</option>
                            <?php 
                            $courssem = $pdo->query("SELECT `semester` from `payment_schedule` GROUP BY semester");
                            while($serow = $courssem->fetch()){?>
                              <option value="<?php echo $serow["semester"];?>"><?php echo $serow["semester"];?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <p>
                          <hr>
                          </p>
                          <p align="right">
                            <button type="submit" class="btn btn-primary mr-2" name="report_schedule">Display</button>
                          </p>
                        </div>
                      </form>
                     <?php
                    }
                    if($_GET["title"]=="STUDENTS")
                    {?>
                      <form name="coursefrm" method="post" action="">
                        <div class="form-group row">
                          <div class="col-sm-12">
                          <label for="recipient-name" class="col-form-label">Programme:</label>
                          <select class="form-control" name="programme" id="status" required>
                            <option value="all">All programmes</option>
                            <?php 
                            $coursprog = $pdo->query("SELECT programme from `students` GROUP BY programme");
                            while($prow = $coursprog->fetch()){?>
                              <option value="<?php echo $prow["programme"];?>"><?php echo $prow["programme"];?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <div class="col-sm-6">
                          <label for="recipient-name" class="col-form-label">Level:</label>
                          <select class="form-control" name="level" id="status" required>
                            <option value="all">All Level</option>
                            <?php 
                            $courslev = $pdo->query("SELECT `level` from `students` GROUP BY level");
                            while($lrow = $courslev->fetch()){?>
                              <option value="<?php echo $lrow["level"];?>"><?php echo $lrow["level"];?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <div class="col-sm-6">
                          <label for="recipient-name" class="col-form-label">Entry Session:</label>
                          <select class="form-control" name="session" id="status" required>
                            <option value="all">All Session</option>
                            <?php 
                            $courssem = $pdo->query("SELECT `entry_session` from `students` GROUP BY entry_session");
                            while($serow = $courssem->fetch()){?>
                              <option value="<?php echo $serow["entry_session"];?>"><?php echo $serow["entry_session"];?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <p>
                          <hr>
                          </p>
                          <p align="right">
                            <button type="submit" class="btn btn-primary mr-2" name="report_student">Display</button>
                          </p>
                        </div>
                      </form>
                     <?php
                    }
                    if($_GET["title"]=="APPLICANTS")
                    {?>
                      <form name="coursefrmS" method="post" action="">
                        <div class="form-group row">
                          <div class="col-sm-12">
                          <label for="recipient-name" class="col-form-label">Status:</label>
                          <select class="form-control" name="admstatus" id="status" required>
                            <option value="No">All Applicant</option>
                            <?php 
                            $coursprog = $pdo->query("SELECT adm_status from `applicant` GROUP BY adm_status");
                            while($prow = $coursprog->fetch()){
                              if($prow["adm_status"] =="Yes"){
                                $optval = "Admitted Applicant";
                              }
                              else
                              {
                                $optval = "All Applicant";
                              }
                              ?>
                              <option value="<?php echo $prow["adm_status"];?>"><?php echo $optval;?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <div class="col-sm-6">
                          <label for="recipient-name" class="col-form-label">Level:</label>
                          <select class="form-control" name="level" id="status" required>
                            <option value="all">All Level</option>
                            <?php 
                            $courslev = $pdo->query("SELECT `level` from `applicant` GROUP BY level");
                            while($lrow = $courslev->fetch()){?>
                              <option value="<?php echo $lrow["level"];?>"><?php echo $lrow["level"];?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <div class="col-sm-6">
                          <label for="recipient-name" class="col-form-label"> Session:</label>
                          <select class="form-control" name="session" id="status" required>
                            <option value="all">All Session</option>
                            <?php 
                            $courssem = $pdo->query("SELECT `year` from `applicant` GROUP BY year");
                            while($serow = $courssem->fetch()){?>
                              <option value="<?php echo $serow["year"];?>"><?php echo $serow["year"]."/".($serow["year"]+1);?></option>
                            <?php }?>
                            </select>                      
                          </div>
                          <p>
                          <hr>
                          </p>
                          <p align="right">
                            <button type="submit" class="btn btn-primary mr-2" name="report_applicant">Display</button>
                          </p>
                        </div>
                      </form>
                     <?php
                    }?>
                    
                  <?php }?>
                  <!-- </form> -->
                </div>
                  </div>
            </div>
                </div>
          </div>
        <!-- content-wrapper ends -->
      <?php include "footer.php"?>