 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Courses Allocation </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-book-variant menu-icon"></i> Courses</p>
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
                  </div>
                  <?php 
                  $dept = $_SESSION["department"];
                  if($_SESSION["usertype"]==5){ $dcourse = $pdo->query("SELECT * FROM `staff` WHERE `programme`='%$dept%' AND `designation` = 'Lecturer'"); }
                  else{ $dcourse = $pdo->query("SELECT * FROM `staff`  WHERE `designation` = 'Lecturer'"); }
                  ?>
                    <h4 class="card-title">List of staff</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th >SN</th>
                              <th >Email</th>
                              <th >Name</th>
                              <th >Department</th>
                              <th >Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $csn = 0;
                            while($cours = $dcourse->fetch()){ $csn++;?>
                            <tr>
                              <td ><?php echo $csn;?></td>
                              <td ><?php echo $cours["email"];?></td>
                              <td ><?php echo $cours["names"];?></td>
                              <td ><?php echo $cours["department"];?></td>
                              <td class="text-right" >
                                <!-- <a class="btn btn-light" href="javascript:void(0);" NAME="allocate Course" title="AllocateCourse" onClick=window.open("allocat_page?stfid=<?php //echo encryptor("encrypt",$cours["id"]);?>","Ratting","width=1600,height=1000,left=150,top=0,toolbar=0,status=0,");>
                                  <i class="mdi mdi-pen text-primary"></i></a> -->
                                  <a class="btn btn-light" href="allocat_page?stfid=<?php echo encryptor("encrypt",$cours["id"]);?>" target="_blank">
                                  <i class="mdi mdi-pen text-primary"></i></a>
                             </td>
                            </tr><?php }?>
                          </tbody>
                        </table>
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         <?php include ("footer.php");?>