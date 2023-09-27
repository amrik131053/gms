<?php
session_start();

date_default_timezone_set("Asia/Kolkata");
include '../connection/connection.php';
$stock_quantity="";
$code=$_POST['code'];
 $output ='';   
if($code==1)
{

$category = $_POST['category'];
$sql = "SELECT * FROM item_category WHERE category ='$category'  ORDER BY item_name ";
$result = mysqli_query($connection_s, $sql);
echo "<option value=''>Select Article</option>";
while($row=mysqli_fetch_array($result))
{
	

	echo "<option value='".$row["item_name"]."'>".$row["item_name"]."</option>";

	 
}
}
else if($code==123)
{

$category = $_POST['category'];
$sql = "SELECT * FROM master_stock WHERE category ='$category'  ORDER BY item_name ";
$result = mysqli_query($connection_s, $sql);
echo "<option value=''>Select Article</option>";
while($row=mysqli_fetch_array($result))
{
	

	echo "<option value='".$row["item_name"]."'>".$row["item_name"]."</option>";

	  
}
}

else if($code==124)
{
 $category = $_POST['category'];
$emp_id=$_POST['emp_id'];
$sql = "SELECT DISTINCT item_name from request WHERE category_name ='$category' AND emp_id='$emp_id'  ORDER BY item_name ";
$result = mysqli_query($connection_s, $sql);
echo "<option value=''>Select Article</option>";
while($row=mysqli_fetch_array($result))
{
	

	echo "<option value='".$row["item_name"]."'>".$row["item_name"]."</option>";

	 
}
}  
// request
else if($code==2)
{
$category = $_POST['category'];
$item_name=$_POST['item'];
$emp_id=$_POST['emp_id'];
$department=$_POST['department'];
$name=$_POST['name'];
$request_status="draft";
$specification=$_POST['specification'];
$quantity=$_POST['quantity'];
$request_date=date("Y-m-d");
if ($category!="" AND $item_name!="" AND $quantity!="")
{

$sql = "SELECT * FROM item_category WHERE category ='$category' AND item_name='$item_name'";
$result = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($result))
{
	

	$category_code=$row["category_code"];
	$item_code=$row["item_code"];
	 
}
 
 $sql = "SELECT * FROM master_stock WHERE category_code ='$category_code' AND item_code='$item_code'";


$result = mysqli_query($connection_s, $sql);


while($row=mysqli_fetch_array($result))
{
 $stock_quantity1=$row["issued_qty"];
 $stock_quantity2=$row["quantity"];

}
$new_quantity1=$stock_quantity1 +$quantity;

if($stock_quantity2>=$new_quantity1)

{

	 $sql = "SELECT * FROM request WHERE emp_id ='$emp_id' AND request_status='draft' AND item_code='$item_code'";

	 
	 
$result = mysqli_query($connection_s, $sql);

if(mysqli_num_rows($result)>0)
{


echo  '<div   class="alert-danger" style="text-align: center; height="50px">Article allready  Added 
                  


                  </div>';

 }



else
{







	$result = mysqli_query($connection_s,"INSERT into request(emp_id,name,item_code,item_name,category_name,category_code,request_date,request_status,quantity,specification,department)
	                                               values ('$emp_id','$name','$item_code','$item_name','$category','$category_code','$request_date','$request_status','$quantity','$specification','$department')");
mysqli_close($connection_s);


 
       
  echo  '<div   class="alert-success" style="text-align: center; height="50px">Article Added Successfully
                  


                  </div>';  
}

}
else
{

	echo '<div   class="alert-danger" style="text-align: center; height="50px">Out of Stock
                  


                  </div>';
}






}

else
{
echo '<div   class="alert-danger" style="text-align: center; height="50px">Valid input Required
                  


                  </div>';
}
}

