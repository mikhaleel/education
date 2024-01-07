                <table id="ttbl" style="width: 100%;">
                    <tr>
                        <td class="col-md-4" id="ttbl" >                            
                            <strong>Level</strong>:&nbsp;<?php echo $level;?> <br/>
                            <strong>Session</strong>:&nbsp; <?php echo $session;?>
                            <br/>
                            <strong>Semester</strong>:&nbsp;<?php echo $semester_arr[$semester];?> 
                        </td>
                        <td class="col-md-4" style="text-align: center;" id="ttbl" >
                            <img src="logos.png" alt="logo" style="width:120px; height:80px">
                            <p class="w-75 mx-auto mb-5">NIGER STATE POLYTECHNIC, ZUNGERU</p>
                        </td>
                        <td class="col-md-4" id="ttbl">
                            <strong>Department</strong>:&nbsp; <?php echo get_department($pdo,$allrows['dept_id']);?>
                            <br/>
                            <strong>School</strong>:&nbsp; <?php echo get_school($pdo, $allrows['school_id']);?>
                            <br/>
                            <strong>Programme</strong>:&nbsp; <?php echo $allrows['programme'];?>
                        </td>
                    </tr>
                </table>
                