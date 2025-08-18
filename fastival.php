<?php
include "connection/connection.php";
$Today=date('Y-m-d');
  $check_fastival="SELECT * FROM fastival_images Where  start_date_<= '$Today' and  end_date >= '$Today' and logo='1'";
$check_fastival_run=mysqli_query($conn,$check_fastival);
$count=mysqli_num_rows($check_fastival_run);
if($count>0)
{
if($row=mysqli_fetch_array($check_fastival_run))
{
    if($row['image']!='')
    {
?>
 <img src="http://gurukashiuniversity.co.in/data-server/fastival/<?=$row['image'];?>" class="brand_logo" alt="Logo" onerror="this.src='dist/img/logo-main.png';" >
 <?php
    }
    else
    {
        ?> 
        <img src="http://gurukashiuniversity.co.in/data-server/fastival/logo-main.png" class="brand_logo" alt="Logo"  >
        <?php   
    }
}
else{
?> 
<img src="http://gurukashiuniversity.co.in/data-server/fastival/logo-main.png" class="brand_logo" alt="Logo" >
<?php 
}
}
else
{
    ?> 
<img src="dist/img/logo-main.png" class="brand_logo" alt="Logo" >
<?php 

}
?>