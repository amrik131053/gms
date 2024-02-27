<!DOCTYPE html>
<html>
<body onclick="showCoords(event)" style="border:1px solid black;padding:4px">
<?php 
include "connection/connection.php";
$id=$_GET['id'];
$getData="SELECT * FROM certificates Where id='$id'";
$getDataRun=mysqli_query($conn,$getData);
if($row=mysqli_fetch_array($getDataRun))
{
 $filePath=$row['certificatePath'];
}
?>
<img src="http://gurukashiuniversity.co.in/data-server/value_added_course/<?=$row['certificatePath'];?>" width="100%" >
<div>

<p id="demo">Coordinates:</p>
</div>
<form action="action_g.php" method="post">
    <input type="hidden" name="code" value="376" >
    <input type="hidden" name="arrayX[]" id="arrayx" >
    <input type="hidden" name="arrayY[]" id="arrayy" >
    <button type="submit" >Submit</button>
</form>
<script>
    var arrayX=new Array;
    var arrayY=new Array;
function showCoords(event) {
  let cX = event.clientX;
  let cY = event.clientY;
  let sX = event.screenX;
  let sY = event.screenY;
  arrayX.push(cX);
  arrayY.push(cY);
//   let coords1 = "clientX: " + cX + ", clientY: " + cY;
//   let coords2 = "screenX: " + sX + ", screenY: " + sY;
//   document.getElementById("demo").innerHTML = coords1 + "<br>" + coords2;
document.getElementById("arrayx").value = arrayX;
    document.getElementById("arrayy").value = arrayY;

}

function submitXY() 
{
    console.log(arrayX);
   
    
}
</script>

</body>
</html>