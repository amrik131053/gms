 <?php
	include 'connection/connection.php';
    include 'phpqrcode/qrlib.php';
ini_set('max_execution_time', '0');

	$id=$_POST['id'];
$sql = "SELECT * FROM Enquiry WHERE ID='$id'";
    $res = sqlsrv_query($conntest,$sql);
    if($row=sqlsrv_fetch_array($res))
	{
		$name = $row['Name'];
		// $fname = $row[''];
		$email= $row['Email'];
		
		$mobile= $row['MobileNo'];
		$course = $row['Course'];
		$sourse = $row['Source'];
		$counter = $row['CounterNo'];
		$token = $row['TokenNo'];
		$date = $row['DateEntry']->format('Y-m-d H:i:s.A');
	
	}
?>
<script>
    
var receiptID = "20180613T130518.512Z";
var receiptQRID = "4#4s1Fs"
</script>
<style>
    /* TODO: optimize */

body {
  font-family: 'Roboto', sans-serif;
  margin: 0px;
  padding: 0px;
}

.receipt {
    padding: 3mm;
    width: 80mm;
    border: 1px solid black;
}
.orderNo {
  width: 100%;
  text-align: right;
  padding-bottom: 1mm;
  font-size: 8pt;
  font-weight: bold;
}

.orderNo:empty {
  display: none;
}

.headerSubTitle {
  font-family: 'Equestria', 'Permanent Marker', cursive;
  text-align: center;
  font-size: 12pt;
}

.headerTitle {
  font-family: 'Equestria', 'Permanent Marker', cursive;
  text-align: center;
  font-size: 20pt;
  font-weight: bold;
}

#location {
  margin-top: 5pt;
  text-align: center;
  font-size: 16pt;
  font-weight: bold;
}

#date {
  margin: 5pt 0px;
  text-align: center;
  font-size: 8pt;
}

#barcode {
  display: block;
  margin: 0px auto;
}

#barcode:empty {
  display: none;
}

.watermark {
   position: absolute;
   left: 7mm;
   top: 60mm;
   width: 75mm;
   opacity: 0.1;
}

.keepIt {
  text-align: center;
  font-size: 8pt;
  font-weight: '';
}

.keepItBody {
  text-align: justify;
  font-size: 8pt;
}

.item {
  margin-bottom: 1mm;
}

.itemRow {
  display: flex;
  font-size: 8pt;
  align-items: baseline;
}

.itemRow > div {
  align-items: baseline;
}

.itemName {
  font-weight: bold;
}

.itemPrice {
  text-align: right;
  flex-grow: 1;
}

.itemColor {
  width: 10px;
  height: 100%;
  background: yellow;
  margin: 0px 2px;
  padding: 0px;
}

.itemColor:before {
  content: "\00a0";
}


.itemData2 {
  text-align: right;
  flex-grow: 1;
}

.itemData3 {
  width: 15mm;
  text-align: right;
}

.itemQuantity:before {
  content: "x";
}

.itemTaxable:after {
  content: " T";
}

.flex {
  display: flex;
  justify-content: center;
}

#qrcode {
  align-self: center;
  flex: 0 0 100px
}

.totals {
  flex-grow: 1;
  align-self: center;
  font-size: 8pt;
}

.totals .row {
  display: flex;
  text-align: right;
}

.totals .section {
  padding-top: 2mm;
}

.totalRow > div, .total > div {
  text-align: right;
  align-items: baseline;
  font-size: 8pt;
}

.totals .col1 {
  text-align: right;
  flex-grow: 1;
}

.totals .col2 {
   width: 22mm; 
}

.totals .col2:empty {
  display: none;
}

.totals .col3 {
  width: 15mm;  
}

.footer {
  overflow: hidden;
  margin-top: 5mm;
  border-radius: 7px;
  width: 100%;
  background: black;
  color: white;
  text-align: center;
  font-weight: bold;
  text-transform: uppercase;
}

.footer:empty {
    display: none;
}

.eta {
  padding: 1mm 0px;
}

.eta:empty {
    display: none;
}

.eta:before {
    content: "Estimated time order will be ready: ";
  font-size: 8pt;
  display: block;
}

