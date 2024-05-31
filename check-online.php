<?php 
include "header.php";
?>
<style>

a.avatar-link{
    position: relative;
    display: inline-block;
}

.img-box img.user-avatar{
    border-radius: 50%;
    display: block;
}

.user-status {
    border-radius: 50%;
    height: 10px;
    position: absolute;
    right: -5px;
    bottom: 25px;
    width: 10px;
    background-color: green;
}

.img-box img.user-avatar[width="140"] + .user-status{
   right: 16px;
   bottom: 15px;
}

</style>
<p id="ajax-loader"></p>
<div class="container-fluid" >
  <div class="card-header">
  Total Active Users:<small id="countOnlineUsers"></small>
    
  </div>
<div class="card table-responsive" id="loadOnlineData" >

</div>
<script>
loadCheckOnlineData();
loadCountOnlineUsers();
setInterval(function(){ 
    loadCheckOnlineData();
 }, 60000);
function loadCheckOnlineData() {
    var spinner= document.getElementById("ajax-loader");
   spinner.style.display='block';
  var code=392;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code},
   success:function(res)
   {
    spinner.style.display='none';
    document.getElementById('loadOnlineData').innerHTML=res;
    loadCountOnlineUsers();
   }
  });
}
function sessionAlllogout(id) {
    var spinner = document.getElementById("ajax-loader");
      spinner.style.display = 'block';
  var code=390;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code,id:id},
   success:function(res)
   {
    spinner.style.display = 'none';
   }
  });
}

function loadCountOnlineUsers() {
  var code=393;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code},
   success:function(res)
   {
    document.getElementById('countOnlineUsers').innerHTML=res;
   }
  });
}

function verifiy_select()
{
        if(document.getElementById("select_all1").checked)
        {
            $('.v_check').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.v_check').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.v_check').on('click',function()
    {
        var a=document.getElementsByClassName("v_check:checked").length;
        var b=document.getElementsByClassName("v_check").length;
        
        if(a == b)
        {

            $('#select_all1').prop('checked',true);
        }
        else
        {
            $('#select_all1').prop('checked',false);
        }
    });
 
} 

function logoutAll()
{
  var verifiy=document.getElementsByClassName('v_check');
var len_student= verifiy.length; 
  var code=421;
  var subjectIDs=[];  
       
     for(i=0;i<len_student;i++)
     {
          if(verifiy[i].checked===true)
          {
            subjectIDs.push(verifiy[i].value);
          }
     }
  if((typeof  subjectIDs[0]== 'undefined'))
  {
    // alert('');
    ErrorToast(' Select atleast one Student' ,'bg-warning');
  }
  else
  {
         var spinner=document.getElementById("ajax-loader");
         spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{subjectIDs:subjectIDs,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            if (data==1) 
            {
                SuccessToast('Successfully logout');
            //    search_study_scheme();
            }
            else
            {
                ErrorToast(' try Again' ,'bg-danger');

            }
            }      
});
}
}

</script>
<?php 
include "footer.php";
?>