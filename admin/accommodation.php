 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Accommodation List </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-home-variant menu-icon"></i> Accommodation List</p>
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
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>Matric No</th>
                              <th>Hostel</th>
                              <th>Block</th>
                              <th>Room</th>
                              <th>Bed Spaces</th>
                              <th>Session</th>
                              <th>Semester</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr>
                              <td>1</td>
                              <td>HNDCET/021/076</td>
                              <td>LAGOS</td>
                              <td>GL</td>
                              <td>74</td>
                              <td>4</td>
                              <td>2022/2023</td>
                              <td>1</td>
                              <td>5000.00</td>
                              <td>
                                <label class="badge badge-success">Paid</label>
                              </td>
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