<?php

include "header.php";
include "connection/connection.php";



?>
<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->
         <!-- Button trigger modal -->
         <div class="col-lg-12 col-md-12 col-sm-12">
         <div class="card-header">
            <h5>Books Issued</h5>
</div>
<div class="card">
<div class="card-body">
<div class="table-responsive">
<table class="table" >
  <thead>
             <tr>
           <th>Sr. No</th>
           <th>AccessionNo</th>
           <th>IssueDate</th>
           <th>Title</th>
           <th>Author</th>
           <th>Category</th>
           <th>Return Date</th>
         </tr>
         </thead>
         <tbody>
        
         <?php 
         $sr=1;
$sql_att="SELECT * from IssueRegister where IDNo='$EmployeeID'";

$stmt = sqlsrv_query($conntest,$sql_att);  
            while($row_staff_att=sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC) )
           {
           $AccessionNo=$row_staff_att['AccessionNo'];      
           $IssueDate=$row_staff_att['IssueDate']->format('d-M-Y');      
           $IDNo=$row_staff_att['IDNo'];      
           $Title=$row_staff_att['Title'];      
           $Author=$row_staff_att['Author'];      
           $CollegeName=$row_staff_att['CollegeName'];      
           $Category=$row_staff_att['Category'];  
           $LastReturnDate=$row_staff_att['LastReturnDate']->format('d-M-Y');  
           ?>
<tr>
<td><?=$sr;?></td>
<td><?=$AccessionNo;?></td>
<td><?=$IssueDate;?></td>
<td><?=$Title;?></td>
<td><?=$Author;?></td>
<td><?=$Category;?></td>
<td><?=$LastReturnDate;?></td>
           </tr>


<?php 
   $sr++; 
   // $aaa[]=$row_staff_att;      
}     
// print_r($aaa);
                       ?>
</div>
</div>
</div>
</div>
</div>
</div>
</section>

<?php 








include "footer.php";










                       ?>