// Publish 
else if($code==3)
{


$reference_no=rand(100,9999).date("His");
$emp_id=$_POST['emp_id'];
$category=$_POST['category'];
$id= $_POST['id'];
$request_date=date("Y-m-d");
$request_status='pending';
$rowCount = count($_POST["id"]);
$id=$_POST["id"];
$approved_date='';
$request_app='';



 $staff="SELECT Name,Designation,Department,CollegeName FROM Staff Where IDNo='$emp_id'";
    $stmt = sqlsrv_query($conntest,$staff);  
   while($row_staff = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
        {



  $name=$row_staff['Name'];
	$college=$row["college"];
	$dept=$row_staff['Department'];
	$designation=$row_staff['Designation'];
	$superviser_id='';

        }
// if($superviser_id!='0')
// {
// if($superviser_id=='121009')
// {
// //changes direct time 29.11.2022
// $request_app='Pre-Approved';
// $approved_date=date("Y-m-d");
// $request_status='Approved';
// }
// else
// {
// $request_app='Pre-Approved';
// $approved_date=date("Y-m-d");
// 	$request_status='Approved';
// //$request_status='recommending';
// }

// }



//if(($category=='Miscellaneous'||$category=='Carpentory'||$category=='Plumbing') AND $emp_id=='170675' ||$emp_id=='170236' ||$emp_id=='101155')

// if($category=='Miscellaneous' AND $emp_id=='170236'){
// $request_status='Approved';
// $request_app='Pre-Approved';
// $approved_date=date("Y-m-d");
// }


// if($category=='Electrical' AND $emp_id=='170129')
// {
// $request_status='Approved';
// $request_app='Pre-Approved';
// $approved_date=date("Y-m-d");
// }

$request_app='Pre-Approved';
$approved_date=date("Y-m-d");
	$request_status='Approved';


$result = mysqli_query($connection_s,"INSERT into ledger(emp_id,name,submit_date,request_status,reference_no,college,college_dept,designation,approved_date,approving_athority,superwiser_id)
	                                               values ('$emp_id','$name','$request_date','$request_status','$reference_no','$college','$dept','$designation','$approved_date','$request_app','$superviser_id')");

for($i=0;$i<$rowCount;$i++) {
$result = mysqli_query($connection_s,"UPDATE request set request_status='$request_status',reference_no='$reference_no' WHERE id='$id[$i]'");
}
/*if($category=='Electrical'|| $category=='Plumbing' AND $emp_id=='131053')
{
$request_status='Approved';
$result = mysqli_query($connection_s, "UPDATE ledger set request_status='$request_status',approving_athority='Pre Approved',authority_id='',authority_desig='',approved_date='$request_date' WHERE reference_no='$reference'");
}*/




mysqli_close($connection_s);
header('Location:../store_request.php');

}


//return add

else if($code==102)
{
$category = $_POST['category'];
$item_name=$_POST['item'];
$emp_id=$_POST['emp_id'];
$request_status="draft";
$specification=$_POST['specification'];
$quantity=$_POST['quantity'];
$request_date=date("Y-m-d");
if ($category!="" AND $item_name!="" AND $quantity!="")
{

$sql = "SELECT * FROM item_category WHERE category ='$category' AND item_name='$item_name'";
$result = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($result))
{
	

	$category_code=$row["category_code"];
	$item_code=$row["item_code"];
	 
}
 
 $sql = "SELECT * FROM master_stock WHERE category_code ='$category_code' AND item_code='$item_code'";


$result = mysqli_query($connection_s, $sql);



	 $sql = "SELECT * FROM request WHERE emp_id ='$emp_id' AND request_status='draft' AND item_code='$item_code'";
	 
$result = mysqli_query($connection_s, $sql);

if(mysqli_num_rows($result)>0)
{


echo  '<div   class="alert-danger" style="text-align: center; height="50px">Article allready  Added 
                  


                  </div>';

	 }
else
{




 


	$result = mysqli_query($connection_s,"INSERT into returned(emp_id,item_code,item_name,category_name,category_code,request_date,request_status,quantity,specification)
	                                               values ('$emp_id','$item_code','$item_name','$category','$category_code','$request_date','$request_status','$quantity','$specification')");
mysqli_close($connection_s);


 
       
  echo  '<div   class="alert-success" style="text-align: center; height="50px">Article Added Successfully
                  


                  </div>';  
}









}

else
{
echo '<div   class="alert-danger" style="text-align: center; height="50px">Valid input Required
                  


                  </div>';
}
}





//publish return
else if($code==103)
{


$reference_no=rand(100,9999).date("His");
$emp_id=$_POST['emp_id'];
$id= $_POST['id'];
$request_date=date("Y-m-d");
$request_status='pending';

$rowCount = count($_POST["id"]);
$id=$_POST["id"];


$sql = "SELECT * FROM user WHERE emp_id ='$emp_id'";
$result = mysqli_query($conn, $sql);

while($row=mysqli_fetch_array($result))
{
	

	$name=$row["name"];
	$college=$row["college"];
	$dept=$row["department"];
	$designation=$row["designation"];
	 
}


$result = mysqli_query($connection_s,"INSERT into ledger_return(emp_id,name,submit_date,request_status,reference_no,college,college_dept,designation)
	                                               values ('$emp_id','$name','$request_date','$request_status','$reference_no','$college','$dept','$designation')");




for($i=0;$i<$rowCount;$i++) {






$result = mysqli_query($connection_s,"UPDATE returned set request_status='$request_status',reference_no='$reference_no' WHERE id='$id[$i]'");




}

mysqli_close($connection_s);
header('Location:../store_return.php');

}





// Approved

else if($code==4)
{



$emp_id=$_POST['emp_id'];
$app_qty=$_POST['app_qty'];

$reference=$_POST['reference_no'];

$request_date=date("Y-m-d");
$request_status='Verified';
$rowCount = count($_POST["id"]);
$verify_date=date("Y-m-d");
$comments=$_POST['comments'];

$id=$_POST["id"];

$sql = "SELECT * FROM user WHERE emp_id ='$emp_id'";
$resultu = mysqli_query($conn, $sql);

while($row=mysqli_fetch_array($resultu))
{
	

	 $name=$row["name"];
	 $college=$row["college"];
	 $dept=$row["department"];
	 $designation=$row["designation"];
	 
}


for($i=0;$i<$rowCount;$i++) {


$result = mysqli_query($connection_s, "UPDATE request set request_status='$request_status',varify_qty='$app_qty[$i]' WHERE id='$id[$i]'");

}
$result = mysqli_query($connection_s, "UPDATE ledger set request_status='$request_status',varify_authority='$name',varify_id='$emp_id',varify_desig='$designation',comments='$comments',verify_date='$verify_date' WHERE reference_no='$reference'");


mysqli_close($connection_s);

header('Location:verify_request.php');

}

else if($code==5)
{
  

$s_name=$_POST['s_name'];
$s_pan=$_POST['s_pan'];
$s_gst_no=$_POST['s_gst_no'];

$s_addres=$_POST['s_addres'];

$s_email=$_POST['s_email'];
$s_contact=$_POST['s_contact'];
$s_city=$_POST['s_city'];

$s_state=$_POST['s_state'];





$result = mysqli_query($connection_s,"INSERT into suplier(s_name,s_gst_no,s_adress,s_email,s_contact,s_city,s_state,s_pan)
	                                               values ('$s_name','$s_gst_no','$s_addres','$s_email','$s_contact','$s_city','$s_state','$s_pan')");







mysqli_close($connection_s);

echo "Added Successfully";
//header('Location:master_stock.php');

}



else if($code==6)
{
  



$s_name=$_POST['s_name'];


$list_sql = "SELECT * FROM suplier where s_name='$s_name' ";
$result = mysqli_query($connection_s,$list_sql); 

      while($row =mysqli_fetch_array($result))  
      {   
      
   
echo "<br/><lable><b>GST NO</b></lable> <input type='text' name='text' placeholder='Address'  class='form-control' disabled='true' Value=".$row['s_gst_no']." >";

echo " <lable><b>PAN NO</b></lable><input type='text' name='text' placeholder='PAN'  class='form-control'  disabled='true'  Value=".$row['s_pan']." >"; 


echo "<lable><b>Email</b></lable><input type='text' name='text' placeholder='Address'  class='form-control'  disabled='true' Value=".$row['s_email']." >"; 

echo "<lable><b>Adress</b></lable> <input type='text' name='text' placeholder='Address'  class='form-control'  disabled='true' Value=".$row['s_adress']." >";

echo "<lable><b>State</b></lable> <input type='text' name='text' placeholder='Address'  class='form-control'  disabled='true' Value=".$row['s_state']." >";
               



}
mysqli_close($connection_s);



}

else if($code==7)
{
$category = $_POST['category'];
$item_name=$_POST['item'];
$brand=$_POST['brand'];
$suplier=$_POST['suplier'];
$bill_no=$_POST['bill_no'];

$quantity=$_POST['quantity'];
$request_date=$_POST['bill_date'];

if ($category!="" AND $item_name!="" AND $quantity!="" AND $brand!="" AND $suplier!="" AND $bill_no!="" AND $request_date!="")
{
$sql = "SELECT * FROM item_category WHERE category ='$category' AND item_name='$item_name'";
$result = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($result))
{
	 $category_code=$row["category_code"];
	 $item_code=$row["item_code"];    
}

$sql = "SELECT * FROM suplier WHERE s_name ='$suplier'";
$result = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($result))
{

	 $s_pan=$row["s_pan"];
	  $s_gst_no=$row["s_gst_no"];
	  $s_contact=$row["s_contact"];
	 $s_adress=$row["s_adress"];
	  $s_state=$row["s_state"];
	   
}

$result = mysqli_query($connection_s,"INSERT into purchase_record(item_code,item_name,category_name,category_code,p_date,item_brand,bill_no, s_gst_no,s_contact,supplier,quantity,s_address,s_state,s_pan_no)
	                                               values ('$item_code','$item_name','$category','$category_code','$request_date','$brand','$bill_no','$s_gst_no','$s_contact','$suplier','$quantity','$s_adress','$s_state','$s_pan')");

 $sql = "SELECT * FROM master_stock WHERE category_code ='$category_code' AND item_code='$item_code'";
$result = mysqli_query($connection_s, $sql);

if ($result->num_rows == 0) 
{

$result_z = mysqli_query($connection_s,"INSERT into master_stock(item_code,item_name,category,category_code,quantity)
	                                               values ('$item_code','$item_name','$category','$category_code','$quantity')");
}
else
{
while($row=mysqli_fetch_array($result))
{	
     $stock_quantity=$row["quantity"];
}
$new_quantity=$stock_quantity+$quantity;

$result = mysqli_query($connection_s, "UPDATE master_stock set quantity='$new_quantity' WHERE category_code ='$category_code' AND item_code='$item_code'");

}

mysqli_close($connection_s);


 
       
  echo  '<div   class="alert-success" style="text-align: center; height="50px">Article Added Successfully
                  


                  </div>';  


}
else
{
echo '<div   class="alert-danger" style="text-align: center; height="50px">Valid Input Required 
                  
                 </div>';
}


}


//  issue Register

else if($code==8)
{


$app_qty=$_POST['app_qty'];

$reference=$_POST['reference_no'];

$issue_date=date("Y-m-d");
$request_status='issued';

$rowCount = count($_POST["id"]);
$id=$_POST["id"];

$flag=0;
for($i=0;$i<$rowCount;$i++) {



$sql = "SELECT * FROM request  WHERE id='$id[$i]'";
$result = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($result))
{
	
 $item_code=$row['item_code'];
 $category_code=$row['category_code'];
     
}

$sql = "SELECT * FROM master_stock WHERE category_code ='$category_code' AND item_code='$item_code'";


$result = mysqli_query($connection_s, $sql);

if(mysqli_num_rows($result)>0)
    	{
while($row=mysqli_fetch_array($result))
{
 $stock_quantity1=$row["issued_qty"];
 $stock_quantity2=$row["quantity"];
}

 $new_quantity1=$stock_quantity1 +$app_qty[$i];

if($stock_quantity2>=$new_quantity1)
{
 $flag=0;
}
else
{
$flag=1;
}
}
else
{

$_SESSION['incorrect'] = "<div class='alert alert-danger'>Not Exist in Stock </div>";
			header('Location:issue_register.php');
}
}

if($flag==0)

{
for($i=0;$i<$rowCount;$i++) {

$sql = "SELECT * FROM request  WHERE id='$id[$i]'";
$result = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($result))
{
	
 $item_code=$row['item_code'];
 $category_code=$row['category_code'];
     
}



$sql = "SELECT * FROM ledger  WHERE reference_no='$reference'";
$result = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($result))
{
	
 $name=$row['name'];
 $emp_id=$row['emp_id'];
     
}

$sql = "SELECT * FROM master_stock WHERE category_code ='$category_code' AND item_code='$item_code'";
$result = mysqli_query($connection_s, $sql);

if(mysqli_num_rows($result)>0)
    	{  			
while($row=mysqli_fetch_array($result))

{
 $stock_quantity1=$row["issued_qty"];
 $stock_quantity2=$row["quantity"];
}
 $new_quantity1=$stock_quantity1 + $app_qty[$i];

if($stock_quantity2>=$new_quantity1)
{




	
$result = mysqli_query($connection_s,"INSERT into request_test(item_code,category_code,quantity,reference_no,issue_date,name,emp_id)
	                                               values ('$item_code','$category_code','$app_qty[$i]','$reference','$issue_date','$name','$emp_id')");






 $resultstr = mysqli_query($connection_s,"UPDATE request set request_status='$request_status',issue_date='$issue_date',issued_qty='$app_qty[$i]'  WHERE id='$id[$i]' ANd issued_qty<=0");
 $cont= mysqli_affected_rows($connection_s);
if($cont>0)
{
$result = mysqli_query($connection_s, "UPDATE master_stock set issued_qty='$new_quantity1' WHERE category_code ='$category_code' AND item_code='$item_code'");


 


$_SESSION['not_valid'] = "<div class='alert alert-success'>Issued </div>";

			header('Location:issue_register.php');


}
else
{
	$_SESSION['incorrect'] = "<div class='alert alert-danger'>Already Issued</div>";
			header('Location:issue_register.php');
}

$result = mysqli_query($connection_s, "UPDATE ledger set request_status='$request_status',issued_date='$issue_date' WHERE reference_no='$reference'");
}


else
{

			$_SESSION['incorrect'] = "<div class='alert alert-danger'>Limit Exceed   </div>";
			header('Location:issue_register.php');
		
}


}






}

}

else
{

			$_SESSION['incorrect'] = "<div class='alert alert-danger'>Limit Exceed than the stock  </div>";
			header('Location:issue_register.php');
		
}










mysqli_close($connection_s);

//header('Location:issue_register.php');

}


// retrun register

else if($code==108)
{



$app_qty1=$_POST['app_qty1'];
$app_qty2=$_POST['app_qty2'];

$reference=$_POST['reference_no'];

$issue_date=date("Y-m-d");
$request_status='Accepted';

$rowCount = count($_POST["id"]);
$id=$_POST["id"];


for($i=0;$i<$rowCount;$i++) {

$sql = "SELECT * FROM returned  WHERE id='$id[$i]'";
$result = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($result))
{
	
 $item_code=$row['item_code'];
 $category_code=$row['category_code'];
     
}

$sql = "SELECT * FROM master_stock WHERE category_code ='$category_code' AND item_code='$item_code'";
$result = mysqli_query($connection_s, $sql);

if(mysqli_num_rows($result)>0)
    	{  			
while($row=mysqli_fetch_array($result))

{

 $stock_quantity2=$row["quantity"];
}
 $new_quantity1=$stock_quantity2 + $app_qty1[$i];
}




 $result = mysqli_query($connection_s, "UPDATE master_stock set quantity='$new_quantity1' WHERE category_code ='$category_code' AND item_code='$item_code'");



 $result = mysqli_query($connection_s,"UPDATE returned set request_status='$request_status',issue_date='$issue_date',acceptable_qty='$app_qty1[$i]',notworking_qty='$app_qty2[$i]'  WHERE id='$id[$i]'");


$result = mysqli_query($connection_s, "UPDATE ledger_return set request_status='$request_status',issue_date='$issue_date' WHERE reference_no='$reference'");


$_SESSION['not_valid'] = "<div class='alert alert-success'>Returned</div>";
			header('Location:return_register.php');







}



















mysqli_close($connection_s);

//header('Location:issue_register.php');

}























else if($code==9)
{
$emp_id=$_POST['emp_id'];
$app_qty=$_POST['app_qty'];

$reference=$_POST['reference_no'];

$approved_date=date("Y-m-d");


$request_status='Approved';
$rowCount = count($_POST["id"]);
$id=$_POST["id"];

$sql = "SELECT * FROM user WHERE emp_id ='$emp_id'";
$resultu = mysqli_query($conn, $sql);

while($row=mysqli_fetch_array($resultu))
{
	 $name=$row["name"];
	 $college=$row["college"];
	 $dept=$row["department"];
	 $designation=$row["designation"];
 
}

for($i=0;$i<$rowCount;$i++) {

$result = mysqli_query($connection_s, "UPDATE request set request_status='$request_status',approved_qty='$app_qty[$i]' WHERE id='$id[$i]'");
}
$result = mysqli_query($connection_s, "UPDATE ledger set request_status='$request_status',approving_athority='$name',authority_id='$emp_id',authority_desig='$designation',approved_date='$approved_date' WHERE reference_no='$reference'");

mysqli_close($connection_s);

header('Location:approve_request.php');

}



else if($code==12)
{

$item_name=$_POST['article_name'];

 $category=$_POST['category'];




$sql = "SELECT * FROM item_category WHERE category ='$category'";
$resultu = mysqli_query($connection_s, $sql);

while($row=mysqli_fetch_array($resultu))
{
	 $category_code=$row["category_code"];
	
 
}
$result_z = mysqli_query($connection_s,"INSERT into item_category(item_name,category,category_code)
	                                               values ('$item_name','$category','$category_code')");



mysqli_close($connection_s);

header('Location:store_admin.php');

}

else if($code==13)
{



$emp_id=$_POST['emp_id'];
$app_qty=$_POST['app_qty'];

$reference=$_POST['reference_no'];

$request_date=date("Y-m-d");
$request_status='pending';
$rowCount = count($_POST["id"]);
$verify_date=date("Y-m-d");
$comments=$_POST['comments'];

$id=$_POST["id"];

$sql = "SELECT * FROM user WHERE emp_id ='$emp_id'";
$resultu = mysqli_query($conn, $sql);

while($row=mysqli_fetch_array($resultu))
{
	

	 $name=$row["name"];
	 $college=$row["college"];
	 $dept=$row["department"];
	 $designation=$row["designation"];
	 
}


for($i=0;$i<$rowCount;$i++) {


$result = mysqli_query($connection_s, "UPDATE request set request_status='$request_status',quantity='$app_qty[$i]' WHERE id='$id[$i]'");

}
$result = mysqli_query($connection_s, "UPDATE ledger set request_status='$request_status',recommend_authority='$name',recommend_id='$emp_id',recommend_desig='$designation',verify_date='$verify_date' WHERE reference_no='$reference'");


mysqli_close($connection_s);

header('Location:recommend.php');

}
















else
{

	echo "something went wrong";
}



?>