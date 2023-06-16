<html>
<head>
<style>
p.inline {display: inline-block;}
span { font-size: 0px;}
</style>
<style type="text/css" media="print">
    @page 
    {
        size: A4;   /* auto is the initial value */
        margin: 0mm;  /* this affects the margin in the printer settings */

    }
</style>
</head>
<body onload="wdindow.print();">
	<div style="margin-left: 5%">
		<?php
		include 'barcode128.php';
		$from=$_POST['From'];
		$to=$_POST['To'];
		$print_qty=$_POST['print_qty'];
if ($print_qty!='')
 {
		$aa=explode(",",$print_qty);
		 $length=count($aa);
			for ($i=0; $i<$length; $i++)
			 { 
			echo "<p class='inline'>".bar128(stripcslashes($aa[$i]))."</p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
		     }
		 }
		 else
		 {
		 		for ($j=$from; $j<=$to; $j++)
			 { 
			echo "<p class='inline'>".bar128(stripcslashes($j))."</p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp";
		     }
		 }
	// print_r($aa);

		?>
	</div>
</body>
</html>