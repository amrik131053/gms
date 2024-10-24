<?php
date_default_timezone_set("Asia/Kolkata");
$timeStamp=date('Y-m-d H-i');
$todaydate=date('Y-m-d');
ini_set('max_execution_time', '0');
  

   
   
     $readonly = new mysqli('119.18.54.49', 'guruk2cy_connect','Amrik@123','guruk2cy_online');

  $code = $_POST['code'];
   
 
  
  if($code=='1')
  {  
       $UniRolNo=$_POST['UniRolNo'];
    $permission_qry="SELECT * FROM convocation where UniRollNo='$UniRolNo'";
   $permission_res=mysqli_query($readonly ,$permission_qry);

   if($degree_row=mysqli_fetch_array($permission_res))
   {
     echo "1";    

   }
   else
     {
          echo "0";
  }

  }
    if($code=='2')
   {
    $UniRolNo=$_POST['UniRolNo'];
$permission_qry="SELECT * FROM convocation where UniRollNo='$UniRolNo'";
   $permission_res=mysqli_query($readonly ,$permission_qry);

   while($degree_row=mysqli_fetch_array($permission_res))
   {
     $userid=$degree_row['UniRollNo'];
   $name= $degree_row['Name'];
     $fathername= $degree_row['FatherName'];
          $course= $degree_row['Course'];
      
   $response[] = array("id" =>$userid,"name" =>$name,"fathername" =>$fathername,"course" =>$course);
  }
  // encoding array to json format
  echo json_encode($response);
  exit;

                 





   }
   if($code=='3')
   {
     $roll_no=$_POST['uni'];
 $qq="SELECT * FROM online_payment where  status='success' AND remarks='4th Convocation' AND roll_no='$roll_no' ";
     $result = mysqli_query($readonly,$qq);
    $counter = 0; 
        while($rowr=mysqli_fetch_array($result)) 
        {
          $counter++;
         $oldslip= $rowr['slip_no'];

        }
if($counter>0)
{
  echo "<div class='alert alert-success'>Already Registered </div>
<form action='https://www.gku.ac.in/paymentconvo/receipt.php' method='post' target='_blank'>
<input type='hidden'   name='slip_no' Value='$oldslip'>
<input type='Submit' Value='Download Slip' class='btn btn-danger'>
</form> <br><br>"; 
}
else
{
    $name=$_POST['name'];
    $fname=$_POST['fathername'];
    $roll_no=$_POST['uni'];
    $course=$_POST['course'];
    $amount=$_POST['Ammount'];
    $from_email=$_POST['Email'];
    $mobile=$_POST['Mobile'];
    $status="success";
    $dt= date("Y-m-d");
       date_default_timezone_set('Asia/Kolkata'); 
    $tt= date("H:i:s");
    $purpose="";
    $payuid=$_POST['payuid'];
    $remarks    = '4th Convocation';
    $get_slipno = "SELECT slip_no from online_payment order by user_id desc limit 1";
    $result_slip = mysqli_query($readonly, $get_slipno);
    if (mysqli_num_rows($result_slip) > 0) 
    {
        while($row = mysqli_fetch_assoc($result_slip)) 
        {
           $slip_no =  $row['slip_no'];
            $slip_no  = $slip_no + 1;
        }
    }
    echo $qry="INSERT INTO online_payment(name, father_name, roll_no, course,status,payment_id, Created_date, Created_time, amount, purpose, email,phone, slip_no,remarks,confirmation) 
    VALUES('$name','$fname','$roll_no','$course','$status','$payuid','$dt','$tt','$amount','$purpose','$from_email','$mobile','$slip_no','$remarks','1')";


              $retval=mysqli_query($allow,$qry);
  
        
}
   }
   ?>