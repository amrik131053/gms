<?php 
  include "header.php";   
?>

   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-lg-5 col-md-5 col-sm-3">
   
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Create Article</h3>
              </div>
        
              <form class="form-horizontal" action="" method="POST">
                <div class="card-body">
                  <div class="form-group row">
                    <label for="inputEmail3" required="" class="col-sm-4 col-form-label">Category Name</label>
                    <div class="col-lg-12">
                      <select class="form-control" name="" id="CategoryID">
                                 <option value=" ">Select </option>
                                 <?php
                                    $category_select="SELECT * FROM master_calegories";
                                    $category_select_run=mysqli_query($conn,$category_select);
                                    while ($category_select_row=mysqli_fetch_array($category_select_run)) 
                                    {
                                    echo "<option value='".$category_select_row['ID']."'>".$category_select_row['CategoryName']."</option>";
                                    }
                                    ?>
                              </select>
                    </div>
                    <label for="inputEmail3" required="" class="col-sm-4 col-form-label">Article Name</label>
                    <div class="col-lg-12">
                      <input type="text" class="form-control" id="ArticleName" placeholder="Article_Name">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-info" onclick="Article_insert();">Create</button>
               <p id="Article_success"></p>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            <!-- /.card -->

          </div>
           
          <div class="col-lg-7 col-md-7 col-sm-3">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Articles</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search" onkeyup="articlesearch(this.value);">

                   
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 600px;">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Sr.No</th>
                      <th>Category Name</th>
                      <th>Article Name</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody id="search_record">
                    <?php 
                        $articles_num=0;
                        $articles="SELECT * FROM master_calegories c INNER JOIN master_article a ON c.ID=a.CategoryCode";
                        $articles_run=mysqli_query($conn,$articles);
                        while ($articles_row=mysqli_fetch_array($articles_run)) 
                        {
                        $articles_num=$articles_num+1;?>
                     <tr>
                        <td><?=$articles_num;?></td>
                        <td><?=$articles_row['CategoryName'];?></td>
                        <td><?=$articles_row['ArticleName'].'('.$articles_row['ArticleCode'];?>)</td>
                        <td><i class="fa fa-edit fa-lg" data-toggle="modal" data-target="#exampleModal_update" onclick="update_article(<?=$articles_row['ArticleCode'];?>);" style="color:#a62532;"></i></td>
                     </tr>
                     <?php 
                        }
                                   ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
<div class="modal fade" id="exampleModal_update" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
   <div class="modal-dialog" role="document" >
      <div class="modal-content"  >
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Update Articles </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form action="action.php" method="post">
            <input type="hidden" name="code" value="18">
            <div class="modal-body" id="update_article">
               
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               <button type="submit" class="btn btn-primary">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>

    <?php include "footer.php";  ?>