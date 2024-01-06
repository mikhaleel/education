 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Courses Page </h3>
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
                    <center><button class="btn btn-primary pull-center" data-bs-toggle="modal" data-bs-target="#exampleModal-4"><b>Add Courses</b> <i class=" mdi mdi-plus "></i></button></center>
                  </div>
                  <?php 
                  $dept = $_SESSION["department"];
                  if($_SESSION["usertype"]==5){ $dcourse = $pdo->query("SELECT * FROM `course` WHERE `programme`='%$dept%'"); }
                  else{ $dcourse = $pdo->query("SELECT * FROM `course`"); }
                  ?>
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <?php 
                      if(isset($_POST["editcourse"])){
                        $editcouse = $pdo->prepare("UPDATE `course` SET `title`=?, `code`=?, `unit`=?, `level`=?,`semester`=? WHERE `id`=?");
                        $editcouse->execute([$_POST["title"],$_POST["code"],$_POST["unit"],$_POST["level"],$_POST["semester"],$_POST["cid"]]);
                        if($editcouse)
                        {
                        echo '<div class="alert alert-info">Course Updated!!</div><script>setTimeout(function(){location.href="courses"},1000)</script>';
                        }
                      }
                      if(isset($_POST["crsdel"]))
                      {
                        $delcouse = $pdo->prepare("DELETE FROM `course` WHERE `id`=?");
                        $delcouse->execute([$_POST["id"]]);
                        if($delcouse)
                        {
                        echo '<div class="alert alert-info">Course Deleted!!</div><script>setTimeout(function(){location.href="courses"},1000)</script>';
                        }
                      }
                      if(isset($_POST["addcourse"]))
                      {
                        $insert_course = $pdo->prepare("INSERT INTO `course`(`programme`, `title`, `code`, `unit`, `level`, `semester`) VALUES (?,?,?,?,?,?)");
                        $insert_course->execute([$_POST["programme"],$_POST["title"],$_POST["code"],$_POST["unit"],$_POST["level"],$_POST["semester"]]);
                        if($insert_course)
                        {
                        echo '<div class="alert alert-info">Course Inserted!!</div><script>setTimeout(function(){location.href="courses"},1000)</script>';
                        }
                      }
                      ?>
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th style="font-size: 7pt;">SN</th>
                              <th style="font-size: 7pt;">Programmes</th>
                              <th style="font-size: 7pt;">Title</th>
                              <th style="font-size: 7pt;">Code</th>
                              <th style="font-size: 7pt;">Unit</th>
                              <th style="font-size: 7pt;">Level</th>
                              <th style="font-size: 7pt;">Semester</th>
                              <th style="font-size: 7pt;">Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php 
                            $csn = 0;
                            while($cours = $dcourse->fetch()){ $csn++;?>
                            <tr>
                              <td style="font-size: 7pt;"><?php echo $csn;?></td>
                              <td style="font-size: 7pt;"><?php echo $cours["programme"];?></td>
                              <td style="font-size: 8pt;"><?php echo $cours["title"];?></td>
                              <td style="font-size: 8pt;"><?php echo $cours["code"];?></td>
                              <td style="font-size: 8pt;"><?php echo $cours["unit"];?></td>
                              <td style="font-size: 7pt;"><?php echo $cours["level"];?></td>
                              <td style="font-size: 8pt;"><?php echo $cours["semester"];?></td>
                              <td class="text-right" style="font-size: 7pt;">
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $csn;?>">
                                  <i class="mdi mdi-pen text-primary"></i>Edit</button>
                                  <!--Edit Courses Start-->
                                  <div class="modal fade" id="EditModal<?php echo $csn;?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="ModalLabel">Edit Courses</h5>
                                          <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>  
                                        <div class="modal-body">
                                          <form name="edfoem" method="post">
                                              <div class="row">
                                            <div class="col-12">
                                            <div class="form-group">
                                              <label for="recipient-name" class="col-form-label">Programme:</label>
                                              <input type="text" name="programme" class="form-control" value="<?php echo $cours["programme"];?>" readonly>
                                              <input type="hidden" name="cid" class="form-control" value="<?php echo $cours["id"];?>">
                                            </div>
                                            </div>
                                            <div class="col-12">
                                            <div class="form-group">
                                              <label for="recipient-name" class="col-form-label">Course Tile:</label>
                                              <input type="text" name="title" class="form-control" value="<?php echo $cours["title"];?>">
                                            </div>
                                            </div>
                                            <div class="col-3">
                                            <div class="form-group">
                                              <label for="recipient-name" name="code" class="col-form-label">Code:</label>
                                              <input type="text" class="form-control" name="code" value="<?php echo $cours["code"];?>">
                                            </div>
                                            </div>
                                            <div class="col-3">
                                            <div class="form-group">
                                              <label for="recipient-name" name="code" class="col-form-label">Unit:</label>
                                              <input type="text" class="form-control" name="unit" value="<?php echo $cours["unit"];?>">
                                            </div>
                                            </div>
                                            <div class="col-3">
                                            <div class="form-group">
                                              <label for="recipient-name" class="col-form-label">Level:</label>
                                              <input type="text" name="level" class="form-control" value="<?php echo $cours["level"];?>">
                                            </div>
                                            </div>
                                            <div class="col-3">
                                            <div class="form-group">
                                              <label for="recipient-name" class="col-form-label">Semester:</label>
                                              <input type="text" name="semester" class="form-control" value="<?php echo $cours["semester"];?>">
                                            </div>
                                            </div>
                                              </div>
                                          
                                            <div class="modal-footer">
                                              <button type="submit" class="btn btn-success" name="editcourse">Save</button>
                                              <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                            </div>
                                          </form>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <!--Edit Courses End-->
                                  <form name="formdel" method="post">
                                    <input name="cid" value="<?php echo $cours["id"];?>" type="hidden" >
                                <button class="btn btn-light" name="crsdel" > <i class=" mdi mdi-delete text-danger"></i>Delete</button>
                                  </form>
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
                
         <!--Add Courses Start-->
                    <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Add New Courses</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form name="instfrm" method="post">
                              <div class="row">
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Programme:</label>
                                <?php 
                                $dept_id = $_SESSION["dept_id"];
                                if($_SESSION["usertype"]==5){ $dprog = $pdo->query("SELECT * FROM `programmes` WHERE `dept_id`='$dept_id"); }
                                else{ $dprog = $pdo->query("SELECT * FROM `programmes`"); }
                                ?>
                                <select type="text" name="programme" class="form-control">
                                    <option>Choose a programme</option>
                                    <?php while($prow=$dprog->fetch()){?>
                                    <option><?php echo $prow["programme"];?></option>
                                    <?php }?>
                                </select>
                              </div>
                              </div>
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Title:</label>
                                <input type="text" name="title" class="form-control">
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Code:</label>
                                <input type="text" class="form-control" name="code" >
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Unit:</label>
                                <input type="text" class="form-control" name="unit" >
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Level:</label>
                                <select type="text" name="level" class="form-control">
                                    <option>Choose</option>
                                    <option>HND1</option>
                                    <option>HND2</option>
                                    <option>ND1</option>
                                    <option>ND2</option>
                                    <option>DIP1</option>
                                    <option>DIP2</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-6">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Semester:</label>
                                <select type="text" name="semester" class="form-control">
                                    <option>Choose</option>
                                    <option>1</option>
                                    <option>2</option>
                                </select>
                              </div>
                              </div>
                              </div>
                             
                              <div class="modal-footer">
                                <button type="submit" class="btn btn-success" name="addcourse" >Submit</button>
                                <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                <!--Add Courses End-->
         <?php include "footer.php"?>