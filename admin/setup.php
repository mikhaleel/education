<?php include "header.php"?>            
          <div class="main-panel">
          <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Settings </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-settings menu-icon"></i> Settings</p>
                  </a>
                  <a class="ps-3 me-4" href="#">
                    <p class="m-0">Page</p>
                  </a>
                </div>
              </div>
            </div>
            <!-- doughnut chart row starts -->
            <div class="row">
              <div class="col-sm-12 stretch-card grid-margin">
                <div class="card">
                <div class="row">
                  <?php  if(isset($_POST['fupload']))
                    {
                      $certs = "schoologo";
                      $new_file_name = str_replace(' ','',$certs).'.png';
                      $target_dir = "../";
                      $file_name = $_FILES['file_upload']['name'];
                      $file_size = $_FILES['file_upload']['size'];
                      $file_tmp = $_FILES['file_upload']['tmp_name'];
                      $file_type = $_FILES['file_upload']['type'];
                      $expld = explode('.',$_FILES['file_upload']['name']);
                      $file_ext = strtolower(end($expld));
                      
                      $extensions = array("jpeg","jpg","png");
                      
                      if(in_array($file_ext,$extensions) === false) {
                          echo '<div class="alert alert-info">Extension not allowed, please choose a JPEG or PNG file.</div>';
                      }
                      
                      if($file_size > 2097152) {
                          echo '<div class="alert alert-info">File size must be less than 2 MB.</div>';
                      }
                      
                      move_uploaded_file($file_tmp, $target_dir . $new_file_name);
                      echo "File uploaded successfully.";
                      $sfile_name = $target_dir . $new_file_name;

                      $instfile = $pdo->prepare("UPDATE  `config` SET `logo`=?");
                      $instfile->execute([$sfile_name]);
                      if($instfile) { 
                        
				               echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> Uploading/Inserting file data....</div><script>setTimeout(function(){location.href=""},1000)</script>';
                        
                        //echo '<div class="alert alert-info"><b>RECORD INSERTED!!</div>';
                      }
                    }
                   
                  if(isset($_POST["configur"]))
                  {
                    $school = $_POST['school']; 
                    $abb = $_POST['abb']; 
                    $add = $_POST['add']; 
                    $contact = $_POST['contact']; 
                    $email = $_POST['email']; 
                    $website = "https;//nigerpoly.edu.ng";
                    $sessions = $_POST['session']; 
                    $semester = $_POST["semester"]; 
                    $payment = $_POST['payment']; 
                    $course_registration = $_POST['course_registration'];
                    $accomodation = $_POST['accomodation']; 
                    $late_registration = $_POST['late_registration']; 
                    $results = $_POST['results'];
                    $admission = $_POST['admission']; 
                    //$admission_batch = $_POST['admission_batch']; 
                    $application_year = $_POST['application_year']; 
                    $status  = $_POST['status'];
                    
                    $findconfig = $pdo->query("SELECT `id` FROM `config`");
                    if($findconfig->rowCount()==0){

                    $configur = $pdo->prepare("INSERT INTO `config`(`school`, `abb`, `add`, `contact`, `email`, `website`, `sessions`, `semester`,  `payment`, `course_registration`, `accomodation`, `late_registration`, `results`, `admission`, `application_year`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
                    $configur->execute([$school,$abb,$add,$contact,$email,$website,$sessions,$semester,$payment,$course_registration,$accomodation,$late_registration,$results,$admission,$application_year,$status]);

                    echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> Uploading/Inserting file data....</div><script>setTimeout(function(){location.href=""},1000)</script>';

                    }
                    else
                    {
                      $configur = $pdo->prepare("UPDATE `config` SET `school`=?, `abb`=?, `add`=?, `contact`=?, `email`=?, `website`=?, `sessions`=?, `semester`=?,  `payment`=?, `course_registration`=?, `accomodation`=?, `late_registration`=?, `results`=?, `admission`=?, `application_year`=?, `status`=?");
                      $configur->execute([$school,$abb,$add,$contact,$email,$website,$sessions,$semester,$payment,$course_registration,$accomodation,$late_registration,$results,$admission,$application_year,$status]);

                      echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> Uploading/Inserting file data....</div><script>setTimeout(function(){location.href=""},1000)</script>';

                    }
                }
                  $getconfig = $pdo->query("SELECT * FROM `config`"); $the_config = $getconfig->fetch();
                  ?>
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> <i class="mdi mdi-settings  menu-icon"></i> School Setup</h4>
                 <center> <img src="../schoologo.png" width="80px" height="80px" class="img-lg rounded-circle mb-2" alt="profile image"/>
                 <h3 class="mt-2 text-success font-weight-bold"><?php echo $the_config["school"];?></h3></center>

                <form name="fileform" action="" method="POST" enctype="multipart/form-data">
                  <input name="file_upload" type="file" class="form-control">
                  <button name="fupload" type="Submit" class="btn btn-primary">Upload School Logo</button>
                </form>
                </div>
              </div>
            </div>
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Config</h4>
                  
                <form name="fileform" action="" method="POST" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">School</label>
                            <input class="form-control" type="text" placeholder="School" name="school" required value="<?php echo $the_config["school"];?>">
                          </div>
                        </div> <input type="hidden" value="1" name="uid">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Abbreviation</label>
                          
                                <input class="form-control" type="text"  placeholder="Abbreviation"  name="abb" required value="<?php echo $the_config["abb"];?>">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Address </label>
                            <input class="form-control" type="text" placeholder="Address" name="add" required value="<?php echo $the_config["add"];?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" placeholder="Email" name="email" required value="<?php echo $the_config["email"];?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">GSM</label>
                            <input class="form-control" type="text" placeholder="contact" name="contact" required value="<?php echo $the_config["contact"];?>">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Active Session</label>
                            <input class="form-control" name="session" id="session" required value="<?php echo $the_config["sessions"];?>">
                                             
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Active Semester</label>
                            <input class="form-control" name="semester" id="semester" value="<?php echo $the_config["semester"];?>" required>
                     </div>
                        </div>
                    <div class="col-sm-6 col-md-6">
                    <div class="mb-3">
                    <label class="form-label">Payment</label>
                     <select class="form-control" name="payment" id="payment" required>
                       <option value="1">Active</option>
                       <option value="0">Inactive</option>
                   </select>                        
                  </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Course Registration</label>
                            <select class="form-control" name="course_registration" id="course_registration" required>
                       <option value="1">Active</option>
                       <option value="0">Inactive</option>
                   </select>                         
                 </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Accomodation</label>
                            <select class="form-control" name="accomodation" id="accomodation" required>

                       <option value="1" selected>Active</option>
                       <option value="1">Active</option>
                       <option value="0">Inactive</option>
                   </select>                        
                  </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Late Registration</label>
                            <select class="form-control" name="late_registration" id="late_registration" required>

                       <option value="1" selected>Active</option>
                       <option value="1">Active</option>
                       <option value="0">Inactive</option>
                   </select>                       
                   </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Admission</label>
                            <select class="form-control" name="admission" id="admission" required>
                              <option value="1" selected>Active</option>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>                          
                        </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Result</label>
                            <select class="form-control" name="results" id="results" required>
                              <option value="1" selected>Active</option>
                              <option value="1">Active</option>
                              <option value="0">Inactive</option>
                            </select>                          
                        </div>
                        </div>
                        <div class="col-sm-12 col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Application Year</label>
                            <input class="form-control" name="application_year" id="application_year" value="<?php echo $the_config["application_year"];?>" required>
                        </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" id="status" required>

                       <option value="active" selected>active</option>
                       <option value="active">active</option>
                       <option value="maintenance">maintenance</option>
                   </select>                          </div>
                        </div>
                        
                    </div>
                    <div class="card-footer text-end">
                      <button class="btn btn-primary" name="configur" type="submit">Save</button><br><br>
                        <p align="left"><a href="" class="btn btn-danger">Promote Students</a></p>
                        </div>
                  </form>
                </div>
              </div>
            </div>
                </div>
              
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
         <?php include "footer.php"?>