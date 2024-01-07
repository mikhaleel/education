<?php $pagename= "Home Page"; include("result_header.php");

//$all_prog[] = array();

$our_prog = $pdo->query("SELECT * FROM `programmes` WHERE `dept_id` = '".$_SESSION['dept_id']."'");
?>
<!-- <style>
	.graph {
		margin-bottom:1em;
	font:normal 100%/150% arial,helvetica,sans-serif;
	}

	.graph caption {
		font:bold 150%/120% arial,helvetica,sans-serif;
		padding-bottom:0.33em;
	}

	.graph tbody th {
		text-align:right;
	}

	@supports (display:grid) {

		@media (min-width:32em) {

			.graph {
				display:block;
		width:600px;
		height:300px;
			}

			.graph caption {
				display:block;
			}

			.graph thead {
				display:none;
			}

			.graph tbody {
				position:relative;
				display:grid;
				grid-template-columns:repeat(auto-fit, minmax(2em, 1fr));
				column-gap:2.5%;
				align-items:end;
				height:100%;
				margin:3em 0 1em 2.8em;
				padding:0 1em;
				border-bottom:2px solid rgba(0,0,0,0.5);
				background:repeating-linear-gradient(
					180deg,
					rgba(170,170,170,0.7) 0,
					rgba(170,170,170,0.7) 1px,
					transparent 1px,
					transparent 20%
				);
			}

			.graph tbody:before,
			.graph tbody:after {
				position:absolute;
				left:-3.2em;
				width:2.8em;
				text-align:right;
				font:bold 80%/120% arial,helvetica,sans-serif;
			}

			.graph tbody:before {
				content:"100%";
				top:-0.6em;
			}

			.graph tbody:after {
				content:"0%";
				bottom:-0.6em;
			}

			.graph tr {
				position:relative;
				display:block;
			}

			.graph tr:hover {
				z-index:999;
			}

			.graph th,
			.graph td {
				display:block;
				text-align:center;
			}

			.graph tbody th {
				position:absolute;
				top:-3em;
				left:0;
				width:100%;
				font-weight:normal;
				text-align:center;
		white-space:nowrap;
				text-indent:0;
				transform:rotate(-45deg);
			}

			.graph tbody th:after {
				content:"";
			}

			.graph td {
				width:100%;
				height:100%;
				
				border-radius:0.5em 0.5em 0 0;
				transition:background 0.5s;
			}

			.graph tr:hover td {
				opacity:0.7;
			}

			.graph td span {
				overflow:hidden;
				position:absolute;
				left:50%;
				top:50%;
				width:0;
				padding:0.5em 0;
				margin:-1em 0 0;
				font:normal 85%/120% arial,helvetica,sans-serif;
	/* 			background:white; */
	/* 			box-shadow:0 0 0.25em rgba(0,0,0,0.6); */
				font-weight:bold;
				opacity:0;
				transition:opacity 0.5s;
		color:white;
			}

			.toggleGraph:checked + table td span,
			.graph tr:hover td span {
				width:4em;
				margin-left:-2em; /* 1/2 the declared width */
				opacity:1;
			}



		


		} /* min-width:32em */

	} /* grid only */
</style> -->

            <!-- chart row starts here -->
              <?php 
              while($prog_row = $our_prog->fetch())
              {
                
              ?>
            <div class="row">
                <?php 

                $course_l = $pdo->query("SELECT `level`  FROM `course` WHERE `programme` = '".$prog_row['programme']."' GROUP BY `level`");
                while($level = $course_l->fetch()){
                $code_b = $pdo->query("SELECT `code`  FROM `course` WHERE `programme` = '".$prog_row['programme']."' AND `level` = '".$level['level']."' GROUP BY `code`");
                ?>
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <span class="text-muted font-13"><?php echo $prog_row['programme']." (".$level['level'].")".$_SESSION['rsession'].$_SESSION['rsemester'];?></span>
                    <div class="line-chart-wrapper">
                      
					<table class="table">

                        <?php
                          while($thecode = $code_b->fetch()){
                            $res_a= $pdo->query ("SELECT * FROM `results` WHERE `programme` = '".$prog_row['programme']."' && `level` = '".$level['level']."' && `semester` = '".$_SESSION['rsemester']."' && `session` = '".$_SESSION['rsession']."' && `code` = '".$thecode['code']."'");
                            $ttl = $res_a->rowCount();

                            $res_p= $pdo->query ("SELECT * FROM `results` WHERE `programme` = '".$prog_row['programme']."' && `level` = '".$level['level']."' && `semester` = '".$_SESSION['rsemester']."' && `session` = '".$_SESSION['rsession']."' && `code` = '".$thecode['code']."' && `points` > 0");
                            $ttlp = $res_p->rowCount();

                            $res_f= $pdo->query ("SELECT * FROM `results` WHERE `programme` = '".$prog_row['programme']."' && `level` = '".$level['level']."' && `semester` = '".$_SESSION['rsemester']."' && `session` = '".$_SESSION['rsession']."' && `code` = '".$thecode['code']."'  && `points` < 1");
                            $ttlf = $res_f->rowCount();
                            if($ttl == 0){
                            $ppass = 0;
                            $pfail = 0;
                            }
                            else{                              
                            $ppass = (($ttlp/$ttl)*100);
                            $pfail = (($ttlf/$ttl)*100);
                            }
                            //$ppass = (($ttlp/$ttl)*100);
                        ?>
												
							<tr>
							<td><div> <?php echo $thecode['code'];?> </div> </td>
							<td>
								<table style="width: 100%;">
									<tr>
										<td>
										<div style='background-color:green;width:<?php echo number_format($ppass);?>%'>
										<p> <?php echo number_format($ppass); ?></p></div>
										
										<div style='background-color:red;width:<?php echo number_format($pfail);?>%'>
										<p> <?php echo number_format($pfail); ?></p></div>
										</td>
									</tr>
								</table>
							</td>
							</tr>
                       
                        <?php 
                        }?>                       
						</table>
                    </div>
                  </div>
                </div>
              </div>
              <?php 
                }?> 
            </div>
              <?php 
              }?>
            <!-- last row starts here -->
<?php include("result_footer.php");?>