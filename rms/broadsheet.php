<?php $pagename= "Broadsheet"; include("result_header.php");?>

<div class="card">
    <div class="card-body">
    <!-- <h4 class="card-title">Data table<?php //echo $dpt;?></h4> -->
    <div class="row">
       <div class="col-12">
         <?php 
            $acad = 1;
            include("broadsheet_contents.php");?>
       </div>
      </div>
     </div>
    </div>
<?php include("result_footer.php");?>
<script>
    function progm()
    {
        //alert("welcome");
        var prg= document.getElementById("programme").value;
        window.location.href="?progs="+prg;
    }
</script>