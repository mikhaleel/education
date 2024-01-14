<div class="container-scroller"> 
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item nav-profile border-bottom">
            <a href="#" class="nav-link flex-column">
              <div class="nav-profile-image">
                <img src="assets/images/faces/face1.jpg" alt="profile">
                <!--change to offline or busy as needed-->
              </div>
              <div class="nav-profile-text d-flex ms-0 mb-3 flex-column">
                <span class="font-weight-semibold mb-1 mt-2 text-center"><?php echo $student_name;?></span>
                <span class="text-secondary icon-sm text-center"><?php echo $student_matno;?></span>
              </div>
            </a>
          </li>
          <!-- <li class="nav-item pt-3">
            <a class="nav-link d-block" href="index"> <div class="small font-weight-light pt-1">Welcome Back! </div>
            </a>
           
          </li> -->
          <li class="pt-2 pb-1">
            <span class="nav-item-head text-danger">Dashboard</span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="index?matno=<?php echo encryptor('encrypt',$student_id);?>">
              <i class=" mdi mdi-account-card-details menu-icon"></i>
              <span class="menu-title">Profile</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="my_data?matno=<?php echo encryptor('encrypt',$student_id);?>">
              <i class=" mdi mdi-folder-account menu-icon"></i>
              <span class="menu-title">My Data</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="files?matno=<?php echo encryptor('encrypt',$student_id);?>">
              <i class="mdi mdi-folder-multiple-image  menu-icon"></i>
              <span class="menu-title">Upload Files</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="courses?matno=<?php echo encryptor('encrypt',$student_id);?>">
              <i class="mdi mdi-book-variant menu-icon"></i>
              <span class="menu-title">Courses Registration</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="result?matno=<?php echo encryptor('encrypt',$student_id);?>">
              <i class="mdi mdi-television-guide menu-icon"></i>
              <span class="menu-title">Result</span>
            </a>
          </li>
          <!-- <li class="nav-item">
            <a class="nav-link" href="accommodation?matno=<?php echo encryptor('encrypt',$student_id);?>">
              <i class="mdi mdi-hospital-building menu-icon"></i>
              <span class="menu-title">Accommodation</span>
            </a>
          </li> -->
          <li class="nav-item">
            <a class="nav-link" href="payment?matno=<?php echo encryptor('encrypt',$student_id);?>">
              <i class=" mdi mdi-currency-ngn menu-icon"></i>
              <span class="menu-title">Payment/Recipt</span>
            </a>
          </li>
        
         
          <li class="nav-item pb-3 border-bottom">
           
          </li>
          <li class="nav-item">
            <a class="nav-link" href="?logout">
              <i class="mdi mdi-power  menu-icon"></i>
              <span class="menu-title">Logout</span>
            </a>
          </li>
         
        </ul>
      </nav>
      <!-- partial -->