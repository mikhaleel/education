<?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Staff Page </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-account-plus menu-icon"></i> Add New Staff</p>
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
                            <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputName1">Username</label>
                        <input type="text" class="form-control" name="username" id="exampleInputUsername" placeholder="Username">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputEmail3">Email address</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail3" placeholder="Email">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword4" placeholder="Password">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputName1">Full Name</label>
                        <input type="text" class="form-control" name="names" id="exampleInputName1" placeholder="Full Name">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputName1">Phone Number</label>
                        <input type="text" class="form-control" name="gsm" id="exampleInputPhone" placeholder="Phone Number">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" name="gender" id="exampleSelectGender">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-12">
                      <div class="form-group">
                        <label>File upload</label>
                        <input type="file" name="passport" class="file-upload-default">
                        <div class="input-group col-xs-12">
                          <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                          <span class="input-group-append">
                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                          </span>
                        </div>
                      </div>
                      </div>
                      &nbsp;
                      <h4 class="card-title"><i class=" mdi mdi-school  menu-icon"></i> About Staff</h4>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectTribe">Tribe</label>
                        <input type="text" class="form-control" name="tribe" id="exampleSelectTribe">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectGender">Religion</label>
                        <select class="form-control" name="religion" id="exampleSelectReligion">
                          <option>Islam</option>
                          <option>Christanity</option>
                          <option>Traditional</option>
                          <option>Other</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender"> Nationality </label>
                        <input type="text" class="form-control" name="nationality" id="exampleSelectNationality">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">State</label>
                        <select class="form-control" name="state" id="exampleSelectState">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">LGA</label>
                        <input type="text" class="form-control" name="lga" id="exampleSelectLGA">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectGender">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleSelectAddress">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectGender"> Designation </label>
                        <input type="text" class="form-control" name="designation" id="exampleSelectDesignation">
                      </div>
                      </div>
                      &nbsp;
                      <h4 class="card-title"><i class=" mdi mdi-school  menu-icon"></i> Academic details</h4>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">College</label>
                        <select class="form-control" name="college" id="exampleSelectCollege">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">School</label>
                        <select class="form-control" name="school" id="exampleSelectSchool">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">Department</label>
                        <select class="form-control" name="department" id="exampleSelectDepartment">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">User Type</label>
                        <select class="form-control" name="user_type" id="exampleSelectuser_type">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">Access Level</label>
                        <input type="text" class="form-control" name="access" id="exampleSelectAccess">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectGender">Status</label>
                        <select class="form-control" name="status" id="exampleSelectStatus">
                        <option>Choose</option>
                          <option>0</option>
                          <option>1</option>
                        </select>
                      </div>
                      </div>
                        </div>
                      <button type="submit" class="btn btn-primary me-2">Submit</button>
                      <a href="staff" class="btn btn-light">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- content-wrapper ends -->
         <?php include "footer.php"?>