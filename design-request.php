<?php 
  include "header.php";   
?>

<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            <div class="card-body" style="">
                <div class=" bg-gradient-dark" style="padding-left:20px;"><b>Officer Information</b></div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label >Employee ID</label>
                    <div class="input-group">
                                                <input type="number" class="form-control" id="userId"
                                                    placeholder="Employee ID"
                                                    aria-describedby="button-addon2">
                                                <button class="btn btn-info btn-sm" type="button" id="button-addon2"
                                                    onclick="searchUser()"><i class="fa fa-search"></i></button>
                                            </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label>Officer Name</label>
                        <input type="text" id="EmpName" class="form-control" readonly>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label>College Name</label>
                        <input type="text" id="CollegeName" class="form-control" readonly>
                    </div>
                </div>
                <br>
                <div class=" bg-gradient-dark" style="padding-left:20px;"><b>Project Information</b></div>
                <div class="row">

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Project Title</label>
                        <textarea id="ProjectTitle" class="form-control"></textarea>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Project Description</label>
                        <textarea id="ProjectDescription" class="form-control"></textarea>
                    </div>

                </div>
                <br>
                <div class=" bg-gradient-dark" style="padding-left:20px;"><b>Design Information</b></div>
                <div class="row">

                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <label>Design Type</label>
                        <select name="" id="DesignType" class="form-control">
                            <option value="Poster">Poster</option>
                            <option value="Banner">Banner</option>
                            <option value="SMM Post">SMM Post</option>
                            <option value="Brochures">Brochures</option>
                            <option value="other">other</option>
                        </select>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <label>Design Specification</label>
                        <div class="row">
                            <div class="col-lg-1 col-md-1 col-sm-12"><label style='float:right'>L:</label></div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <input type="text" id="LSize" class="form-control">
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12"><label style='float:right'>W:</label></div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <input type="text" id="WSize" class="form-control">
                            </div>
                            <div class="col-lg-1 col-md-1 col-sm-12"><label style='float:right'>H:</label></div>
                            <div class="col-lg-3 col-md-3 col-sm-12">
                                <input type="text"  id="HSize" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-12">
                        <label>Quantity</label>
                        <input type="text" name="" id="Quantity" class="form-control">
                    </div>

                </div>
                <br>
                <div class=" bg-gradient-dark" style="padding-left:20px;"><b>Priority (Please tick)</b></div>
                <br>
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="Normal">
                                <label for="checkboxPrimary1">
                                </label>
                            </div>

                            <div class="icheck-primary d-inline">

                                <label for="checkboxPrimary3">
                                    Normal
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">

                                <label for="checkboxPrimary3">
                                    ( More than Five days)
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="Rush">
                                <label for="checkboxPrimary1">
                                </label>
                            </div>

                            <div class="icheck-primary d-inline">

                                <label for="checkboxPrimary3">
                                    Rush
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">

                                <label for="checkboxPrimary3">
                                    (3-5 days)
                                </label>
                            </div>
                        </div>
                        <div class="form-group clearfix">
                            <div class="icheck-primary d-inline">
                                <input type="checkbox" id="Urgent">
                                <label for="checkboxPrimary1">
                                </label>
                            </div>

                            <div class="icheck-primary d-inline">

                                <label for="checkboxPrimary3">
                                    Urgent
                                </label>
                            </div>
                            <div class="icheck-primary d-inline">

                                <label for="checkboxPrimary3">
                                    (Less than 3 days)
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" onclick="submitReuest();">Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>
<p id="ajax-loader"></p>
<?php   include "footer.php";   ;?>
<script>

    
function searchUser() {
    var userId = document.getElementById('userId').value;
    // alert(userId);
    var code = '370';
    $.ajax({
        url: 'action.php',
        data: {
            code: code,
            userId: userId
        },
        type: 'POST',
        success: function(data) {
            var Array=JSON.parse(data)
            if (data != "") {
              document.getElementById('EmpName').value=Array[0];
              document.getElementById('CollegeName').value=Array[1];
            }
        }
    });
}

function submitReuest() {

EmpName=document.getElementById('EmpName').value;
CollegeName=document.getElementById('CollegeName').value;
ProjectTitle=document.getElementById('ProjectTitle').value;
ProjectDescription=document.getElementById('ProjectDescription').value;
DesignType=document.getElementById('DesignType').value;
LSize=document.getElementById('LSize').value;
WSize=document.getElementById('WSize').value;
HSize=document.getElementById('HSize').value;
Quantity=document.getElementById('Quantity').value;
Normal=document.getElementById('Normal').value;
Rush=document.getElementById('Rush').value;
Urgent=document.getElementById('Urgent').value;

    if (userId === '') {
        ErrorToast('Please select a userId', 'bg-warning');
        return;
    }
    if (EmpName === '') {
        ErrorToast('Please select a EmpName', 'bg-warning');
        return;
    }
    if (CollegeName === '') {
        ErrorToast('Please enter a CollegeName', 'bg-warning');
        return;
    }
    if (ProjectTitle === '') {
        ErrorToast('Please Enter a ProjectTitle', 'bg-warning');
        return;
    }
    if (ProjectDescription === '') {
        ErrorToast('Please Enter a ProjectDescription', 'bg-warning');
        return;
    }
    if (DesignType === '') {

        ErrorToast('Please enter a DesignType', 'bg-warning');
        return;
    }
    if (LSize === '') {
        ErrorToast('Please select a LSize', 'bg-warning');
        return;
    }
    if (WSize === '') {
        ErrorToast('Please select a WSize', 'bg-warning');
        return;
    }
    if (HSize === '') {
        ErrorToast('Please select a HSize', 'bg-warning');
        return;
    }
    if (Quantity === '') {
        ErrorToast('Please select a Quantity', 'bg-warning');
        return;
    }
    var spinner = document.getElementById('ajax-loader');
    spinner.style.display = 'block';
    var code = 402;
    $.ajax({
        url: 'action_g.php',
        data: {
            userId:userId,
            EmpName:EmpName,
            CollegeName:CollegeName,
            ProjectTitle:ProjectTitle,
            ProjectDescription:ProjectDescription,
            DesignType:DesignType,
            LSize:LSize,
            WSize:WSize,
            HSize:HSize,
            Quantity:Quantity,
            Normal:Normal,
            Rush:Rush,
            Urgent:Urgent,
            code: code
        },
        type: 'POST',
        success: function(response) {
            console.log(response);
            spinner.style.display = 'none';
            if (response == 1) {
                SuccessToast('Success ');
            } else {
                document.getElementById('EmpName').value = "";
                document.getElementById('CollegeName').value = "";
                document.getElementById('userId').value = "";
              
            }
        }
    });
}
</script>
</body>

</html>