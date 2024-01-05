<?php 
    require 'db.php';
    if (!empty($_POST)) {
        $username = $post['email'];
    
        $ok = 1;

        if (empty($username)) {
            $ok = 0;
            echo $error.'Please enter your Email!'.$close;
        }

      

        if ($ok) {
            
                $login = $db->prepare("SELECT * FROM `students` WHERE `email`=?");
                $login->execute([$username]);
                $row_login = $login->fetch();
                if ($login->rowCount()) {
                  //  $_SESSION[SESSION_LIB] = NULL;
                      $_SESSION['NAMES'] = $row_login['firstname'].' '.$row_login['lastname'];
                    $_SESSION['USERS'] = $row_login['id'];
					$_SESSION['SCHOOL'] = $row_login['schools'];
					$_SESSION['PASSPORT'] = $row_login['pix'];
                    $_SESSION['LEVEL'] = 0;
					//if($row_login['gender']  =='male')
					$_SESSION['PASSPORT'] = 0;
                    echo $success."login Successful".$close;
                   
                }else {
                    echo $error.'Invalid username & password!'.$close;
                }
            }
    }
    
?>