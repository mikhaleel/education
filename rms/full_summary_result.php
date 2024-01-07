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
           // $dept_id = $_GET["department"];
             include("result_summary2.php");
           
           ?>
       </div>
     </div>
    </div>
</div>
<?php include("result_footer.php");?>