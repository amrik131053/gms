<?php  include "header.php";  ?>
<style type="text/css">
  h5{
    color: black;
    text-decoration: bold;
  }
</style>
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
             
 <section class="content">
   <div class="container-fluid">
      <!-- SELECT2 EXAMPLE -->
      <div class="card card-default">
         <div class="card-header">
            <center><h3 >Staff Appraisal</h3></center>
     
       </div>
         <!-- /.c
          ard-header -->
         <div class="card-body">

   <div class="col-md-12" style="text-align: center;">
               <label><b style="color:red;text-align: center"> 1<sup>st</sup> August 2022 to 30<sup>th</sup> July 2023 </b></label>

               <br>
              <b style="color:red;text-align: center"> if you want to add more than one records than separated by ,  for instance   (title of paper1 &nbsp;,&nbsp;title of paper2) </b>
         </div>
         <hr>
 <div class="row">
                 <div class="col-md-2">
                  <label>Employment Category <b style="color:red;">*</b></label>
                </div>
                <div class="col-md-2">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary15"  onclick="emc1_show();" value="Teaching" name="empc1">
                        <label for="radioPrimary15">
                         Teaching
                        </label>
                      </div>
                </div>
                 <div class="col-md-2">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimary16" onclick="emc1_hide();"  value="Non-Teaching" name="empc1">
                        <label for="radioPrimary16">
                         Non Teaching
                        </label>
                      </div>
                </div>

                  <div class="col-md-6" style="display: none;" id="lect_div">

                    <div class="row ">
             
                 <div class="col-md-4">
                    <label>Weekly Teaching Load <b style="color:red;">*</b></label>
                   </div>
                  <div class="col-md-3"><!-- /.form-group -->
                  <div class="form-group">
                     
                     <input type="number" id='nooflecture' name="" class="form-control">
                  </div>
                  <!-- /.form-group -->
               </div>
                </div> 
              </div>

      </div>         

