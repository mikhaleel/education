 <script type="text/javascript">
  function PrintDiv(divContents) {
          var divContents = document.getElementById("printdivcontent").innerHTML;
    var mywindow= window.open('print.php','Print','height=600,width=800');
    mywindow.document.write('<html><head><title>NigerPoly Result Summary</title><style>@printerpage { size 8.5in 11in; margin: 2cm }div.printerpage { page-break-after: always }</style>');
    mywindow.document.write('</head><body onload="window.print();">');
    mywindow.document.write(divContents);
    mywindow.document.write('</body></html>');
    // mywindow.document.close();
    mywindow.focus();
    setTimeout(function(){mywindow.print();mywindow.close();},500)
  return true;
  }
	</script>
	<?php $pagename= "Result Summary"; include("result_header.php");?>
<div class="card">
    <div class="card-body">
    <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
    <div class="row">
       <div class="col-12">
           <?php
          if(isset($_GET["Submit"])){
            $dept_id = $_GET["department"];
           // $dept_id = $_GET["department"];
             include("result_summary.php");
           }
           else{?>
       	    <form method="GET" name="grade" class="form" action="" target="_new"> 
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							<div class="form focused"> <select name="department" id="department" class="form-control js-example-basic-single">
                        	        <option value="">Select Department</option>
                        		<?php 
                        		 $dptt = $pdo->query("SELECT `programme` FROM `results` WHERE `semester`= '".$conf_semester."' AND `session` LIKE '".$conf_session."' AND (`programme` LIKE '%NATIONAL%' OR `programme` LIKE 'DIPLOMA%') GROUP BY `programme` order by `programme` ASC");
                        		
                        		   // $dptt = $pdo->query("SELECT * FROM `departments`");
                        			while($rows = $dptt->fetch(PDO::FETCH_ASSOC))
                        			{ 
                        			    $theprogs = strtolower($rows['programme']);
                                	if (($pos = strpos($theprogs, "in ")) !== FALSE) { 
                                        $fountprog = substr($theprogs, $pos+2); 
                                    }
                        			?>
                        			<option value="<?php echo $fountprog;?>"><?php 
                        			echo strtoupper($fountprog);?>
                        			</option>
                            		<?php
                            	    }?>
                        	</select>
							</div>
						</div>
					</div>
					<div class="col-sm-1">  
					<input name="Submit" value="View Summary Sheet" type="submit" class="btn btn-primary m-t-15 waves-effect"/>
				    </div>
				</div>
				<!--<input name="dept_id" value>-->
			</form>
       <?php 
           }?>
       </div>
     </div>
    </div>
</div>
<?php include("result_footer.php");?>