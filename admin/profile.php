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
            <!-- doughnut chart row starts 
          $_SESSION["username"] = $trows["username"];
				$_SESSION["names"] = $trows["names"];
				$_SESSION["designation"] = $trows["designation"];
				$_SESSION["school"] = $trows["school"];
				$_SESSION["dept_id"] = $dpt_ids["dept_id"];//$trows["department"];
				$_SESSION["department"] =$trows["department"];
          -->
            <div class="row">
              <div class="col-sm-12 stretch-card grid-margin">
                <div class="card">
                <div class="row">
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> <i class="mdi mdi-account  menu-icon"></i> Profile</h4>
                 <center> <img src="profile_image.jpg" width="80px" height="80px" class="img-lg rounded-circle mb-2" alt="profile image"/>
                 <h3 class="mt-2 text-success font-weight-bold"><?php echo $_SESSION["designation"];?></h3></center>
                 <table class="table table-borderless w-100 mt-4">
                              <tr>
                                <td><strong>Full Name :</strong> <?php echo $_SESSION["names"];?></td>
                              </tr>
                              <tr>
                                <td><strong>Email :</strong> <?php echo $_SESSION["username"];?></td>
                              </tr>
                            </table>
                </div>
              </div>
            </div>
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <?php 
                if(isset($_POST["btnadd"]))
                {
                  $password = $_POST["password"];
                  $phone = $_POST["phone"];
                  $id = encryptor('decrypt',$_SESSION["usreid"]);
                  $profile=$pdo->prepare("UPDATE `staff` SET `password` = ?, `gsm` = ? WHERE `id` = ?");
                  $profile->execute([$password,$phone,$id]);
                  if($profile)
                  {
                    echo '<div class="alert alert-info"><b>Please wait</b> Updating records....</div><script>setTimeout(function(){location.href="profile"},10000)</script>';
                  }
                }?>
                <div class="card-body">
                  <h4 class="card-title">My Accounts Details- <?php //echo encryptor('decrypt',$_SESSION["usreid"]);?></h4>
                  <form class="forms-sample" method="post">
                    <div class="row">
                        <div class="col-4">
                    <div class="form-group">
                      <label for="exampleInputUsername1">Names</label>
                      <input type="text" class="form-control" name="names" id="exampleInputUsername1" placeholder="Username" value="<?php echo $_SESSION["names"];?>" readonly>
                    </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Username</label>
                      <input type="text" class="form-control" name="username" id="exampleInputUsername1" placeholder="Username" value="<?php echo $_SESSION["username"];?>" readonly>
                    </div>
                    </div>
                    <div class="col-4">
                    <div class="form-group">
                      <label for="exampleInputPassword1">Password</label>
                      <input type="text" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" value="<?php echo $_SESSION["password"] ;?>">
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                      <input type="email" class="form-control" name="email" id="exampleInputEmail1" placeholder="Email" value="<?php echo $_SESSION["username"];?>" readonly>
                    </div>
                    </div>
                    <div class="col-6">
                    <div class="form-group">
                      <label for="exampleInputConfirmPhone">Phone Number</label>
                      <input type="text" class="form-control" name="phone" id="exampleInputConfirmPhone" placeholder="Phone Number" value="<?php echo $_SESSION["gsm"] ;?>">
                    </div>
                    </div>
                    <div class="col-12">
                    <div class="form-group">
                      <label for="exampleInputDepartment">Department</label>
                      <input type="text" class="form-control" name="department" id="exampleInputDepartment" placeholder="Department" value="<?php echo $_SESSION["department"] ;?>" readonly>
                    </div>
                    </div>
                    </div>
                    <button type="submit" name="btnadd" class="btn btn-primary mr-2 pull-right">Update Profile</button>
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