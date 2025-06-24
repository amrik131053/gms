<?php 
   ini_set('max_execution_time', '0');
   include "header.php";  
   include "connection/connection.php"; 
   ?>
   <p id="ajax-loader"></p>
<section class="content">
<div class="container-fluid">
<div class="row">
          <!-- left column -->
          <div class="col-lg-12 col-md-12 col-sm-12">
   
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Reports</h3>
              </div>

<div class="card-body table-responsive">
<?php 
$query = "SELECT * FROM seminar_worksop_attended where  status_code=3 order by id desc";      
    $rs_result = mysqli_query ($conn_spoc, $query);   
?>                      
    	   <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>   
										    <th>S.No.</th> 
											<th>Title of the Programme</th> 
											<th>Level</th> 
											<th>Dates (From-To)</th> 
											<th>Organized By </th> 
											<th>Funding Agency</th> 
										
											<th width="20%" style="text-align:center">Action</th>
										</tr>   
                            </thead>
                            
                            <tbody>
                               <?php  
									if($rs_result->num_rows>0) 
									{
										$count = 0; 
										while ($row = mysqli_fetch_array($rs_result)) 
										{  
											$count++;
											// Display each field of the records.    
											$fromDate = $row["from_date"];  
                                            $startDate = date("d-m-Y", strtotime($fromDate));  
											$toDate = $row["to_date"];  
                                            $endDate = date("d-m-Y", strtotime($toDate));  
										?>     
										<tr>  
											<?php $id= $row["id"]; ?>
											<td><?php echo $count; ?></td>
											<td><?php echo $row["title_of_the_programme"]; ?></td>    
											<td><?php echo $row["level"]; ?></td> 
											<td><?php echo  $startDate;?> to <?php echo $endDate; ?></td>     
											<td><?php echo $row["organized_by"]; ?></td>   
											<td><?php echo $row["funding_agency"]; ?></td> 
																			
											<td>
											<a href='../spoc/att_details_downloaddb.php?id=<?php echo $id ?>' class="text-primary"><i class="fa fa-download"></i> Download</a>
							   			</td>											
										</tr>     
									<?php     
									};    
									?>   
									<?php 
									} 		
                               ?>
                                      
</tbody>
</table>                         
                           </div>
</div>
</div>
</div>
</div>

</section>

<?php include "footer.php";



