<?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> My Data </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-folder-account menu-icon"></i> My Data</p>
                  </a>
                  <a class="ps-3 me-4" href="#">
                    <p class="m-0">Page</p>
                  </a>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title"><i class="mdi mdi-account menu-icon"></i> Personal Info</h4>
                    <form class="forms-sample">
                      <div class="row">
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" readonly name="names" id="exampleInputName" placeholder="Name" value="<?php echo $student_name;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleInputName1">UTME No</label>
                        <input type="text" class="form-control" name="utme" id="exampleInputUTME No" value="<?php echo $student_utme;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleInputName1">Mat No</label>
                        <input type="text" class="form-control" name="gsm" id="exampleInputPhone" placeholder="Mat No" readonly value="<?php echo $student_matno;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="text" class="form-control" name="password" id="exampleInputPassword4" value="<?php echo $student_password;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail" value="<?php echo $student_email;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleInputName1">Phone Number</label>
                        <input type="text" class="form-control" name="gsm" id="exampleInputPhone" value="<?php echo $student_contact;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleInputName1">Date Of Birth</label>
                        <input type="date" class="form-control" name="dob" id="exampleInputPhone" value="<?php echo $student_dob;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <input class="form-control" name="gender" id="exampleSelectGender" value="<?php echo $student_sex;?>">
                      </div>
                      </div>
                      &nbsp;
                      <h4 class="card-title"><i class=" mdi mdi-school  menu-icon"></i> About Student</h4>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectTribe">Tribe</label>
                        <input type="text" class="form-control" name="tribe" id="exampleSelectTribe" value="<?php echo $student_tribe;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectReligion">Religion</label>
                        <input class="form-control" name="religion" id="exampleSelectReligion" value="<?php echo $student_religion;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectNationality"> Nationality </label>
                        <input type="text" class="form-control" name="nationality" id="exampleSelectNationality" value="<?php echo $student_country;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectState">State</label>
                        <input class="form-control" name="state" id="exampleSelectState" value="<?php echo $student_state;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectLGA">LGA</label>
                        <input type="text" class="form-control" name="lga" id="exampleSelectLGA" value="<?php echo $student_lga;?>">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectAddress">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleSelectAddress" value="<?php echo $student_address;?>">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectOthersr"> Others </label>
                        <input type="text" class="form-control" name="designation" id="exampleSelectDesignation">
                      </div>
                      </div>
                      &nbsp;
                      <h4 class="card-title"><i class=" mdi mdi-school  menu-icon"></i> Academic details</h4>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectCollege">College</label>
                        <input class="form-control" disabled name="college" id="exampleSelectCollege" value="<?php echo $student_college;?>">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectSchool">School</label>
                        <input class="form-control" disabled name="school" id="exampleSelectSchool" value="<?php echo $student_school;?>">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectDepartment">Department</label>
                        <input class="form-control" disabled name="department" id="exampleSelectDepartment" value="<?php echo $student_department;?>">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectProgrammes">Programmes</label>
                        <input class="form-control" disabled name="programmes" id="exampleSelectuser_type" value="<?php echo $student_programme;?>" >
                      </div>
                      </div>
                      <div class="col-2">
                      <div class="form-group">
                        <label for="exampleSelectLevel">Level</label>
                        <input class="form-control" disabled name="level" id="exampleSelectLevel" value="<?php echo $student_level;?>">
                      </div>
                      </div>
                      <div class="col-2">
                      <div class="form-group">
                        <label for="exampleSelectSemester">Semester</label>
                        <input class="form-control" disabled name="semester" id="exampleSelectSemester" value="<?php echo $student_semester;?>">
                      </div>
                      </div>
                      <div class="col-2">
                      <div class="form-group">
                        <label for="exampleSelectSession">Session</label>
                        <input class="form-control" disabled name="session" id="exampleSelectSession" value="<?php echo $student_session;?>" >
                      </div>
                      </div>
                        </div>
                      <!-- <button type="submit" class="btn btn-primary me-2">Submit</button> -->
                      <!-- <a href="staff" class="btn btn-light">Cancel</a> -->
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- content-wrapper ends -->
         <?php include "footer.php"?>