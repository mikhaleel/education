 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Hostels Page </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-hospital-building menu-icon"></i> Hostels</p>
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
                    <center><button class="btn btn-primary pull-center" data-bs-toggle="modal" data-bs-target="#exampleModal-4"><b>Add Hostels</b> <i class=" mdi mdi-plus "></i></button></center>
                     
                      </div>
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>College</th>
                              <th>Hostels</th>
                              <th>Category</th>
                              <th>Block</th>
                              <th>Total Room</th>
                              <th>Bed Spaces</th>
                              <th>Occupied</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>Science & Tech</td>
                              <td>ABUJA</td>
                              <td>F</td>
                              <td>GA</td>
                              <td>53</td>
                              <td>4</td>
                              <td>0</td>
                              <td>5,000</td>
                              <td>Reserve</td>
                              <td class="text-right">
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#EditModal">
                                  <i class="mdi mdi-eye text-primary" data-bs-toggle="modal" data-bs-target="#EditModal"></i> Edit </button>
                                <button class="btn btn-light">
                                  <i class=" mdi mdi-check-all text-danger"></i> Deleted </button>
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
          <!--Edit Courses Start-->
                    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Hostels</h5>
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
                                <label for="recipient-name" class="col-form-label">Hostel:</label>
                                <input type="text" name="hostel" class="form-control">
                              </div>
                              </div>
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Category:</label>
                                <select type="text" name="category" class="form-control">
                                    <option>Choose</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Block:</label>
                                <input type="text" name="block" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Room:</label>
                                <input type="number" name="room" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Bedspaces:</label>
                                <input type="number" name="bedspaces" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="occupied" class="col-form-label">Occupied:</label>
                                <input type="number" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="amount" class="col-form-label">Amount:</label>
                                <input type="number" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="occupied" class="col-form-label">Status:</label>
                                <select type="text" name="status" class="form-control">
                                    <option>Vacant</option>
                                    <option>Reserve</option>
                                    <option>Maintenance</option>
                                </select>
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
                            <h5 class="modal-title" id="ModalLabel">Add New Hostels</h5>
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
                                <label for="recipient-name" class="col-form-label">Hostel:</label>
                                <input type="text" name="hostel" class="form-control">
                              </div>
                              </div>
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Category:</label>
                                <select type="text" name="category" class="form-control">
                                    <option>Choose</option>
                                    <option>Male</option>
                                    <option>Female</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Block:</label>
                                <input type="text" name="block" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Room:</label>
                                <input type="number" name="room" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Bedspaces:</label>
                                <input type="number" name="bedspaces" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="occupied" class="col-form-label">Occupied:</label>
                                <input type="number" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="amount" class="col-form-label">Amount:</label>
                                <input type="number" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="occupied" class="col-form-label">Status:</label>
                                <select type="text" name="status" class="form-control">
                                    <option>Vacant</option>
                                    <option>Reserve</option>
                                    <option>Maintenance</option>
                                </select>
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