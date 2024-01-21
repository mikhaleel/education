 <?php include ("header.php"); 
 $my_rooms = $pdo->prepare("SELECT * FROM `stu_accomodation` WHERE `matno` LIKE ?");
 $my_roms = $pdo->prepare("SELECT * FROM `stu_accomodation` WHERE `matno` LIKE ? AND `semester` = ? AND `session`=?");
 $my_rooms->execute([$student_matno]);
 $my_roms->execute([$student_matno,$school_activesemester,$school_activesession]);
 ?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
          <div class="page-header flex-wrap">
              <div class="header-left">
              <h3 class="page-title"> Accommodation Page </h3>
              </div>
              <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
                <div class="d-flex align-items-center">
                  <a href="#">
                    <p class="m-0 pe-3"> <i class="mdi mdi-hospital-building menu-icon"></i> Accommodation</p>
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
                    <center>
                <?php if($my_roms->rowCount()==0){?>
                <button class="btn btn-primary pull-left" data-bs-toggle="modal" data-bs-target="#exampleModal-4"><b>Check for Availability</b> <i class=" mdi mdi-plus "></i></button><?php }?>
                   <button class="btn btn-warning pull-right" data-bs-toggle="modal" data-bs-target="#exampModal"><b>Hostel Rules & Regulation</b> <i class=" mdi mdi-plus "></i></button></center>              
                      </div>
                    <h4 class="card-title">List</h4>
                    <div class="row overflow-auto">
                      <div class="col-12">
                      <div class="table-responsive">
                        <table id="order-listing1" class="table" cellspacing="0" width="100%">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>Hostels</th>
                              <th>Block</th>
                              <th>Room</th>
                              <th>Session</th>
                              <th>Semester</th>
                              <th>Status</th>
                              <th>Amount</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $snr=0;
                            while($host_rows = $my_rooms->fetch()){ $snr++;?>
                            <tr>
                              <td><?php echo $snr;?></td>
                              <td><?php echo $host_rows["hostel"];?></td>
                              <td><?php echo $host_rows["block"];?></td>
                              <td><?php echo $host_rows["room"];?></td>
                              <td><?php echo $host_rows["session"];?></td>
                              <td><?php echo $host_rows["semester"];?></td>
                              <td><?php echo $host_rows["status"];?></td>
                              <td><?php echo $host_rows["amount"];?></td>
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
          </div>
                
         <!--Add Courses Start-->
                    <div class="modal fade" id="exampleModal-4" tabindex="-1" role="dialog" aria-labelledby="ModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="ModalLabel">Availbale Hostels</h5>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <?php 
                            $hostel = $pdo->prepare("SELECT * FROM `hostels` WHERE category = '$gender' AND `status` = 'vacant'");
                            $hostel->execute([]);
                            ?>
                          <div class="table-responsive">
                          <table id="order-listing" class="table">
                          <thead>
                            <tr class="bg-primary text-white">
                              <th>SN</th>
                              <th>Hostels</th>
                              <th>Block</th>
                              <th>Room</th>
                              <th>Amount</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php $snn = 0; while($hostels = $hostel->fetch()){ $snn++;?>
                            <tr>
                              <td><?php echo $snn;?></td>
                              <td><?php echo $hostels["hostel"];?></td>
                              <td><?php echo $hostels["block"];?></td>
                              <td><?php echo $hostels["room"];?></td>
                              <td><?php echo $hostels["amount"];?></td>
                              <td class="text-right">
                                <a class="btn btn-light" href="stu_accom_invoice?matno=<?php echo encryptor("encrypt",$student_matno);?>&hid=<?php echo encryptor("encrypt",$hostels["id"]);?>" target="_blank">
                                  <i class="mdi mdi-eye text-primary" data-bs-toggle="modal" data-bs-target="#EditModal"></i> Book this room </a>
                                <!-- <button class="btn btn-light"> -->
                                  <!-- <i class=" mdi mdi-check-all text-danger"></i> Deleted </button> -->
                              </td>
                            </tr>
                            <?php }?>
                          </tbody>
                        </table>
                       </div>
                        </div>
                          <div class="modal-footer">
                            <!-- <button type="submit" class="btn btn-success">Submit</button> -->
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                <!--Add Courses End-->
                <?php include "footer.php"?>
                <div class="modal fade" id="exampModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">A. REGULATIONS</h3>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                          <ol>
                            <li>Students are advised to carefully READ AND STUDY the following specific regulations governing their stay in the hostels land ABIDE by them. The Student Handbook also carries the general residency regulations which should be strictly observed.</li>
                            <li>Bed-space is allocated to cover ONLY the period of Senate approved Calendar. No student under any guise will be allowed to stay a day longer in the Hall<br>At the expiration of tenancy (End of Session) tenants must park out all their belongings. The Division shall not be responsible for the safety of items left behind.<br>Sale or giving-out of bed-space and illegal swapping are strictly prohibited. The penalty for any defaulter is rustication for one semester. </li>
                            <li>All visitors are not allowed to stay in the halls beyond 9.00p.m. Similarly, female students are not allowed to stay in the male hostels beyond 9.00p.m. </li>
                            <li>Female shall not for whatsoever reason, reside in the male hostels. The penalty for this will be loss of the entire room to the entire occupants, and disciplinary action will be taken against the female student. </li>
                            <li>Undergraduate students are not allowed to reside or squat in the post-graduate hostels. </li>
                            <li>Males students shall not, for whatever reason, enter female students' hostels. </li>
                            <li>Cooking in the rooms is strictly prohibited. </li>
                            <li>Use of any kind of electrical appliances for cooking or boiling water is strictly prohibited. </li>
                            <li>Disposal of leftover food in sinks, laundries, bathrooms or toilets is strictly prohibited. </li>
                            <li>Waste or any form of rubbish must not be discarded through the windows, over the balustrade or littered in front of the rooms. Hall waste and/or rubbish should be neatly deposited in the dust bins provided. </li>
                            <li>Toilets must be used properly. As such only toilet papers and water should be used. Water will normally be available in the toilets. However, in the event of lack of water, users of toilets must fetch water provided in the tanks before using the toilets. </li>
                            <li>Washing in whatever form should be done in the laundry or at the tank points. In addition, the walls and the floor of the halls should not be smeared. The employment of other persons for laundry and washing in the halls is prohibited. The penalty for defaulters is loss of bed-space.</li>
                            <li>Bathing outside the bathroom is strictly prohibited. The penalty is forfeiture of bed-space and disciplinary action will be instituted against the offender. </li>
                            <li>All unauthorized commercial activities such as hawking, barbing, hairdressing, baking and business center activities such as photocopying, GSM call centers, word processing, video and audio taping e.t.c. are strictly prohibited. The penalty is loss of bed-space for the entire occupants and confiscation of such items.</li>
                            <li>All personal properties should be registered first with the Security at the gate and with the Hall Administrators. </li>
                            <li>Religious activities within the halls such as meetings and preaching which are capable of breaching the peace are prohibited. </li>
                            <li>All grievances, complainants and reports must be channeled through the hall administrators/security office, in the hall. The Student Affairs Division and the Polytechnic administration will not entertain complaints, reports and grievances made outside authorized channels. </li>
                            <li>Possession of dangerous and illicit drugs and sale of either is strictly prohibited. The penalty of which is expulsion from the Polytechnic. </li>
                            <li>In the event of damage to ANY Polytechnic property in the Halls, students will be surcharged for replacement. </li>
                            <li>Students' residency does not include spouses. Students wishing to live with their spouses should secure accommodation off-campus. </li>
                            <li>Students should not post any bills on buildings and other facilities on campus. Originators of such will be held responsible for damaging or smearing Polytechnic buildings and other facilities. All bills should be posted on Notice Boards only. </li>
                            <li>Defecating and urinating other than in the urinary/toilets is strictly prohibited. The penalty of which is loss bed-space. </li>
                            <li>Unauthorized tempering with Polytechnic facilities including the television and cable satellite provided in the common rooms is strictly prohibited. The penalty of which is loss of bed-space and surcharge for damages. </li>
                            <li>Electronic transmission/broadcast in any form and erection of antenna for television, radio, cable satellite e.t.c. is strictly prohibited. The penalty of which is loss of bed-spaces for the entire occupants and confiscation of items erected. </li>
                            <li>Violation of residency Regulations shall attract appropriate punishment which may range from surcharge to permanent prohibition from stay in any of the Polytechnic Halls. </li>
                          </ol>
                          <h4>UNDERTAKING </h4>
                          <p>I, <b><?php echo $student_name;?></b> with Matric. No <b><?php echo $student_matno;?></b> accept residence in the institute's Hall. Consequent upon this acceptance, I solemnly swear to abide by the regulations governing my residence and I accept liability in the event of a breach of any of the regulations.</p>
                          </div>
                          <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-success">Submit</button> -->
                            <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                          </div>
                        </div>
                      </div>
                    </div>