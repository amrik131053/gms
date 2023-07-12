


<?php  
include '../connection/connection.php';


$output = '';  
//$ctime = date("d-m-Y");
//$nowtime = strtotime($ctime);
$emp_id = $_POST['emp_id'];
$sql = '';

 $list_sql = "SELECT * FROM request where emp_id='$emp_id' AND request_status='draft'  ORDER BY ID DESC ";
$result = mysqli_query($connection_s,$list_sql); 
$count = 1; 
if(mysqli_num_rows($result) > 0)  
{
 $output .= '  
     

     <form action="store/category_action.php" method="post"> <div class="table-responsive">  
           <table class="table table-striped" id="example">  
      <thead>
                <tr>  
                    <th style="width=15px">Sr no</th>
          <th>Category</th>
          <th>Article</th>
          <th>Specification</th>
            <th>Quantity</th>
           
          <th>Action</th>
                </tr>
      </thead><tbody>';  
    }
 if(mysqli_num_rows($result) > 0)  
 {  
      while($row = 

mysqli_fetch_array($result))  
      {   $i=0;
           $output .= '  
                <tr> 
                <input type="hidden" name="code" value='.'3'.'> 
                
                    <td><input type="hidden" name="emp_id" value='.$row["emp_id"].'> <input type="hidden"  name="id[]" value='.$row["id"].'>'.$count++.'</td>  
                     <input type="hidden" value='.$row["id"].'><td>'.$row["category_name"].'</td>
              <td><input type="hidden" name="category" value='.$row["category_name"].'>'.$row["item_name"].'</td>
          <td>'.$row["specification"].'</td>
            <td>'.$row["quantity"].'</td>
              
          <td>
           
          
            <a href="#" onclick="delete_dr('.$row['id'].')"  class="fa fa-trash" data-target=".bs-delete-model-sm" data-toggle="tooltip"  data-placement="top" style="color:red" title="Delete"></a>
                  </td>
                </tr>  
           ';  
    
    $i++;  }  
 }  
 else  
 {  
      $output .= '';  
 }  
 $output .= '</tbody></table>'; 


if(mysqli_num_rows($result) > 0)  
 { 
$output .='<input type="submit" class="btn btn-primary" value="Submit for Approval"><br/><hr>';
}
 $output .= '</form>

      </div>';  
 echo $output;  
 ?>









































 
