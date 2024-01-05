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
            <div class="col-md-5 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title"> <i class="mdi mdi-settings  menu-icon"></i> School Setup</h4>
                 <center> <img src="profile_image.jpg" width="80px" height="80px" class="img-lg rounded-circle mb-2" alt="profile image"/>
                 <h3 class="mt-2 text-success font-weight-bold">ADMINISTRATOR</h3></center>

                </div>
              </div>
            </div>
            <div class="col-md-7 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Config</h4>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">School</label>
                            <input class="form-control" type="text" placeholder="School" name="school" required value="Niger State Polytechic">
                          </div>
                        </div> <input type="hidden" value="1" name="uid">
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Abbreviation</label>
                          
                                <input class="form-control" type="text"  placeholder="Abbreviation"  name="abb" required value="E-PORTAL">
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Address </label>
                            <input class="form-control" type="text" placeholder="Address" name="add" required value="Zungeru and Bida">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control" type="email" placeholder="Email" name="email" required value="info@nigerpoly.edu.ng">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">GSM</label>
                            <input class="form-control" type="text" placeholder="contact" name="contact" required value="234 080 51302033">
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Active Session</label>
                            <select class="form-control" name="session" id="session" required>                   
                       <option value="2022/2023">2022/2023</option>
                         </select>                        
                          </div>
                        </div>
                        <div class="col-sm-6 col-md-6">
                          <div class="mb-3">
                            <label class="form-label">Active Semester</label>
                            <select class="form-control" name="semester" id="semester" required>
                       <option value="1">1</option>
                       <option value="2">2</option>
                    </select>                        
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
                        <div class="col-sm-12 col-md-12">
                          <div class="mb-3">
                            <label class="form-label">Admission</label>
                            <select class="form-control" name="admission" id="admission" required>

                       <option value="1" selected>Active</option>
                       <option value="1">Active</option>
                       <option value="0">Inactive</option>
                   </select>                          </div>
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
                      <button class="btn btn-primary" type="submit">Save</button><br><br>
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