<script>
    function emc1_show() {
  var x = document.getElementById("lect_div");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
           function emc1_hide() {
  var x = document.getElementById("lect_div");
 
    x.style.display = "none";
  }


</script>

<hr>
 <div class="row">



  
              
                 <div class="col-md-2">
               <label>Book Published <b style="color:red;">*</b></label>
               
                     
                   
                </div>
                  <div class="col-md-1">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryb15"  onclick="book_show();" value="bookyes" name="book">
                        <label for="radioPrimaryb15">
                       Yes
                        </label>
                      </div>
                </div>
                 <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryb16" onclick="book_hide();" value="bookno" name="book">
                        <label for="radioPrimaryb16">
                       No
                        </label>
                      </div>
                </div>
                <div class="col-md-1">
                     <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryb17" onclick="book_hide();" book="bookna" name="book">
                        <label for="radioPrimaryb17">
                      NA
                        </label>
                      </div>
                </div>
               
 
              <div class="col-lg-7" style="display: none;" id="book_div" >
                 <div class="row ">
             
                 <div class="col-md-2">
                  <!-- /.form-group -->
                  <div class="form-group">
                     <label>No of Books</label>
                     <input type="number" name="" id="noofbooks" class="form-control">
                  </div>
                  <!-- /.form-group -->
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Name of Books </label>
                     <input type="text" name=""  id="nameofbook" class="form-control">
                  </div>
               </div> 
                <div class="col-md-3">
                  <!-- /.form-group -->
                  <div class="form-group">
                     <label>ISBN</label>
                     <input type="text" name=""  id ="isbn" class="form-control">
                  </div>
                  <!-- /.form-group -->
               </div>
            
            </div> 
</div>
                 
  </div>

<script>


    function book_show() 
    {
  
 
      var x = document.getElementById("book_div"); 

  
    x.style.display = "block";
  
}  

  function book_hide(book) 
    {
  //var book1 = document.getElementById("bookp").value();
      var x = document.getElementById("book_div"); 


    x.style.display = "none";
  }



 </script>

<hr>




 <div class="row">



  
              
                 <div class="col-md-2">
              
   


                     <label>Research Paper Published <b style="color:red;">*</b></label>
                  
                </div>
 <div class="col-md-1">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryr15"  onclick="research_show();" name="research">
                        <label for="radioPrimaryr15">
                       Yes
                        </label>
                      </div>
                </div>
                 <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryr16" onclick="research_hide();" name="research">
                        <label for="radioPrimaryr16"> 
                       No
                        </label>
                      </div>
                </div>
                <div class="col-md-1">
                     <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryr17" onclick="research_hide();" name="research">
                        <label for="radioPrimaryr17">
                      NA
                        </label>
                      </div>
                </div>
               
               
 
              <div class="col-lg-9" style="display: none;" id="research_div" >
                 <div class="row ">
             <div class="col-md-2">
                  <!-- /.form-group -->
                  <div class="form-group">
                     <label>Number of Paper</label>
                     <input type="number" name="" class="form-control">
                  </div>
                </div>
                 <div class="col-md-3">
                  <!-- /.form-group -->
                  <div class="form-group">
                     <label>Title of Paper</label>
                  <textarea  name="" class="form-control"></textarea>
                   
                  </div>
                  <!-- /.form-group -->
               </div>
               <div class="col-md-4">
                  <div class="form-group">
                     <label>Name of Journal</label>
                           <textarea  name="" class="form-control"></textarea>
                  </div>
               </div> 
                 <div class="col-md-2">
                  <div class="form-group">
                     <label>Publication Index</label>
                           <textarea  name="" class="form-control"></textarea>
                  </div>
               </div> 
            
            </div> 
</div>
                 
  </div>
   
<script>


    function research_show() 
   {

      var x = document.getElementById("research_div"); 

    x.style.display = "block";
 
}

   function research_hide() 
   
  {
      var x = document.getElementById("research_div"); 

    x.style.display = "none";
 
}


 </script>


<hr>




 <div class="row">
                 <div class="col-md-2">
                  <label>Consultancy<b style="color:red;">*</b></label>
                </div>
                <div class="col-md-2">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryc"  onclick="con_show();" name="con">
                        <label for="radioPrimaryc">
                         Yes
                        </label>
                      </div>
                </div>
                 <div class="col-md-2">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryc1" onclick="con_hide();" name="con">
                        <label for="radioPrimaryc1">
                        No
                        </label>
                      </div>
                </div>

                  <div class="col-md-6" style="display: none;" id="con_div">

                    <div class="row ">
             
                 <div class="col-md-4">
                    <label>Amount <b style="color:red;">*</b></label>
                   </div>
                  <div class="col-md-3"><!-- /.form-group -->
                  <div class="form-group">
                     
                     <input type="number" name="" class="form-control">
                  </div>
                  <!-- /.form-group -->
               </div>
                </div> 
              </div>

      </div>         

<script>
    function con_show() {
  var x = document.getElementById("con_div");
 
    x.style.display = "block";

}
           function con_hide() {
  var x = document.getElementById("con_div");
 
    x.style.display = "none";
  }


</script>

<hr>







 <div class="row">
                 <div class="col-md-2">
                  <label>Admission Initiative<b style="color:red;">*</b></label>
                </div>
                <div class="col-md-1">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryadm"  onclick="adm_show();" name="adm">
                        <label for="radioPrimaryadm">
                         Yes
                        </label>
                      </div>
                </div>
                 <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryadm1" onclick="adm_hide();" name="adm">
                        <label for="radioPrimaryadm1">
                        No
                        </label>
                      </div>
                </div>

                  <div class="col-md-6" style="display: none;" id="adm_div">

                    <div class="row ">
             
                 <div class="col-md-4">
                    <label>No of Admission<b style="color:red;">*</b></label>
                      <input type="number" name="" class="form-control">
                   </div>

                   <div class="col-md-6">
                    <label>No of Admission without consultancy<b style="color:red;">*</b></label>
                      <input type="number" name="" class="form-control">
                   </div>
               
                </div> 
              </div>

      </div>         

<script>
    function adm_show() {
  var x = document.getElementById("adm_div");
 
    x.style.display = "block";

}
           function adm_hide() {
  var x = document.getElementById("adm_div");
 
    x.style.display = "none";
  }


</script>

<hr>





 <div class="row">
                 <div class="col-md-2">
                  <label>Patent<b style="color:red;">*</b></label>
                </div>
                <div class="col-md-1">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimarypt"  onclick="patent_show();" name="pt">
                        <label for="radioPrimarypt">
                         Yes
                        </label>
                      </div>
                </div>
                 <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimarypt1" onclick="patent_hide();" name="pt">
                        <label for="radioPrimarypt1">
                        No
                        </label>
                      </div>
                </div>
                 <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimarypt3" onclick="patent_hide();" name="pt">
                        <label for="radioPrimarypt3">
                        NA
                        </label>
                      </div>
                </div>

                  <div class="col-md-6" style="display: none;" id="patent_div">

                    <div class="row ">
             
                 <div class="col-md-2">
                    <label>Detail<b style="color:red;">*</b></label>
                   </div>
                  <div class="col-md-8"><!-- /.form-group -->
                  <div class="form-group">
                     
                     <textarea  name="" class="form-control"></textarea>
                  </div>
                  <!-- /.form-group -->
               </div>
                </div> 
              </div>

      </div>         

<script>
    function patent_show() {
  var x = document.getElementById("patent_div");
 
    x.style.display = "block";

}
           function patent_hide() {
  var x = document.getElementById("patent_div");
 
    x.style.display = "none";
  }


</script>

<hr>


 <div class="row">
                 <div class="col-md-2">
                  <label>Ph.D Candidate Supervised<b style="color:red;">*</b></label>
                </div>
                <div class="col-md-1">
                 <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryphd"  onclick="phd_show();" name="phd">
                        <label for="radioPrimaryphd">
                         Yes
                        </label>
                      </div>
                </div>
                 <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryphd1" onclick="phd_hide();" name="phd">
                        <label for="radioPrimaryphd1">
                        No
                        </label>
                      </div>
                </div>
                <div class="col-md-1">
                  <div class="icheck-primary d-inline">
                        <input type="radio" id="radioPrimaryphd3" onclick="phd_hide();" name="phd">
                        <label for="radioPrimaryphd3">
                      NA
                        </label>
                      </div>
                </div>

                  <div class="col-md-6" style="display: none;" id="phd_div">

                    <div class="row ">
             
                 <div class="col-md-2">
                    <label>No of  candidate<b style="color:red;">*</b></label>
                   </div>
                  <div class="col-md-8"><!-- /.form-group -->
                  <div class="form-group">
                     
                       <input type="number" name="" class="form-control">
                  </div>
                  <!-- /.form-group -->
               </div>
                </div> 
              </div>

      </div>         

<script>
    function phd_show() {
  var x = document.getElementById("phd_div");
 
    x.style.display = "block";

}
           function phd_hide() {
  var x = document.getElementById("phd_div");
 
    x.style.display = "none";
  }


</script>

<hr>



<div class="row">
<div class="col-xl-12">
  <label>Other Duties /task performed by you<b style="color:red;">*</b></label>
  <textarea class="form-control"></textarea>
</div>
</div>
<hr>
<div class="row">
<div class="col-xl-12" style="text-align: center;">
 <button class="btn btn-success" onclick="save_report()">Submit</button>
  
</div>
</div>

<script>
  function save_report()
          {
       var code=288;
  var emp = document.querySelector('input[type=radio][name=empc1]:checked');
  var nooflecture=document.getElementById('nooflecture').value;

    var book = document.querySelector('input[type=radio][name=book]:checked');
    // var noofbooks=document.getElementById('noofbooks').value;
    // var nameofbooks=document.getElementById('nameofbooks').value;
    // var isbn=document.getElementById('isbn').value;

 var con = document.querySelector('input[type=radio][name=con]:checked');
  var nooflecture=document.getElementById('nooflecture').value;


alert(con.value);
if(emp=='Teaching' && nooflecture!='')
{

}
else if(book=='bookyes' &&noofbooks!=''&& nameofbooks!==''&&isbn!='')
{
alert("bokks detail");
}
    






// if(selectValue.value!='Non-Teaching' )

//     {  t=1;
//       var nooflecture=document.getElementById('nooflecture').value;
//     }

// if(t==1 && nooflecture!='')
// {

// }
// else
// {
//   alert("no of lecture required");
// }



         // var spinner=document.getElementById('ajax-loader');
         // spinner.style.display='block';
         // $.ajax({
         //    url:'action.php',
         //    type:'POST',
         //    data:{
         //       code:code,id:id
         //          },
         //    success: function(response) 
         //    {
         //          pending();
         //       spinner.style.display='none';
         //       document.getElementById("table_load").innerHTML=response;
         //    }
         // });

     }


</script>









     
            </div>


         </div>
         <!-- /.card-body -->
         <div class="card-footer">
           
         </div>
      </div>
      <!-- /.card -->
      <!-- SELECT2 EXAMPLE -->
      <!-- /.row -->
   </div>
   <!-- /.container-fluid -->
</section>
 
<?php  include "footer.php";  ?>

