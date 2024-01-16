<?php 
  include "header.php";   
?>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12  col-sm-12 col-lg-12">
                <div class="card card-primary">
                    <div class="btn-group w-100 mb-2">
                        <a class="btn btn-primary btn11" id="btn1"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="newAdmission(),bg1(this.id);"> New Admission </a>
                        <a class="btn btn-primary btn11" id="btn2"
                            style="background-color:#223260; color: white; border: 5px solid;"
                            onclick="oldAdmission(),bg1(this.id);"> Old Admission  </a>
                    </div>
                    <div class="card-body" id="admissionForm" style="">


                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- /.col -->
</section>
<p id="ajax-loader"></p>

<?php   include "footer.php";   ;?>
<script>
$(window).on('load', function() {
    $('#btn1').toggleClass("bg-success");
    $('#btn3').toggleClass("bg-success");
    newAdmission();
})

function bg1(id) {
    $('.btn11').removeClass("bg-success");
    $('#' +id).toggleClass("bg-success");
}
function bg(id) {
    $('.btnG').removeClass("bg-success");
    $('#' +id).toggleClass("bg-success");
}

function newAdmission() 
{
    var code = 348;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("admissionForm").innerHTML = response;
        }
    });
}
function oldAdmission() 
{
    var code = 349;
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    $.ajax({
        url: 'action_g.php',
        type: 'POST',
        data: {
            code: code
        },
        success: function(response) {
            spinner.style.display = 'none';
            document.getElementById("admissionForm").innerHTML = response;
        }
    });
}

function fetchCollege() {
    var Session = document.getElementById('Session').value;
    var code = 350;
    $.ajax({
        url: 'action_g.php',
        data: {
            Session: Session,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {
                $("#CollegeID").html("");
                $("#CollegeID").html(data);
                document.getElementById('Batch').value="";
                clearFeeDetails();
            }
        }
    });
}
function fetchcourse() {
    var College = document.getElementById('CollegeID').value;
    var Session = document.getElementById('Session').value;
    var code = 351;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Session: Session,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
            if (data != "") {
                $("#Course").html("");
                $("#Course").html(data);
                document.getElementById('Batch').value="";
                clearFeeDetails();
            }
        }
    });
}
function fatchBatch() {
    var College = document.getElementById('CollegeID').value;
    var Course = document.getElementById('Course').value;
    var Session = document.getElementById('Session').value;
    var LateralEntry = document.getElementById('LateralEntry').value;
    var code = 352;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Course: Course,
            Session: Session,
            LateralEntry: LateralEntry,
            code: code
        },
        type: 'POST',
        success: function(data) {
            // console.log(data);
          
               
            document.getElementById('Batch').value=data;
            // fatchRollNo();
            
        }
    });
}
function getOnChnageDetails() {
    var refrene =  document.getElementById('refvalue').value;
    var id = document.getElementById('EmID'+refrene).value;
//    alert(id);
    var code = 354;
    $.ajax({
        url: 'action_g.php',
        data: {
            refrene: refrene,
            id: id,
            code: code
        },
        type: 'POST',
        success: function(response) {
            // console.log(response);
            var data = JSON.parse(response);
                document.getElementById("RefName").value = data[0];
                document.getElementById("RefContact").value = data[1];
                document.getElementById("RefAddress").value = data[2];
                


            
        }
    });
}
function clearFeeDetails() {
    document.getElementById("SemesterForFee").value = "";
    document.getElementById("feeparticulr").value = "";
    document.getElementById("feeTotalDebit").value = "";
    document.getElementById("LateralEntry").value = "";
    document.getElementById("feeDetailTable").innerHTML = "";
}
function getFeeDetails() {
    var SemesterForFee = document.getElementById('SemesterForFee').value;
    var College = document.getElementById('CollegeID').value;
    var Course = document.getElementById('Course').value;
    var Session = document.getElementById('Session').value;
    var LateralEntry = document.getElementById('LateralEntry').value;
    var FeeCategory = document.getElementById('feecategory').value;
    var Batch = document.getElementById('Batch').value;

   
    if (College === '') {
        ErrorToast('Please select a College','bg-warning');
        return;
    }
    if (Course === '') {
        ErrorToast('Please select a Course','bg-warning');
        return;
    }
    if (LateralEntry === '') {
        ErrorToast('Please select Lateral Entry status','bg-warning');
        return;
    }
    if (FeeCategory === '') {
        ErrorToast('Please select a Fee Category','bg-warning');
        return;
    }
    if (SemesterForFee === '') {
        ErrorToast('Please select a Semester','bg-warning');
        return;
    }
    var code = 355;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Course: Course,
            Session: Session,
            LateralEntry: LateralEntry,
            FeeCategory: FeeCategory,
            Batch: Batch,
            SemesterForFee: SemesterForFee,
            code: code
        },
        type: 'POST',
        success: function(response) {
            // console.log(response);
            var data = JSON.parse(response);
            document.getElementById("feeparticulr").value = data[0];
            document.getElementById("feeTotalDebit").value = data[1];
            getFeeDetailsTable();
        }
    });
}
function getFeeDetailsTable() {
    var SemesterForFee = document.getElementById('SemesterForFee').value;
    var College = document.getElementById('CollegeID').value;
    var Course = document.getElementById('Course').value;
    var Session = document.getElementById('Session').value;
    var LateralEntry = document.getElementById('LateralEntry').value;
    var FeeCategory = document.getElementById('feecategory').value;
    var Batch = document.getElementById('Batch').value;

    var code = 356;
    $.ajax({
        url: 'action_g.php',
        data: {
            College: College,
            Course: Course,
            Session: Session,
            LateralEntry: LateralEntry,
            FeeCategory: FeeCategory,
            Batch: Batch,
            SemesterForFee: SemesterForFee,
            code: code
        },
        type: 'POST',
        success: function(response) {
            // console.log(response);
           
            document.getElementById("feeDetailTable").innerHTML = response;
            
        }
    });
}



