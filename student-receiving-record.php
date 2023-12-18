   
<?php
    ini_set('max_execution_time', '0');
    session_start();
      include '../DB_connection/connection.php';
  
    ?>
<!DOCTYPE html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <link  rel="stylesheet"  href="../css/bootstrap.css" >
    <link rel="stylesheet" href="../css/bootstrap.min.css" >
    <link rel="stylesheet" href="../css/bootstrap-theme.min.css" >
    <link  rel="stylesheet" href="../css/style.css" >
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css">
    <script>
        //edit student 
        
        
        function edit_stu(id) 
        {   
        
        var code=3;
        var xmlhttp = new XMLHttpRequest();
           xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("edit_stu").innerHTML=xmlhttp.responseText;
               }
           }
        xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
           xmlhttp.send();
        }
    </script>
    <script>
        //edit student 
        
        
        function edit_stu1(id) 
        { 
        
        var code=3;
        var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState==4 && xmlhttp.status==200)
            {
                document.getElementById("edit_stu1").innerHTML=xmlhttp.responseText;
              }
          }
        xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
          xmlhttp.send();
        }
    </script>
    <script>
        function delete_stu(id) 
        {
            var code=2;
            var r = confirm("Do you really want to Delete");
            if(r == true) 
            {
                window.location.href ="get_action.php?id=" + id+"&code="+code;
            } 
            else 
            {
                return;
            }
        }
    </script>
</head>
<title>Guru Kashi University</title>
<body>
    <div class="container-fluid">
        <?php
            include '../header.php';
            
            
            
            ?>
        <style>
            .my
            {
            background-color: #fff;
            color: #fc3;
            }
            input[type=radio] + label {
            background-color: #fff;
            color: #000;
            } 
            input[type=radio]:checked + label {
            color: #002147;
            background-color:#fc3;
            } 
        </style>
 
    <div class="modal-body">
                <div class="row">
                    <div class="col-lg-2">
                        <form action="student-exam-report.php" method="post" target="_blank">
                            <?php  
                                if($a=='131053'||$a=='121031'||$a=='121024'||$a=='121009'||$a=='170976'||$a=='105295') 
                                 { ?>
                            <!-- <div class="form-group"> -->
                                <label>College</label>
                                <select class="form-control" id="college1" name="college" required>
                                    <option value="">Select College</option>
                                    <?php 
                                        $rresult = "SELECT DISTINCT CollegeName,CollegeID FROM MasterCourseCodes";
                                        
                                        $result= sqlsrv_query($conn,$rresult);
                                        
                                        if($result === false) {
                                        
                                        die( print_r( sqlsrv_errors(), true) );
                                        
                                        }
                                        
                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                                        {
                                        ?>
                                    <option value="<?php echo $row['CollegeID']; ?>"><?php echo $row['CollegeName']; ?>
                                    </option>
                                    <?php 
                                        }
                                        ?>
                                </select> </div><div class="col-lg-2">                       <!--   </div> -->
                           <!--  <div class="form-group"> -->
                                <label>Course</label>
                                <select name="course" id="course1" class="form-control">
                                    <option value="MCA">Select Course</option>
                                </select>
                            </div>
                            <?php } 
                                ?>                
                   <!--  </div> -->
                    <div class="col-lg-2">
                    <div class="form-group">
                    <label>Batch</label>
                    <select class="form-control" name="yoa" >
                    <option value="">Select Batch</option>
                   <?php 
                                        $rresult = "SELECT DISTINCT Batch FROM Admissions";
                                        
                                        $result= sqlsrv_query($conn,$rresult);
                                        
                                        if($result === false) {
                                        
                                        die( print_r( sqlsrv_errors(), true) );
                                        
                                        }
                                        
                                        while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                                        {
                                        ?>
                                    <option value="<?php echo $row['Batch']; ?>"><?php echo $row['Batch']; ?>
                                    </option>
                                    <?php 
                                        }
                                        ?>
                    </select>
                    </div>
                    </div>
                    <div class="col-lg-2">
                    	<label>Number of Semester</label>
                    	<select class="form-control" name="no_sem">
                    		<option>Select</option>
                    		<?php for($i=1;$i<=10;$i++)
                    		{?>

                    			<option value="<?=$i;?>"><?=$i;?></option>
                    		<?php } ?>
                    	</select>
                    </div>
                    <div class="col-lg-2">
                    	<label>Action</label><br>
                <input type="submit" name="search_new" class="btn btn-info" value="Search">
                </div>
            </form>
            </div>
               </div>
               </div></div>        
 <?php include'../footer.php';?>
    <script src="../js/jquery.min.js" type="text/javascript"></script>
    <script src="../js/bootstrap.min.js" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
           $('#example').DataTable();
        } );
    </script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>

            <script>
    $(function() { 
     $("#college1").change(function(e) {
       e.preventDefault();
       var code='10121';
       var college = $("#college1").val();
       alert(college);
           $.ajax({
           url:'action.php',
           data:{college:college,code:code},
           type:'POST',
           success:function(data){
            console.log(data);
               if(data != "")
               {
                   $("#course1").html("");
                   $("#course1").html(data);
               }
           }
         });
    });
    });
</script>