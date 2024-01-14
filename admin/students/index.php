<?php include "header.php"?>            
          <div class="main-panel">
          <div class="content-wrapper pb-0">
            <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Profile </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-account-card-details  menu-icon"></i> Profile</p>
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
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> <i class="mdi mdi-account  menu-icon"></i> Profile</h4>
                 <center> <img src="profile_image.jpg" width="80px" height="80px" class="img-lg rounded-circle mb-2" alt="profile image"/>
                 <h3 class="mt-2 text-success font-weight-bold"><?php echo $student_name;?></h3>
                 <h5><?php echo $student_matno;?></h5>
                 <p><strong>Gender :</strong> <?php echo $student_sex;?></p>
                </center>
                 <table class="table table-borderless w-100 mt-4">
                              <tr>
                                <td><strong>Full Name :</strong> <?php echo $student_name;?></td>
                              </tr>
                              <tr>
                              <td><strong>Phone :</strong> <?php echo $student_contact;?></td>
                              </tr>
                              <tr>
                                <td><b>Programmes:</b> <?php echo $student_programme;?> <b class="text-primary">(<?php echo $student_level;?>)</b></td>
                              </tr>
                              <tr>
                                <td><b>College:</b><?php echo $student_college;?></td>
                              </tr>
                            </table>
                </div>
              </div>
            </div>
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <?php 
                  if(isset($_POST["btn_student"]))
                  {
                    $id = encryptor('decrypt',$_POST["stid"]);
                    $updatests = $pdo->prepare("UPDATE `students` SET `password`=?, `contact`=? WHERE id = ?");
                    $updatests->execute([$_POST["password"],$_POST["contact"],$id]);
                    if($updatests)
                    {
                      echo '<div class="alert alert-info"><b>Please wait</b> Updating records....</div><script>setTimeout(function(){location.href="index?matno='.$_POST["stid"].'"},1000)</script>';
                    }
                  }
                  ?>
                  <h4 class="card-title">My Accounts Details</h4>
                  <form class="forms-sample" method="post">
                    <input name="stid" value="<?php echo encryptor('encrypt',$student_id);?>" type="hidden">
                    <div class="row">
                        <div class="col-8">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Names</label>
                      <input type="text" class="form-control" name="names" id="exampleInputUsername1" placeholder="Username" value="<?php echo $student_name;?>" readonly>
                    </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" value="<?php echo $student_password;?>">
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" readonly name="email" id="exampleInputEmail1" placeholder="Email" value="<?php echo $student_email;?>" readonly>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputConfirmPhone">Phone Number</label>
                      <input type="text" class="form-control" readonly name="contact" id="exampleInputConfirmPhone" placeholder="Phone Number" value="<?php echo $student_contact;?>">
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="form-group">
                      <label for="exampleInputConfirmPhone">Department</label>
                      <input type="text" class="form-control" readonly name="department" id="exampleInputDepartment" value="<?php echo $student_department;?>">
                    </div>
                    </div>
                    </div>
                    <button type="submit" name="btn_student" class="btn btn-primary mr-2 pull-right">Update Profile</button>
                    <!-- <button class="btn btn-light">Cancel</button> -->
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