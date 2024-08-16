<?php 
   include "header.php";   
   ?>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- left column -->
            <!-- Button trigger modal -->
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="card card-info">
                    <div class="card-header ">

<h5>Book Search</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-group row">
                            <!-- <div class="col-lg-2 col-md-2 col-sm-12">

                                <div class="form-group">
                                    <label for="collegeName">College Name</label>
                                    <input class="form-control" type="text" id="collegeName" name="collegeName"
                                        value="Guru Kashi University" readonly>
                                </div>
                            </div> -->
                            <div class="col-lg-2 col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="sortBy">Sort By</label>
                                    <select class="form-control" id="sortBy" name="sortBy">
                                        <option value="all">All</option>
                                        <option value="issued">Issued</option>
                                        <option value="unissued">UnIssued</option>
                                    </select>
                                </div>

                            </div>

                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <div class="form-group">
                                    <label for="searchType">Search By</label>
                                    <select class="form-control" id="searchType" name="searchType"
                                        onchange="updateTextBox()">
           <option value="" selected="selected">Select</option>
           <option value="Title">Title</option>
                                        <option value="AccessionNo">AccessionNo</option>
                                        <option value="Author">Author</option>
                                        <option value="Edition" >Edition</option>
                                        <option value="Publisher">Publisher</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <div class="form-group">
                                    <label for="searchValue">Search Value</label>
                                    <input class="form-control" type="text" id="searchValue" name="searchValue"
                                        placeholder="Enter Edition">
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-2 col-sm-13">
                                <div class="form-group">
                                    <label for="searchValue">Action</label><br>
                                   <button class="btn btn-success" onclick="search();" >Search</button>
                                </div>
                            </div>

                        </div>
                        <div class="table table-responsive" id="show_record"></div>
                    </div>

                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->

            </div>


            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
</section>
<p id="ajax-loader"></p>

<!-- Modal -->

<script>
function updateTextBox() {
    var searchType = document.getElementById("searchType").value;
    var textBox = document.getElementById("searchValue");

    // Update placeholder text based on selected search type
    switch (searchType) {
        case "Edition":
            textBox.placeholder = "Enter Edition";
            break;
        case "Title":
            textBox.placeholder = "Enter Title";
            break;
        case "AccessionNo":
            textBox.placeholder = "Enter Accession Number";
            break;
        case "Author":
            textBox.placeholder = "Enter Author";
            break;
        case "Publisher":
            textBox.placeholder = "Enter Publisher";
            break;
        default:
            textBox.placeholder = "Enter Search Value";
            break;
    }
}


function search()
          {
            var sortBy=document.getElementById('sortBy').value;
            var searchType=document.getElementById('searchType').value;
            var searchValue=document.getElementById('searchValue').value;
              if (sortBy!='') 
            {
            var spinner=document.getElementById("ajax-loader");
               spinner.style.display='block';
           var code=462;
           $.ajax({
              url:'action_g.php',
              type:'POST',
              data:{
                 code:code,sortBy:sortBy,searchType:searchType,searchValue:searchValue
              },
              success: function(response) 
              {
                console.log(response);
                  spinner.style.display='none';
                 document.getElementById("show_record").innerHTML=response;
              }
           });
           }
         
          } 
</script>
<?php

 include "footer.php";  ?>