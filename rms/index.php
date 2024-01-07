<?php $pagename= "Home Page"; include("result_header.php");
$sessn = $_SESSION['rsession'];
$dptids = $_SESSION['dept_id'];
$semester = $_SESSION['rsemester'];
$our_prog = $pdo->query("SELECT * FROM `programmes` WHERE `dept_id` = '$dptids'");
?>
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
    background-color: rgb(151, 21, 11);
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
    background-color: rgb(26, 107, 12);
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
             if($res_conf['dashb'] == 1){ 
              while($prog_row = $our_prog->fetch())
              {
                $programme = $prog_row['programme'];
              ?>
            <div class="row">
                <?php
                $course_l = $pdo->query("SELECT `level`  FROM `course` WHERE `programme` = '$programme' GROUP BY `level`");
                while($level = $course_l->fetch()){
                    $levels = $level['level'];
                $code_b = $pdo->query("SELECT `code`  FROM `course` WHERE `programme` = '$programme' AND `level` = '$levels' AND `semester` ='$semester'  GROUP BY `code`");
                ?>
              <div class="col-sm-6 stretch-card grid-margin">
                <div class="card">
                  <div class="card-body">
                    <div class="line-chart-wrapper">
						
						<div class="container">
								<h4 style="text-align: center;">
								    <?php echo $prog_row['programme']." ($levels)";?></h4>
								<div class="the-bars">							
								<div class="the-wraps">
									<div class="label">
										<h4>Fail</h4>
									</div>
									<div class="label">
										<h4></h4>
									</div>
									<div class="label">
										<h4></h4>
									</div>
									<div class="label last">
										<h4>Pass</h4>
									</div>
								</div>
								<div class="chart clearfix">

                        <?php
                          while($thecode = $code_b->fetch()){
                            $fcode = $thecode['code'];

                            $res_a= $pdo->query ("SELECT `id` FROM `results` WHERE `programme` = '$programme' && `level` = '$levels' && `semester` = '$semester' && `session` = '$sessn' && `code` = '$fcode'");
                            $ttl = $res_a->rowCount();

                            $res_p= $pdo->query ("SELECT `id` FROM `results` WHERE `programme` = '$programme' && `level` = '$levels' && `semester` = '$semester' && `session` = '$sessn' && `code` = '$fcode' && `points` > 0");
                            $ttlp = $res_p->rowCount();

                            $res_f= $pdo->query ("SELECT `id` FROM `results` WHERE `programme` = '$programme' && `level` = '$levels' && `semester` = '$semester' && `session` = '$sessn' && `code` = '$fcode'  && `points` = 0");
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
									<span class="title text-white btn btn-primary"><?php echo $thecode['code'];?></span>
							<div class="bar">
								<span class="text-white values"><?php echo number_format($ppass);?>%</span>

								<div class="progress" data-values="<?php echo number_format($ppass);?>">
								</div>
							</div>
						</div>
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
              }
              }
              ?>
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