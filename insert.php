<?php 

  include "header.php";   
?>

<section class="content">
   <div class="container-fluid">
      <div class="row">
         <!-- left column -->

         <div class="col-lg-4 col-md-8 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Article wise QR</h3>
                  <div class="card-tools">
                     
                  </div>
               </div>
               <!-- /.card-header -->
                        <form action="#" method="post" >
      
                <div class="card-body">
                  <div class="form-group row">
                      <label for="inputEmail3" required=""  class="col-sm-12 col-form-label">Category Name</label>
                     <select class="form-control" name="CategoryID" id="Category" required>
                              <option value="">Select </option>
                              <?php
                                 $category_select="SELECT * FROM master_calegories";
                                 $category_select_run=mysqli_query($conn,$category_select);
                                 while ($category_select_row=mysqli_fetch_array($category_select_run)) 
                                 {
                                 echo "<option value='".$category_select_row['ID']."'>".$category_select_row['CategoryName']."</option>";
                                 }
                                 ?>
                           </select>
                    <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Article Name</label>
                    <div class="col-lg-12">
                       <select class="form-control" required="" id="articlebind" name="ArticleCode">


</select>
                              
                              
                    </div>
                      <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Number of Insert</label>
                    <div class="col-lg-12">
                       <select class="form-control" required=""  name="Number">
                        <?php
                        for ($i=1; $i<51 ; $i++) 
                           { ?>
               <option value='<?= $i;?>'><?= $i?></option>
               <?php                       }
                        ?>


</select>
                              
                              
                    </div>

                    <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Update </label>
                    <div class="col-lg-12">
                       <select class="form-control" required=""  name="update">
                        
               <option value='0'>NO</option>
               <option value='1'>Yes</option>
              


</select>
                              
                              
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit" name="Insert"  value="Insert" class="btn btn-primary">
               
                </div>
             </form>
          </div>
       </div>
   <div class="col-lg-4 col-md-8 col-sm-3">
            <div class="card card-info">
               <div class="card-header">
                  <h3 class="card-title">Room Insert</h3>
                  <div class="card-tools">
                     
                  </div>     
               </div>
               <!-- /.card-header -->
                        <form action="#" method="post" >
      
                <div class="card-body">
                  <div class="form-group row">
                      <label for="inputEmail3" required=""  class="col-sm-12 col-form-label">Floor Name</label>
                     <select class="form-control" name="floorname" id="Category" required>
                       
    <option value=""> Select </option> 
    <?php
    $article = "SELECT DISTINCT r.Floor, r.FloorID from location_master l inner join room_master r on r.FloorID=l.Floor";
    $article_run = mysqli_query($conn, $article);
    while ($article_row = mysqli_fetch_array($article_run)) {
       ?>
        <option value = "<?=$article_row['FloorID']?>" > <?=$article_row['Floor'];?> </option> 
        <?php
    }?>
                           </select>
                
                      <label for="inputEmail3" required="" class="col-sm-12 col-form-label">Room Number</label>
                    <div class="col-lg-12">
                      
                        <input type="text" name="roomnumber" class="form-control" required>      
                              
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <input type="submit" name="roomInsert"  value="Insert" class="btn btn-primary">
               
                </div>
             </form>
          </div>
       </div>
</div>
</div>

<?php
 if (isset($_POST['Insert']))
 {
    $ArticleName = $_POST['ArticleCode'];
    $CategoryID = $_POST['CategoryID'];
        $update = $_POST['update'];
     $number=$_POST['Number'];

if($number>0)
{
 for ($i=1; $i <=$number; $i++) { 


                    
                        
    $Summury_insert = "INSERT into stock_summary (CategoryID,ArticleCode,CPU,OS,Memory,Storage,Brand,Model,Status)values ('$CategoryID','$ArticleName','NA','NA','NA','NA','NA','NA','$update')";
    $Summury_run = mysqli_query($conn, $Summury_insert);
    if ($Summury_run == true) {
        echo "Successfully Insert";
    } else {
        echo "Ohh yaar ";
    }

  }    
}
}


 if (isset($_POST['roomInsert']))
 {

    $id = $_POST['floorname'];
    if ($id=='0')
     {
       $Floor='Ground';
    }elseif ($id=='1') {
       $Floor='First';
    }elseif ($id=='2') {
       $Floor='Second';
    }
    elseif ($id=='3') {
      $Floor='Third';
    }
    else
    {
      $Floor='Fourth';
    }

    $roomnumber = $_POST['roomnumber'];
               
    $Summury_insert = "INSERT into room_master (FloorID,Floor,RoomNo)values ('$id','$Floor','$roomnumber')";
    $Summury_run = mysqli_query($conn, $Summury_insert);
    if ($Summury_run == true) {
        echo "Successfully Insert";
    } else {
        echo "Ohh yaar ";
    }
 
}
?>
 
  
</section>

<?php include "footer.php";  ?>