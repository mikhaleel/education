<?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Staff Courses </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-book-variant menu-icon"></i> Staff Courses</p>
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

                  <?php
                    if($_SESSION["usertype"]==7)
                    { 
                      $chkrec = $pdo->query("SELECT * FROM `staff_course` WHERE `staff_id` ='$staff_id' AND `semester` = '$school_activesemester' AND `session` ='$school_activesession'");    
                    }    
                    else
                    {
                      $chkrec = $pdo->query("SELECT * FROM `staff_course` WHERE `semester` = '$school_activesemester' AND `session` ='$school_activesession'");  
                    }           
                    ?>
                    <h4 class="card-title">My Courses</h4>
                    <div class="row overflow-auto">
                     
                      <div class="col-12">
                        <table  id="order-listing" class="table" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Level / Programme</th>
                                <th>Code / Title</th>
                                <th>Unit</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $aln=0;
                            while($allcrs = $chkrec->fetch()){ $aln++;
                            $prgs = $pdo->query("SELECT abv FROM programmes WHERE programme = '".$allcrs["programme"]."'");
                            $pgr_abv = $prgs->fetch(); $prog = $pgr_abv["abv"];
                            ?>
                            <tr>
                                <td><?php echo $aln;?></td>
                                <td><?php echo $allcrs["level"];?> - <?php echo $prog;?></td>
                                <td><?php echo $allcrs["coursecode"];?> - <?php echo $allcrs["coursetitle"];?></td>
                                <td><?php echo $allcrs["unit"];?></td>
                                <td>
                                <a href="registered_stnd_list?stfid=<?php echo encryptor('encrypt',$allcrs["staff_id"]);?>&cid=<?php echo encryptor('encrypt',$allcrs["course_id"]);?>" class="btn btn-light" target="_blank" ><i class="mdi mdi-account-multiple text-primary"></i> </a>
                                <a href="entered_scores.php?stfid=<?php echo encryptor('encrypt',$allcrs["staff_id"]);?>&cid=<?php echo encryptor('encrypt',$allcrs["course_id"]);?>" class="btn btn-light" target="_blank"><i class="mdi mdi-view-list text-success"></i> </a>
                                  <a href="add_scores?stfid=<?php echo encryptor('encrypt',$allcrs["staff_id"]);?>&cid=<?php echo encryptor('encrypt',$allcrs["course_id"]);?>" class="btn btn-light" target="_blank" ><i class="mdi mdi-folder-plus text-info"></i> </a>
                                </td>
                            </tr>
                            <?php
                            }?>
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