function adharPassChnage(id)
{
   // alert(id);
   if (id=='Indian')
    {
   $('#AdharCard').show();
   $('#IDNoNationlity').hide();
   document.getElementById('IDNoNationlity').value="";
    }
    else if(id=='NRI')
    {
   $('#PassportNo').show();
    $('#AdharCard').hide();
    $('#IDNoNationlity').hide();
    document.getElementById('IDNoNationlity').value="";
    document.getElementById('AdharCardNo').value="";
document.getElementById('PassportNumber').value="";
document.getElementById('IDNumber').value="";
    
}
else if(id=='Nepal')
{
    $('#IDNoNationlity').show();
    $('#AdharCard').hide();
    document.getElementById('AdharCardNo').value="";
    document.getElementById('PassportNumber').value="";
    
}
else if(id=='Bhutan')
{
    $('#IDNoNationlity').show();
    $('#AdharCard').hide();
    document.getElementById('AdharCardNo').value="";
    document.getElementById('PassportNumber').value="";
    
}

}
function onchnagereff(ref) {
    // alert(ref);
    document.getElementById('refvalue').value=ref;
    document.getElementById('EmID'+ref).value="";
                document.getElementById("RefName").value="";
                document.getElementById("RefContact").value="";
                document.getElementById("RefAddress").value="";
    if(ref=='Staff')
    {

        $('#accordingToReffStaff').show();
        $('#accordingToReffStudent').hide();
        $('#accordingToReffConsoultant').hide();
        $('#accordingToReffTeam').hide();
       
    }
    else if(ref=='Student')
    {
        $('#accordingToReffStudent').show();
        $('#accordingToReffStaff').hide();
        $('#accordingToReffConsoultant').hide();
        $('#accordingToReffTeam').hide();
       
    }
    else if(ref=='Consultant')
    {
        $('#accordingToReffConsoultant').show();
        $('#accordingToReffStaff').hide();
        $('#accordingToReffStudent').hide();
        $('#accordingToReffTeam').hide();
      

    }
    else{
        $('#accordingToReffTeam').show();
        $('#accordingToReffConsoultant').hide();
        $('#accordingToReffStaff').hide();
        $('#accordingToReffStudent').hide();
       
    }


}
function submitNewAdmissions() 
{
    var Nationality=document.getElementById('Nationality').value;
    if (Nationality=='Indian')
    {
        var idproof=document.getElementById('AdharCardNo').value;
    }
else if(Nationality=='NRI')
    {
   var idproof=document.getElementById('PassportNumber').value;
}
else if(Nationality=='Nepal')
{
    var idproof=document.getElementById('IDNumber').value;
}
else if(Nationality=='Bhutan')
{
    var idproof=document.getElementById('IDNumber').value;
}
var Name=document.getElementById('Name').value;
var FatherName=document.getElementById('FatherName').value;
var MobileNumber=document.getElementById('MobileNumber').value;



var Dob=document.getElementById('Dob').value;
var Gender=document.getElementById('Gender').value;
var category=document.getElementById('category').value;
var feecategory=document.getElementById('feecategory').value;
var scholaship=document.getElementById('scholaship').value;
var Session=document.getElementById('Session').value;
var CollegeID=document.getElementById('CollegeID').value;
var Course=document.getElementById('Course').value;
var LateralEntry=document.getElementById('LateralEntry').value;
var Batch=document.getElementById('Batch').value;
var Comments=document.getElementById('Comments').value;
var refvalue=document.getElementById('refvalue').value;
var EmIDTeam=document.getElementById('EmID'+refvalue).value;
var RefName=document.getElementById('RefName').value;
var RefContact=document.getElementById('RefContact').value;
var RefAddress=document.getElementById('RefAddress').value;
var SemesterForFee=document.getElementById('SemesterForFee').value;
var feeparticulr=document.getElementById('feeparticulr').value;
var feeTotalDebit=document.getElementById('feeTotalDebit').value;
// alert(EmIDTeam);
var code = 357;
    $.ajax({
        url: 'action_g.php',
        data: {
            Nationality:Nationality,
Name:Name,
FatherName:FatherName,
MobileNumber:MobileNumber,
idproof:idproof,
Dob:Dob,
Gender:Gender,
category:category,
feecategory:feecategory,
scholaship:scholaship,
Session:Session,
CollegeID:CollegeID,
Course:Course,
LateralEntry:LateralEntry,
Batch:Batch,
Comments:Comments,
refvalue:refvalue,
EmID:EmIDTeam,
RefName:RefName,
RefContact:RefContact,
RefAddress:RefAddress,
SemesterForFee:SemesterForFee,
feeparticulr:feeparticulr,
feeTotalDebit:feeTotalDebit,
            code: code
        },
        type: 'POST',
        success: function(response) {
            // console.log(response);
        
            if(response==2)
            {

            }
            else{
                var Name=document.getElementById('Name').value="";
                var FatherName=document.getElementById('FatherName').value="";
                var MobileNumber=document.getElementById('MobileNumber').value="";
                var Dob=document.getElementById('Dob').value="";

            }
            
            
        }
    });


}
</script>
</body>

</html>