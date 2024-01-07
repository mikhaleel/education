 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title">Programmes Page</h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-book-multiple menu-icon"></i> Programmes</p>
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
                    <center><button class="btn btn-primary pull-center" data-bs-toggle="modal" data-bs-target="#exampleModal-4"><b>Add Programmes</b> <i class=" mdi mdi-plus "></i></button></center>
                     
                      </div>
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <?php
                        if(isset($_GET["pdel"]))
                        {
                          $id = encryptor('decrypt',$_GET["id"]);
                          $pdel = $pdo->prepare("DELETE FROM `programmes` WHERE `prog_id` = ?");
                          $pdel->execute([$id]);
                          if($pdel)
                          {
		                        echo '<div class="alert alert-danger">record deleted!!</div><script>setTimeout(function(){location.href="programmes"},1000)</script>';
                          }

                        }
                        if(isset($_POST["addprog"])){
                          $instpro = $pdo->prepare("INSERT INTO `programmes`(`college_id`, `school_id`, `dept_id`, `programme`, `abv`) VALUES (?,?,?,?,?)");
                          $instpro->execute([$_POST["college"],$_POST["school"],$_POST["department"],$_POST["programme"],$_POST["abv"]]);
                          if($instpro)
                          {
		                        echo '<div class="alert alert-info">record addedd!!</div><script>setTimeout(function(){location.href="programmes"},1000)</script>';

                          }
                        }
                        $dprograme = $pdo->query("SELECT * FROM `programmes`"); ?>
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <!-- <th>College</th>
                              <th>Schools</th> -->
                              <th>Programmes</th>
                              <th>Department</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                          <?php $sn=0; while($fetchpro = $dprograme->fetch()){ $sn++;
                            $col = $pdo->query("SELECT * FROM `colleges` WHERE `id`='".$fetchpro["college_id"]."'");
                            $schl = $pdo->query("SELECT * FROM `schools` WHERE `id`='".$fetchpro["school_id"]."'");
                            $dept = $pdo->query("SELECT * FROM `departments` WHERE `dept_id`='".$fetchpro["dept_id"]."'");
                            $college = $col->fetch();
                            $school = $schl->fetch();
                            $depts = $dept->fetch();
                            ?>
                            <tr>
                              <td><?php echo $sn;?></td>
                              <!-- <td><?php //echo $fetchpro["college_id"];?></td> -->
                              <!-- <td><?php //echo $fetchpro["school_id"];?></td> -->
                              <td><?php echo $fetchpro["programme"];?></td>
                              <td><?php echo $fetchpro["abv"];?></td>
                              <td class="text-right">
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $sn;?>">
                                  <i class="mdi mdi-eye text-primary"></i> Details </button>

                                   <!--Edit Courses Start-->
                                    <div class="modal fade" id="EditModal<?php echo $sn;?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="ModalLabel">Programmes Details</h5>
                                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">&times;</span>
                                            </button>
                                          </div>
                                          <div class="modal-body">
                                          <span style="color:blue; font-size: 11px; "><?php echo $fetchpro["programme"];?></span>
                                          <hr>
                                         <p>College: <?php echo $college["college"];?></p>
                                         <p>School: <?php echo $school["school"];?></p>
                                         <p>Abrev: <?php echo $fetchpro["abv"];?></p>
                                         <p>Prog_id: <?php echo $fetchpro["prog_id"];?></p>
                                         <p>Department: <?php echo $depts["names"];?></p>
                                          </div>
                                          <div class="modal-footer">
                                            <a href="?pdel=&id=<?php echo encryptor('encrypt',$fetchpro['prog_id']);?>" class="btn btn-success">Delete</a>
                                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                   <!--Edit Courses End--> 
                                <!-- <button class="btn btn-light">
                                  <i class=" mdi mdi-check-all text-danger"></i> Deleted </button> -->
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
          <!--Edit Courses Start-->
                    <div class="modal fade" id="EditModal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Edit Programmes</h5>
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
                                <label for="recipient-name" class="col-form-label">School:</label>
                                <select type="text" name="school" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Department:</label>
                                <select type="text" name="department" class="form-control">
                                    <option>Choose</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Programme:</label>
                                <select type="text" name="programme" class="form-control">
                                    <option>Choose</option>
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
         <?php 
         
         $colf = $pdo->query("SELECT * FROM `colleges`");
         $schlf = $pdo->query("SELECT * FROM `schools`");
         $deptf = $pdo->query("SELECT * FROM `departments`");
         ?>
                    <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Add New Programme</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form name="prgform" method="post" >
                                <div class="row">
                                <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">College:</label>
                                <select type="text" name="college" class="form-control">
                                    <option>Choose</option>
                                    <?php while($fcol = $colf->fetch()){?>
                                      <option value="<?php echo $fcol["id"];?>" ><?php echo $fcol["college"];?></option>
                                      <?php }?>
                                </select>
                              </div>
                              </div>
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">School:</label>
                                <select type="text" name="school" class="form-control">
                                    <option>Choose</option>
                                    <?php while($fschl = $schlf->fetch()){?>
                                      <option value="<?php echo $fschl["id"];?>" ><?php echo $fschl["school"];?></option>
                                      <?php }?>
                                </select>
                              </div>
                              </div>
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Department:</label>
                                <select type="text" name="department" class="form-control">
                                    <option>Choose</option>
                                    <?php while($fdept = $deptf->fetch()){?>
                                      <option value="<?php echo $fdept["dept_id"];?>" ><?php echo $fdept["names"];?></option>
                                      <?php }?>
                                </select>
                              </div>
                              </div>
                              <div class="col-8">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Programme:</label>
                                <input type="text" name="programme" class="form-control">
                              </div>
                              </div>
                              <div class="col-4">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label"> Abreviation:</label>
                                <input type="text" name="abv" class="form-control">
                              </div>
                              </div>
                              </div>
                             
                              <div class="modal-footer">
                                <button name="addprog" type="submit" class="btn btn-success">Save</button>
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                <!--Add Courses End-->
         <?php include "footer.php"?>