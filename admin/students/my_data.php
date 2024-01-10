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
                        <input type="text" class="form-control" readonly name="names" id="exampleInputName" placeholder="Name" value="BELLO BILYAMINU ">
                      </div>
                      </div>
                      <div class="col-2">
                      <div class="form-group">
                        <label for="exampleInputApplication No 3">Application No </label>
                        <input type="text" readonly class="form-control" name="applicationno" id="exampleInputApplication No " placeholder="Application No ">
                      </div>
                      </div>
                      <div class="col-2">
                      <div class="form-group">
                        <label for="exampleInputName1">UTME No</label>
                        <input type="text" class="form-control" name="utme" id="exampleInputUTME No" placeholder="UTME No">
                      </div>
                      </div>
                      <div class="col-2">
                      <div class="form-group">
                        <label for="exampleInputName1">Mat No</label>
                        <input type="text" class="form-control" name="gsm" id="exampleInputPhone" placeholder="Mat No" readonly value="DCM/020/008">
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleInputPassword4">Password</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword4" placeholder="Password">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputName1">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail" placeholder="Email Address">
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
                        <label for="exampleInputName1">Date Of Birth</label>
                        <input type="date" class="form-control" name="dob" id="exampleInputPhone" placeholder="Dob">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectGender">Gender</label>
                        <select class="form-control" name="gender" id="exampleSelectGender">
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-6">
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
                      <h4 class="card-title"><i class=" mdi mdi-school  menu-icon"></i> About Student</h4>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectTribe">Tribe</label>
                        <input type="text" class="form-control" name="tribe" id="exampleSelectTribe">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectReligion">Religion</label>
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
                        <label for="exampleSelectNationality"> Nationality </label>
                        <input type="text" class="form-control" name="nationality" id="exampleSelectNationality">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectState">State</label>
                        <select class="form-control" name="state" id="exampleSelectState">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectLGA">LGA</label>
                        <input type="text" class="form-control" name="lga" id="exampleSelectLGA">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectAddress">Address</label>
                        <input type="text" class="form-control" name="address" id="exampleSelectAddress">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectOthersr"> Others </label>
                        <input type="text" class="form-control" name="designation" id="exampleSelectDesignation">
                      </div>
                      </div>
                      &nbsp;
                      <h4 class="card-title"><i class=" mdi mdi-account-key  menu-icon"></i> Next of Kin Details</h4>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail" placeholder="Name" value="Idris">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputAddress1">Address</label>
                        <input type="text" class="form-control" name="add" id="exampleInputPhone" placeholder="Address" value="Minna">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputPhone1">Phone Number</label>
                        <input type="text" class="form-control" name="gsm" id="exampleInputPhone" placeholder="Phone Number">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputOccupation1">Occupation</label>
                        <input type="text" class="form-control" name="occupation" id="exampleInputOccupation" placeholder="Occupation" value="Programmer">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputRelationship1">Relationship</label>
                        <input type="text" class="form-control" name="relationship" id="exampleInputPhone" placeholder="Relationship" value="Bro">
                      </div>
                      </div>
                      &nbsp;
                      <h4 class="card-title"><i class=" mdi mdi-account-key  menu-icon"></i> Sponsor Details</h4>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail" placeholder="Name" value="Idris">
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleInputAddress1">Address</label>
                        <input type="text" class="form-control" name="add" id="exampleInputPhone" placeholder="Address" value="Minna">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputPhone1">Phone Number</label>
                        <input type="text" class="form-control" name="gsm" id="exampleInputPhone" placeholder="Phone Number">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputOccupation1">Occupation</label>
                        <input type="text" class="form-control" name="occupation" id="exampleInputOccupation" placeholder="Occupation" value="Programmer">
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleInputRelationship1">Relationship</label>
                        <input type="text" class="form-control" name="relationship" id="exampleInputPhone" placeholder="Relationship" value="Bro">
                      </div>
                      </div>
                      &nbsp;
                      <h4 class="card-title"><i class=" mdi mdi-school  menu-icon"></i> Academic details</h4>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectCollege">College</label>
                        <select class="form-control" disabled name="college" id="exampleSelectCollege">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectSchool">School</label>
                        <select class="form-control" disabled name="school" id="exampleSelectSchool">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-4">
                      <div class="form-group">
                        <label for="exampleSelectDepartment">Department</label>
                        <select class="form-control" disabled name="department" id="exampleSelectDepartment">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectProgrammes">Programmes</label>
                        <select class="form-control" disabled name="programmes" id="exampleSelectuser_type">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectLevel">Level</label>
                        <select class="form-control" disabled name="level" id="exampleSelectLevel">
                          <option>Choose</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectSemester">Semester</label>
                        <select class="form-control" disabled name="semester" id="exampleSelectSemester">
                        <option>Choose</option>
                          <option>0</option>
                          <option>1</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-3">
                      <div class="form-group">
                        <label for="exampleSelectSession">Session</label>
                        <select class="form-control" disabled name="session" id="exampleSelectSession">
                        <option>Choose</option>
                          <option>2020/2021</option>
                          <option>2021/2022</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectStudyCenter">Study Center</label>
                        <select class="form-control" disabled name="center" id="exampleSelectStudyCenter">
                        <option>Choose</option>
                          <option>2020/2021</option>
                          <option>2021/2022</option>
                        </select>
                      </div>
                      </div>
                      <div class="col-6">
                      <div class="form-group">
                        <label for="exampleSelectMode">Mode of Entry</label>
                        <select class="form-control" disabled name="mode" id="exampleSelectMode">
                        <option>Choose</option>
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