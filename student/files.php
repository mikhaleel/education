 <?php include "header.php"?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> My Files </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-folder-multiple-image menu-icon"></i> My Files</p>
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
                    <?php 
                    if(isset($_GET["fids"]))
                    {
                      $id = encryptor('decrypt',$_GET["fids"]);
                      $dlfile=$pdo->query("DELETE FROM `stu_files` WHERE `id`='$id'");
                      if($dlfile)
                      {
                        $target_file=encryptor('decrypt',$_GET["tfl"]);
                        // if (is_dir($target_file)) 
                        // {
                          unlink($target_file);
                          echo '<div class="alert alert-info"><b>records deleted!!</div>';
                        // }
                        // else
                        // {
                        //   //echo '<div class="alert alert-info"><b>records deleted!!</div>';
                        // }
                      }
                    }

                    if(isset($_POST['fupload']))
                    {
                      $certs = $_POST["docmtype"];
                      $matno = $_POST["matno"];
                      $new_file_name = str_replace('/', '_', $student_matno).'_'.str_replace(' ','',$certs).'.png';
                      $target_dir = "uploads/";
                      $file_name = $_FILES['file_upload']['name'];
                      $file_size = $_FILES['file_upload']['size'];
                      $file_tmp = $_FILES['file_upload']['tmp_name'];
                      $file_type = $_FILES['file_upload']['type'];
                      $expld = explode('.',$_FILES['file_upload']['name']);
                      $file_ext = strtolower(end($expld));
                      
                      $extensions = array("jpeg","jpg","png");
                      
                      if(in_array($file_ext,$extensions) === false) {
                          echo '<div class="alert alert-info">Extension not allowed, please choose a JPEG or PNG file.</div>';
                      }
                      
                      if($file_size > 2097152) {
                          echo '<div class="alert alert-info">File size must be less than 2 MB.</div>';
                      }
                      
                      move_uploaded_file($file_tmp, $target_dir . $new_file_name);
                      echo "File uploaded successfully.";
                      $sfile_name = $target_dir . $new_file_name;

                      $instfile = $pdo->prepare("INSERT INTO `stu_files`(`matno`, `certificate`, `file`) VALUES (?,?,?)");
                      $instfile->execute([$student_matno, $certs,$sfile_name]);
                      if($instfile) { 
                        
				               echo '<div class="alert alert-success outline alert-dismissible fade show" role="alert"><i data-feather="thumbs-up"></i><b>Wait,</b> Uploading/Inserting file data....</div><script>setTimeout(function(){location.href="?matno='.encryptor('encrypt',$student_id).'"},1000)</script>';
                        
                        //echo '<div class="alert alert-info"><b>RECORD INSERTED!!</div>';
                      }
                    }
                    ?>
                    <center><button class="btn btn-primary pull-center" data-bs-toggle="modal" data-bs-target="#exampleModal-4"><b>Upload New File</b> <i class=" mdi mdi-plus "></i></button></center>
                     
                      </div>
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                        <table id="order-listing" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>Document Type</th>
                              <!-- <th>File</th> -->
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $dfile=$pdo->query("SELECT * FROM `stu_files` WHERE `matno`='$student_matno'"); 
                            $n = 0;
                            while($file_row = $dfile->fetch()){ $n++;?>
                            <tr>
                              <td><?php echo $n;?></td>
                              <td><?php echo $file_row["certificate"];?></td>
                              <!-- <td><a href="">View fil</a></td> -->
                              <td class="text-right">
                                <button class="btn btn-light" data-bs-toggle="modal" data-bs-target="#EditModal<?php echo $n;?>">
                                  <i class="mdi mdi-eye text-primary"></i> View </button>
                                <a class="btn btn-light" href="files?matno=<?php echo encryptor('encrypt',$student_id);?>&fids=<?php echo encryptor('encrypt',$file_row["id"]);?>&tfl=<?php echo encryptor('encrypt',$file_row["file"]);?>"><i class=" mdi mdi-check-all text-danger"></i> Delete </a>

                                <!--Edit Courses Start-->
                                <div class="modal fade" id="EditModal<?php echo $n;?>" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="ModalLabel">File</h5>
                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                        <img src="<?php echo $file_row["file"];?>" >
                                      </div>
                                      <div class="modal-footer">
                                        <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                <!--Edit Courses End-->

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
         <!--Add Courses Start-->
                    <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Add New File</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <form name="fileform" action="" method="POST" enctype="multipart/form-data">
                            <div class="row">
                              <div class="col-12">
                                <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Document Type:</label>
                                <select type="text" name="docmtype" class="form-control">
                                    <option>Choose</option>
                                    <option>Passport</option>
                                    <option>Primary Certificate</option>
                                    <option>SSCE Certificate</option>
                                    <option>JAMB Certificate</option>
                                    <option>Birth Certificate</option>
                                    <option>Indigine Certificate</option>
                                    <option>ND Certificate</option>
                                    <option>Other Certificate</option>
                                </select>
                              </div>
                              </div>
                              <div class="col-12">
                              <div class="form-group">
                                <label for="recipient-name" class="col-form-label">File:</label>
                                <input type="file" name="file_upload" class="form-control">
                              </div>
                              </div>
                              </div>
                               <input name="matno" type="hidden" value="<?php echo encryptor('encrypt',$student_id);?>">
                                <div class="modal-footer">
                                  <button type="submit" name="fupload" class="btn btn-success">Submit</button>
                                  <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                                </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                <!--Add Courses End-->
         <?php include "footer.php"?>