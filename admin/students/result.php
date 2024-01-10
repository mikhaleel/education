 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title">Exam Result </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-television-guide menu-icon"></i> My Results</p>
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
                  <a href="javascript:void(0);" NAME="Error Handling"  title="ZeroDivisionError handling" class="btn btn-outline-primary btn-icon-text">
			<i class="mdi mdi-book-open-page-variant mdi-30px"></i>
			<span class="d-inline-block text-left">
			<small class="font-weight-light d-block">DIP1</small>
			First Semester			</span>
		</a>
				<a href="javascript:void(0);" NAME="Error Handling"  title="ZeroDivisionError handling"  class="btn btn-outline-primary btn-icon-text">
			<i class="mdi mdi-book-open-page-variant mdi-30px"></i>
			<span class="d-inline-block text-left">
			<small class="font-weight-light d-block">DIP2</small>
			Second Semester			</span>
		</a>
		    <div class="table-responsive">
<table id="order-listing" class="table" cellspacing="0" width="100%">
<tr class="bg-primary text-white">
<th>#</th>
<th>Title/Code</th>
<th>Unit</th>
<th>Mark</th>
<th>Grade</th><!--
<th>Points</th>
<th>WPts</th>-->
<th>Semester</th>
<th>Session</th>
</tr>
</thead>
<tbody>
<tr>
<td>1</td>
<td>ELEMENT OF SOCIOLOGY(DCMA101)</td>
<td>3</td>
<td>45</td>
<td>D</td>
<td>First</td>
<td>2020/2021</td>
</tr>

</tbody>
</table>
</div>
     <div class="table-responsive">
<table id="order-listing" class="table table-bordered table-striped ">
    <tr class="bg-success text-white">
<th>Total Unit</th>
<th>GP</th>
<th>GPA</th>

</tr>
</thead>
<tbody>
<td>50</td>
			 <td>124.75</td>
			 <td>2.50</td>

</tbody>
</table>
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
                            <h5 class="modal-title" id="ModalLabel">Edit Payment</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form>
                                <div class="row">
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Matric No:</label>
                                <input type="text" name="matricno" class="form-control">
                              </div>
                              </div>
                                <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Programme:</label>
                                <select type="text" name="programmes" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Session:</label>
                                <select type="text" name="session" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Level:</label>
                                <select type="text" name="level" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Category:</label>
                                <select type="text" name="category" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="occupied" class="col-form-label">Semester:</label>
                                <select type="text" name="status" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" name="amount" class="col-form-label">Amount:</label>
                                <input type="number" class="form-control">
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
                            <h5 class="modal-title" id="ModalLabel">Add New Payment</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form>
                                <div class="row">
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Matric No:</label>
                                <input type="text" name="matricno" class="form-control">
                              </div>
                              </div>
                                <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Programme:</label>
                                <select type="text" name="programmes" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Session:</label>
                                <select type="text" name="session" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Level:</label>
                                <select type="text" name="level" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Category:</label>
                                <select type="text" name="category" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" name="occupied" class="col-form-label">Semester:</label>
                                <select type="text" name="status" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" name="amount" class="col-form-label">Amount:</label>
                                <input type="number" class="form-control">
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