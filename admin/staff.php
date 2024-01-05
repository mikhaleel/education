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
                    <p class="m-0 pe-3"> <i class="mdi mdi-account-star menu-icon"></i> Staff List</p>
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
                  <div class="row">
                    <center><a href="add-staff" class="btn btn-primary pull-center"><b>Add Staff</b> <i class=" mdi mdi-plus "></i></a></center>
                     
                      </div>
                    <h4 class="card-title">List</h4>
                      <!-- <div class="row grid-margin">
                        <div class="col-12">
                          <div class="alert alert-warning" role="alert">
                            <strong>Heads up!</strong> This alert needs your attention, but it's not super important. </div>
                        </div>
                      </div> -->
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>Username</th>
                              <th>Fullname</th>
                              <th>Gender</th>
                              <th>Designation</th>
                              <th>College</th>
                              <th>School</th>
                              <th>Department</th>
                              <th>User Type</th>
                              <th>Access Level</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>ULTRACODE</td>
                              <td>ULTRACODE LTD</td>
                              <td>Male</td>
                              <td>Supper Admin</td>
                              <td>0</td>
                              <td>0</td>
                              <td>Computer</td>
                              <td>1</td>
                              <td>Active</td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="mdi mdi-eye text-primary"></i>View </button>
                                <button class="btn btn-light">
                                  <i class="mdi mdi-close text-danger"></i>Remove </button>
                              </td>
                            </tr>
                           
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         <?php include "footer.php"?>