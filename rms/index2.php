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
<style>
.the-bars {
    position: relative;
    width: 100%;
    margin-top: 15px;
    padding-bottom: 1px;
}

.the-bars > .the-wraps {
    position: absolute;
    bottom: 0;
    left: 15%;
    width: 80%;
    height: 40px;
    margin-bottom: -45px;
    border-top: 1px solid #000;
}

.the-bars > .the-wraps > .label {
    position: relative;
    display: inline-block;
    float: left;
    width: 25%;
    text-align: center;
}

.the-bars > .the-wraps > .label:before {
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    content: '';
    width: 1px;
    height: 8px;
    background-color: #000;
    margin-top: -8px;
}

.the-bars > .the-wraps > .label.last:after {
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    left: auto;
    content: '';
    width: 1px;
    height: 8px;
    background-color: #000;
    margin-top: -8px;
}
.the-bars > .the-wraps > .label h4 {
    font-size: 13px;
    text-transform: uppercase;
    letter-spacing: 1px;
    font-style: italic;
}

.the-bars > .chart {
    position: relative;
    width: 100%;
}

.the-bars > .chart > .item {
    position: relative;
    width: 100%;
    height: 40px;
    margin-bottom: 10px;
    font-weight: 700;
    color: #000;
    text-transform: uppercase;
}

.the-bars > .chart > .item > .bar {
    position: absolute;
    top: 0;
    left: 15%;
    width: 80%;
    height: 100%;
    background-color: rgb(103, 255, 255);
    z-index: 5;
}

.the-bars > .chart > .item > .bar > .values {
    display: block;
    position: absolute;
    top: 0;
    right: 0;
    height: 40px;
    line-height: 40px;
    padding-right: 12px;
    z-index: 15;
}

.the-bars > .chart > .item > .bar > .progress {
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    background-color: rgb(255, 141, 0);
    z-index: 10;
}

.the-bars > .chart > .item > .title {
    display: block;
    position: absolute;
    height: 40px;
    line-height: 40px;
    padding: 0px 50px 0px;
    letter-spacing: 2px;
    z-index: 15;
}
</style>
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
						
						<div class="container">
								<h2 style="text-align: center;">Survei Keahlian Programmer</h2>
								<div class="the-bars">
							
								<div class="the-wraps">
									<div class="label">
										<h4>Newbie</h4>
									</div>
									<div class="label">
										<h4>Beginner</h4>
									</div>
									<div class="label">
										<h4>Advance</h4>
									</div>
									<div class="label last">
										<h4>Professional</h4>
									</div>
								</div>
								<div class="chart clearfix">

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
						
							
						

<div class="item">
			<span class="title"><?php echo $thecode['code'];?></span>
	<div class="bar">
		<span class="values"><?php echo number_format($ppass);?>%</span>

		<div class="progress" data-values="<?php echo number_format($ppass);?>">
		</div>
	</div>
</div>


												
							<!-- <tr>
							<td><div>  </div> </td>
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
                        -->
                        <?php 
                        }?>   
						</div>
						</div>
						</div>	
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
<script>
	$(document).ready(function(){
	    barChart();

	    $(window).resize(function(){
	        barChart();
	    });

	    function barChart(){
	        $('.the-bars').find('.progress').each(function(){
	            var itemProgress = $(this),
	            itemProgressWidth = $(this).parent().width() * ($(this).data('values') / 100);
	            itemProgress.css('width', itemProgressWidth);
	        });
	    }
	});
	</script>