.etaLabel {
  font-size: 8pt;
}

.printType {
  padding: 1mm 0px;
  width: 100%;
  background: grey;
  color: white;
  text-align: center;
  font-weight: bold;
  text-transform: uppercase;
}

.about {
  font-size: 12pt;
  overflow: hidden;
  background: #FCEC52;
  color: #3A5743;
  border-radius: 7px;
  padding: 0px;
  position: absolute;
  width: 500px;
  text-align: center;
  left: 50%;
  margin-top: 50px;
  margin-left: -250px;
}

.arrow_box h3, ul {
  margin: 5px;
}

.about li {
  text-align: left;
}

.arrow_box {
	position: absolute;
	background: #88b7d5;
  padding: 5px;
  margin-top: 20px;
  left: 95mm;
  top: 2;
  width: 500px;
	border: 4px solid #c2e1f5;
}
.arrow_box:after, .arrow_box:before {
	right: 100%;
	top: 50%;
	border: solid transparent;
	content: " ";
	height: 0;
	width: 0;
	position: absolute;
	pointer-events: none;
}

.arrow_box:after {
	border-color: rgba(136, 183, 213, 0);
	border-right-color: #88b7d5;
	border-width: 30px;
	margin-top: -30px;
}
.arrow_box:before {
	border-color: rgba(194, 225, 245, 0);
	border-right-color: #c2e1f5;
	border-width: 36px;
	margin-top: -36px;
}
@media print
{    
    .no-print, .no-print *
    {
        display: none !important;
    }
}
</style>

<!-- START RECEIPT -->
<div class="receipt" >
  
  <div class="orderNo">
    ID: <span id="Order #"><?=$id;?></span>
  </div>
  <div class="headerSubTitle">
    Visitor Receipt
  </div>
  <div class="headerTitle">
    Guru Kashi University
  </div>
  <div id="location">
    <?=$name;?>
  </div>
  <div id="location" style=" font-weight: 'none';">
  <?=$email;?>
  </div>
  <div class="headerSubTitle">
    <?=$mobile;?>
 
  </div>
  
  <div id="date">
   In Time: <?=$date;?>
  </div>
  <!-- <svg id="barcode"></svg> -->
  
  <hr>

  <!-- Items Purchased -->
<!-- <div class="flex"> -->
    <!-- <div id="qrcode"> -->
        <?php 
            $text = "Name:".$name."\nCabin No:".$counter."\nSource:".$sourse."\nCourse:".$course."\nIDNo:".$id;
            $path = 'degreeqr/';
            $file = $path.$counter.$mobile.".png";
            $ecc = 'M';
            $pixel_Size = 2;
            $frame_Size = 2;
            QRcode::png($text, $file, $ecc, $pixel_Size, 2);


            ?>
    <!-- </div> -->
    <!-- <div class="totals"> -->
      <div class="section">
        <!-- <div class="row"> -->
            <table border="1" width="300">
                <tr>
                    <th rowspan="2"><?php echo "<img src='".$file."' style='margin-top:0px;'>";?></th>
                    <th>Cabin No:</th>
                    <th><?=$counter;?></th>
                </tr>
                <tr>
                    <!-- <th>Cabin No:</th> -->
                    <th>Token No:</th>
                    <th><?=$token;?></th>
                </tr>
            </table>
          
    </div>
  </div>
 <div class="keepIt">
 <b>Powered By: Department of IT</b><br>
         <i class="fa fa-phone"></i>&nbsp;99142-86400,99142-25400<br>
         <i class="fa fa-envelope"></i>&nbsp; info@gku.ac.in</br>
  </div>
  <div class="keepItBody">
    </div>
</div>

<p style="text-align:center; " class="no-print">		<a href ="adm-enquiry.php" class="btn btn-primary"><button >Back</button></a>
		<button  class="btn btn-primary" onClick="window.print();">Print</button></p> 


        <script>
// function printDiv(divName) {
//      var printContents = document.getElementById(divName).innerHTML;
//      var originalContents = document.body.innerHTML;

//      document.body.innerHTML = printContents;

//      window.print();

//      document.body.innerHTML = originalContents;
// }


		</script>