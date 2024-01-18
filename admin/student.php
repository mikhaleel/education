 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Students </h3>
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
                        <form action="" method="post" >
                          <div class="form-group d-flex">
                                <div class="col-6">
                            <input type="text" class="form-control" placeholder="Matno | Name | Email | Phone number" name="searchval" >
                                </div>
                                <div class="col-5">
                                  <select type="text" class="form-control" placeholder="Search Here" name="status">
                                      <option>Select</option>
                                      <option value="1" >Active</option>
                                      <option value="0" >Inactive</option>
                                  </select>
                                </div>
                            <button type="submit" name="submit" class="btn btn-primary border ms-3">Search</button>
                          </div>
                        </form>
                      </div>
                      </div>
                      <?php 
                      $stat_arr = array(1=>"Active", 0=>"InActive");
                      if(isset($_POST["submit"]))
                      {
                        if($_SESSION["usertype"] == 5)
                        {
                          $department = "%".$_SESSION["department"]."%";
                        //  $department = "%".'BUSINESS'."%";
                          $searchval = "%".$_POST["searchval"]."%"; 
                          $studentsn = $pdo->prepare("SELECT * FROM `students` WHERE (`programme` LIKE ? OR `matno` LIKE ? OR `names` LIKE ? OR `email` LIKE ? OR `contact` LIKE ?) AND `stat` = ? AND `programme` LIKE ?");
                          $studentsn->execute([$searchval,$searchval,$searchval,$searchval,$searchval, $_POST["status"], $department]);
                        }
                        else
                        {
                          $searchval = "%".$_POST["searchval"]."%";
                          $studentsn = $pdo->prepare("SELECT * FROM `students` WHERE (`programme` LIKE ? OR `matno` LIKE ? OR `names` LIKE ? OR `email` LIKE ? OR `contact` LIKE ?) AND `stat` = ? ");
                          $studentsn->execute([$searchval,$searchval,$searchval,$searchval,$searchval, $_POST["status"]]);
                        }
                      }
                      else
                      {
                        if($_SESSION["usertype"] == 5)
                        {
                          $department = "%".$_SESSION["department"]."%";
                         // $department = "%".'BUSINESS'."%";
                          $studentsn = $pdo->prepare("SELECT * FROM `students` WHERE `programme` LIKE ?");
                          $studentsn->execute([$department]);
                        }
                        else
                        {
                          $studentsn = $pdo->prepare("SELECT * FROM `students`");
                          $studentsn->execute();
                        }
                      }
                      ?>
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>MAT No</th>
                              <th>NAMES</th>
                              <th>GENDER</th>
                              <th>STATE</th>
                              <th>LEVEL</th>
                              <th>STATUS</th>
                              <th>ACTION</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $ns = 0; while($strow = $studentsn->fetch()){ $ns++;?>
                            <tr>
                              <td><?php echo $ns;?></td>
                              <td><?php echo $strow["matno"];?></td>
                              <td><?php echo $strow["names"];?></td>
                              <td><?php echo $strow["sex"];?></td>
                              <td><?php echo $strow["states"];?></td>
                              <td><?php echo $strow["level"];?></td>
                              <td><?php echo $stat_arr[$strow["stat"]];?></td>
                              <td class="text-right">
                                <a class="btn btn-light" href="../student/index?matno=<?php echo encryptor('encrypt',$strow["id"]);?>" target="_blank">
                                  <i class="mdi mdi-eye text-primary"></i> View </a>
                                <!-- <button class="btn btn-light"><i class=" mdi mdi-close text-danger"></i> Remove </button> -->
                              </td>
                            </tr>
                            <?php }?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
         <?php include("footer.php");?>