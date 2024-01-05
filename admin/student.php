 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Students Page </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-account-multiple menu-icon"></i> Students List</p>
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
                      <div class="col-12">
                        <form action="#">
                          <div class="form-group d-flex">
                                <div class="col-6">
                            <input type="text" class="form-control" placeholder="Matno | Name | Email | Phone number">
                                </div>
                                <div class="col-5">
                            <select type="text" class="form-control" placeholder="Search Here">
                                <option>Select</option>
                                <option>Active</option>
                                <option>Inactive</option>
                            </select>
                                </div>
                            <button type="submit" class="btn btn-primary border ms-3">Search</button>
                          </div>
                        </form>
                      </div>
                      </div>
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>MAT No</th>
                              <th>APP No</th>
                              <th>UTME</th>
                              <th>NAMES</th>
                              <th>GENDER</th>
                              <th>STATE</th>
                              <th>LEVEL</th>
                              <th>COLLEGE</th>
                              <th>PROGRAMME</th>
                              <th>DEPARTMENT</th>
                              <th>STATUS</th>
                              <th>ACTION</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>NDCS/022/0185</td>
                              <td>NSPZ/EV/APP/ND/2023/0185</td>
                              <td>12330220185</td>
                              <td>MOSES MARY</td>
                              <td>Female</td>
                              <td>Niger</td>
                              <td>ND</td>
                              <td>Science</td>
                              <td>Statistics</td>
                              <td>Computer</td>
                              <td>Active</td>
                              <td class="text-right">
                                <button class="btn btn-light">
                                  <i class="mdi mdi-eye text-primary"></i> View </button>
                                <button class="btn btn-light">
                                  <i class=" mdi mdi-close text-danger"></i> Remove </button>
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