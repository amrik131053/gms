
function selectAll()
{
        if(document.getElementById("select_all").checked)
        {
            $('.checkbox').each(function()
            {
                this.checked = true;
            });
        }
        else 
        {
             $('.checkbox').each(function()
             {
                this.checked = false;
            });
        }
 
    $('.checkbox').on('click',function()
    {
        var a=document.getElementsByClassName("checkbox:checked").length;
        var b=document.getElementsByClassName("checkbox").length;
        
        if(a == b)
        {

            $('#select_all').prop('checked',true);
        }
        else
        {
            $('#select_all').prop('checked',false);
        }
    });
  
}



function Search_exam_student()
{

var code=40;
var College=document.getElementById("College").value;
var Course=document.getElementById("Course").value;
var Batch=document.getElementById("Batch").value;
var Semester=document.getElementById("Semester").value;
var Type=document.getElementById("Type").value;
var Group=document.getElementById("Group").value;
var Examination=document.getElementById("Examination").value;

 // if(Batch!='' && Semester!='' && College!=''&& Course!=''&&Type!=''&&Group!=''&&Examination!='')
 // {

 //x.style.display = "block";
var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
     
var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     

          //x.style.display = "none";
          spinner.style.display='none';
          document.getElementById("live_data_Exam_student").innerHTML=xmlhttp.responseText;
Examination_Subjects();
        }
    }

      xmlhttp.open("GET", "get_action.php?College="+College+"&Course="+Course+ "&Batch=" + Batch+ "&Semester=" + Semester+ "&Type=" + Type+"&Group="+Group+"&Examination="+Examination+"&code="+code,true);
        xmlhttp.send();


//  }
// else
// {
//   alert("Wrong Input");
// }






}


function Search_exam_student_open() 
{
 
var code=60;
var College=document.getElementById("College").value;
var Course=document.getElementById("Course").value;
var Batch=document.getElementById("Batch").value;
var Semester=document.getElementById("Semester").value;
var Type=document.getElementById("Type").value;
var Group=document.getElementById("Group").value;
var Examination=document.getElementById("Examination").value;


 // if(Batch!='' && Semester!='' && College!=''&& Course!=''&&Type!=''&&Group!=''&&Examination!='')
 // {

 //x.style.display = "block";
var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
     
var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     

          //x.style.display = "none";
          spinner.style.display='none';
          document.getElementById("live_data_Exam_student").innerHTML=xmlhttp.responseText;
Examination_Subjects_open();
        }
    }

      // xmlhttp.open("GET", "get_action.php?College="+College+"&Batch=" + Batch+"&code="+code,true);
      //   xmlhttp.send();
      xmlhttp.open("GET", "get_action.php?College="+College+"&Course="+Course+ "&Batch=" + Batch+ "&Semester=" + Semester+ "&Type=" + Type+"&Group="+Group+"&Examination="+Examination+"&code="+code,true);
      xmlhttp.send();


//  }
// else
// {
//   alert("Wrong Input");
// }






}

function Search_exam_student_pre() 
{

var code=65;
var College=document.getElementById("College").value;

var Batch=document.getElementById("Batch").value;


 // if(Batch!='' && Semester!='' && College!=''&& Course!=''&&Type!=''&&Group!=''&&Examination!='')
 // {

 //x.style.display = "block";
var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
     
var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     

          //x.style.display = "none";
          spinner.style.display='none';
          document.getElementById("live_data_Exam_student").innerHTML=xmlhttp.responseText;
Examination_Subjects_pre();
        }
    }

      xmlhttp.open("GET", "get_action.php?College="+College+"&Batch=" + Batch+"&code="+code,true);
        xmlhttp.send();


//  }
// else
// {
//   alert("Wrong Input");
// }






}

function Examination_Subjects(){
var code=41;

var College=document.getElementById("College").value;
var Course=document.getElementById("Course").value;
var Batch=document.getElementById("Batch").value;
var Semester=document.getElementById("Semester").value;
var Group=document.getElementById("Group").value;



var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     
     
 
          document.getElementById("live_data_Exam_subjects").innerHTML=xmlhttp.responseText;

        }
    }

      xmlhttp.open("GET", "get_action.php?College="+College+"&Course="+Course+ "&Batch=" + Batch+ "&Semester=" + Semester+ "&Group="+Group+"&code="+code,true);
        xmlhttp.send();


}
 
 function Examination_Subjects_open(){
var code=61;

var College=document.getElementById("College").value;
var Course=document.getElementById("Course").value;
var Batch=document.getElementById("Batch").value;
var Semester=document.getElementById("Semester").value;
var Group=document.getElementById("Group").value;
var Type=document.getElementById("Type").value


var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     
     
 
          document.getElementById("live_data_Exam_subjects").innerHTML=xmlhttp.responseText;

        }
    }

      xmlhttp.open("GET", "get_action.php?College="+College+"&Course="+Course+ "&Batch=" + Batch+ "&Semester=" + Semester+"&Type="+Type+"&Group="+Group+"&code="+code,true);
        xmlhttp.send();


}

 function Examination_Subjects_pre(){
var code=66;

var College=document.getElementById("College").value;
var Batch=document.getElementById("Batch").value;



var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
      if (xmlhttp.readyState==4 && xmlhttp.status==200)
      {     
     
 
          document.getElementById("live_data_Exam_subjects").innerHTML=xmlhttp.responseText;

        }
    }

      xmlhttp.open("GET", "get_action.php?College="+College+"&Batch=" + Batch+ "&code="+code,true);
        xmlhttp.send();


}




function courseByCollege(College) 
{  
    // alert(College);
var code='90';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
if(data != "")
{
   
$("#Course").html("");
$("#Course").html(data);
}
}
});

}
function courseByCollegeexam(College) 
{  
    // alert(College);
var code='90.1';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
if(data != "")
{
   
$("#Course").html("");
$("#Course").html(data);
}
}
});

}

function courseByCollege1(College) 
{  
    // alert(College);
var code='90';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
if(data != "")
{
    // console.log(data);
$("#Course1").html("");
$("#Course1").html(data);
}
}
});

}



function collegeByDepartment(College) 
{  
     
var code='304';
$.ajax({
url:'action.php',
data:{College:College,code:code},
type:'POST',
success:function(data){
if(data != "")
{
     
$("#Department").html("");
$("#Department").html(data);
}
}
});

}



function add_subject_examform()
{
var students=document.getElementsByClassName('checkbox');
var subjects=document.getElementsByClassName('newSubject');
var len_student= students.length; 
var len_subject= subjects.length;


  var code=101;
  var student_str=[];
  var subject_str=[];
    
    for(i=0;i<len_subject;i++)
     {
      if(subjects[i].checked===true)
       {
        subject_str.push(subjects[i].value);
        }
     }
       
     for(i=0;i<len_student;i++)
     {
          if(students[i].checked===true)
          {
            student_str.push(students[i].value);
          }
       }
     


  if((typeof  student_str[0]== 'undefined') || (typeof subject_str[0]== 'undefined') )
  {
    alert('Select atleast one student and subject to proceed');
  }else{
    var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
  $.ajax({
         url:'action.php',
         data:{students:student_str,subjects:subject_str,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
            // console.log(data);
            alert('Inserted Successfully.') 
                                }      
});
}
}

function add_subject_prerequite()
{
var students=document.getElementsByClassName('checkbox');
var subjects=document.getElementsByClassName('newSubject');
var len_student= students.length; 
var len_subject= subjects.length;


  var code=466;
  var student_str=[];
  var subject_str=[];
    
    for(i=0;i<len_subject;i++)
     {
      if(subjects[i].checked===true)
       {
        subject_str.push(subjects[i].value);
        }
     }
       
     for(i=0;i<len_student;i++)
     {
          if(students[i].checked===true)
          {
            student_str.push(students[i].value);
          }
       }
     


  if((typeof  student_str[0]== 'undefined') || (typeof subject_str[0]== 'undefined') )
  {
    alert('Select atleast one student and subject to proceed');
  }else{
    var spinner=document.getElementById("ajax-loader");
                                  spinner.style.display='block';
  $.ajax({
         url:'action_g.php',
         data:{students:student_str,subjects:subject_str,code:code},
         type:'POST',
         success:function(data) {
            spinner.style.display='none';
        
            SuccessToast('Inserted Successfully');
                                }      
});
}
}


function page_open(id)
{
    window.location='bulk_assign.php?ID='+id;
}


function myFunction() {
// Declare variables
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("myInput");
filter = input.value.toUpperCase();
table = document.getElementById("myTable");
tr = table.getElementsByTagName("tr");
// Loop through all table rows, and hide those who don't match the search query
for (i = 0; i < tr.length; i++) {
td = tr[i].getElementsByTagName("td")[0];
if (td) {
txtValue = td.textContent || td.innerText;
if (txtValue.toUpperCase().indexOf(filter) > -1) {
tr[i].style.display = "";
} else {
tr[i].style.display = "none";
}
}
}
}
function myFunction2() {
// Declare variables
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("myInput2");
filter = input.value.toUpperCase();
table = document.getElementById("myTable2");
tr = table.getElementsByTagName("tr");
// Loop through all table rows, and hide those who don't match the search query
for (i = 0; i < tr.length; i++) {
td = tr[i].getElementsByTagName("td")[0];
if (td) {
txtValue = td.textContent || td.innerText;
if (txtValue.toUpperCase().indexOf(filter) > -1) {
tr[i].style.display = "";
} else {
tr[i].style.display = "none";
}
}
}
}function myFunction3() {
// Declare variables
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("myInput3");
filter = input.value.toUpperCase();
table = document.getElementById("myTable3");
tr = table.getElementsByTagName("tr");
// Loop through all table rows, and hide those who don't match the search query
for (i = 0; i < tr.length; i++) {
td = tr[i].getElementsByTagName("td")[0];
if (td) {
txtValue = td.textContent || td.innerText;
if (txtValue.toUpperCase().indexOf(filter) > -1) {
tr[i].style.display = "";
} else {
tr[i].style.display = "none";
}
}
}
}
function myFunction4() {
// Declare variables
var input, filter, table, tr, td, i, txtValue;
input = document.getElementById("myInput4");
filter = input.value.toUpperCase();
table = document.getElementById("myTable4");
tr = table.getElementsByTagName("tr");
// Loop through all table rows, and hide those who don't match the search query
for (i = 0; i < tr.length; i++) {
td = tr[i].getElementsByTagName("td")[0];
if (td) {
txtValue = td.textContent || td.innerText;
if (txtValue.toUpperCase().indexOf(filter) > -1) {
tr[i].style.display = "";
} else {
tr[i].style.display = "none";
}
}
}
}
//-------------------------------- ajax -----------------------------------
function gg(id){
var code=4;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_actions.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}



$(document).ready(function() {
$('#example').DataTable();
} );

$(document).ready(function() {
$('#example1').DataTable();
} );
function category_insert()
{
// var id=id1;
var CategoryName= document.getElementById("CategoryName").value;
//alert(CategoryName);
var code=1;
$.ajax({
url:"action.php ",
type:"POST",
data:{
CategoryName: CategoryName,code:code,
},
success:function(response) {
document.getElementById("category_success").innerHTML =response;
$(document).ajaxStop(function(){
window.location.reload();
});
},
error:function(){
alert("error");
}
});
}
function Article_insert()
{
// var id=id1;
var ArticleName= document.getElementById("ArticleName").value;
var CategoryID= document.getElementById("CategoryID").value;
//alert(CategoryID);
var code=2;
$.ajax({
url:"action.php ",
type:"POST",
data:{
ArticleName: ArticleName,CategoryID:CategoryID,code:code,
},
success:function(response) {
document.getElementById("Article_success").innerHTML =response;
$(document).ajaxStop(function(){
window.location.reload();
});
},
error:function(){
alert("error");
}
});
}
function Building_insert()
{
// var id=id1;
var BuildingName= document.getElementById("BuildingName").value;
//alert(BuildingName);
var code=3;
$.ajax({
url:"action.php ",
type:"POST",
data:{
BuildingName: BuildingName,code:code,
},
success:function(response) {
document.getElementById("Building_success").innerHTML =response;
$(document).ajaxStop(function(){
window.location.reload();
});
},
error:function(){
alert("error");
}
});
} 
$(function() { 
$("#Category").change(function(e) {
e.preventDefault();
var code='5';
var CategoryID = $("#Category").val();
// alert(CategoryID);
$.ajax({
url:'action.php',
data:{CategoryID:CategoryID,code:code},
type:'POST',
success:function(data){
if(data != "")
{
$("#Block").html("");
$("#Block").html(data);
}
}
});
});
});
function Summary_insert()
{
var CategoryID= document.getElementById("Category").value;
var ArticleName= document.getElementById("Block").value;
//alert(ArticleName);
var code=6;
$.ajax({
url:"action.php ",
type:"POST",
data:{
CategoryID: CategoryID,ArticleName:ArticleName,code:code,
},
success:function(response) 
{
document.getElementById("summury_success").innerHTML =response;
$(document).ajaxStop(function(){
window.location.reload();
});
},
error:function()
{
alert("error");
}
});
}
function del(id){
var code=7;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("POST", "action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
$(function() { 
$("#Category").change(function(e) {
e.preventDefault();
var code='8';
var CategoryID = $("#Category").val();
//alert(CategoryID);
$.ajax({
url:'action.php',
data:{CategoryID:CategoryID,code:code},
type:'POST',
success:function(data){
if(data != "")
{
$("#articlebind").html("");
$("#articlebind").html(data);
}
}
});
});
});
$(function() { 
$("#building").change(function(e) {
e.preventDefault();
var code='9';
var buildingID = $("#building").val();
//alert(CategoryID);
$.ajax({
url:'action.php',
data:{buildingID:buildingID,code:code},
type:'POST',
success:function(data){
if(data != "")
{
$("#locationbind").html("");
$("#locationbind").html(data);
}
}
});
});
});
$(function() { 
$("#Floor").change(function(e) {
e.preventDefault();
var code='12';
var CategoryID = $("#Floor").val();
//alert(CategoryID);
$.ajax({
url:'action.php',
data:{Floor:CategoryID,code:code},
type:'POST',
success:function(data){
if(data != "")
{
$("#RoomNo").html("");
$("#RoomNo").html(data);
}
}
});
});
});
function floor() { 
$("#Floor_assign").change(function(e) {
e.preventDefault();
var code='13';
var CategoryID = $("#Floor_assign").val();
var Block_assign = $("#Block_assign").val();
// alert(Block_assign);
$.ajax({
url:'action.php',
data:{Floor:CategoryID,block:Block_assign,code:code},
type:'POST',
success:function(data){
if(data != "")
{
$("#RoomNo").html("");
$("#RoomNo").html(data);  
}
}
});
});
}
function roomNo() { 
$("#RoomNo").change(function(e) {
e.preventDefault();
var code='17';
var CategoryID = $("#Floor_assign").val();
var Block_assign = $("#Block_assign").val();
var room = $("#RoomNo").val();
// alert(Block_assign);
$.ajax({
url:'action.php',
data:{Floor:CategoryID,block:Block_assign,RoomNo:room,code:code},
type:'POST',
success:function(data){
if(data != "")
{
$("#RoomType").html("");
$("#RoomType").html(data);  
}
}
});
});
}
function block_assign() { 
$("#Block_assign").change(function(e) {
e.preventDefault();
var code='14';
var CategoryID = $("#Block_assign").val();
//alert(CategoryID);
$.ajax({
url:'action.php',
data:{Floor:CategoryID,code:code},
type:'POST',
success:function(data){
if(data != "")
{
$("#Floor_assign").html("");
$("#Floor_assign").html(data);
}
}
});
});
}

// function hello(){
//   alert('poonnu');
// }
// ............................... get ACTION FUNCTIONS;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;;; 
function stock(id){
//alert(id);
var code=9;
// var code=1;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_samry").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&page=stock-summary.php&code="+code, true);
xmlhttp.send();
}  
function stock_assign(id){
//alert(id);
var code=2;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_samry_assign").innerHTML=xmlhttp.responseText;
}
else
{
  //console.log(xmlhttp.responseText)  ;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
} 

function stock_discard(id){

var code=49;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("stock_samry_discart").innerHTML=xmlhttp.responseText;
}
else
{
 
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
} 

function edit_building(id){
var code=3;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("edit_building_master").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function getid(){
$("#RoomType").change(function(e) {
e.preventDefault();
var block = $("#Block_assign").val();
var floor = $("#Floor_assign").val();
var type = $("#RoomType").val();
var room = $("#RoomNo").val();
var code=4;
//alert(type);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
//document.getElementById("out").innerHTML=xmlhttp.responseText;
 $('#out').val(xmlhttp.responseText);
}
}
xmlhttp.open("GET", "get_action.php?block=" + block+"&floor=" + floor+"&room=" + room+"&type=" + type+"&code="+code, true);
xmlhttp.send();
});
}
function view_location(id)
{
var code=5;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("view_location").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function update_article(id){
var code=6;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("update_article").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function update_category(id){
var code=7;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("update_category").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function view_assign_stock(id)
{
//alert(id);
var code=8;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("view_assign").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function edit_room_name(id){
var code=10;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("room_name_edit").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function update_view_record_qr(id){
// var code=20;

var code=9;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("View_record_qr").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}


 function billDate(billNo) 
               {
                  
                  var code=99;
                  $.ajax(
               {
                url:"action.php ",
                type:"POST",
                data:
                {
                   code:code,billNo:billNo
                },
                success:function(response) 
                {
                  
                   document.getElementById("billdate").innerHTML =response;  
                }
             });
               }




function categorysearch(id){
var code=12;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}

function articlesearch(id){
var code=13;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function buildingsearch(id){
var code=14;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}


function room_typesearch(id){
var code=15;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}


function room_namesearch(id){
var code=16;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}

function locationsearch(id){
var code=17;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}

function specification_search(id){
var code=18;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}

function stock_summary_search(id){
var code=19;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function scan_stock_search(id){
var code=20;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();



}

function givep()
{
	var code=21;
var user_id= document.getElementById("Employee").value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("permissions").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET", "get_action.php?user_id=" + user_id+"&code="+code, true);
  xmlhttp.send();
}


function giverole()
{
  //alert('hello');
  var code=22;
var user_id= document.getElementById("EmpID").value;
var role= document.getElementById("Role").value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("permissions").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET", "get_action.php?user_id=" + user_id+"&code="+code+"&role="+role, true);
  xmlhttp.send();
}

function edit_room_type(id){
var code=23;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("room_type_edit").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}

// function edit_room_type(id){
// var code=23;
// //alert(id);
// var xmlhttp = new XMLHttpRequest();
// xmlhttp.onreadystatechange = function() {
// if (xmlhttp.readyState==4 && xmlhttp.status==200)
// {
// document.getElementById("room_type_edit").innerHTML=xmlhttp.responseText;
// }
// }
// xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
// xmlhttp.send();
// }


function bulk_assign_location(id)
{
var code=24;
document.getElementById("location_id_temp").value=id;
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("view_bulk_data").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?locationID=" + id+"&code="+code, true);
xmlhttp.send();
}


function Search_Available_record()
{
var code=25;
var id= document.getElementById("location_id_temp").value;
var Category= document.getElementById("Category").value;
var articlebind= document.getElementById("articlebind").value;
// alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("view_bulk_data").innerHTML=xmlhttp.responseText;
}
}                                                    
xmlhttp.open("GET", "get_action.php?locationID=" + id+"&code="+code+"&Category="+Category+"&articlebind="+articlebind, true);
xmlhttp.send();
}

function view_record_qr(id){
var code=26;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("view_record_only").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function emp_details(id){
var code=27;
//alert(id);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("emp_details_name").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}

function emp_details1(id){
var code=27;

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("emp_details_name1").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}
function emp_details2(id){
var code=27;

var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("emp_details_name2").innerHTML=xmlhttp.responseText;
}
}
xmlhttp.open("GET", "get_action.php?id=" + id+"&code="+code, true);
xmlhttp.send();
}


// $(document).ready(function () {
//     $('#search_item').DataTable();
// });

// $(document).ready(function () {
//     $('#search_all_item').DataTable();
// });

  $(function () {
    $("#search_item").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#search_all_item').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
  

 

function stock_summary_search_by_article(){
var code=29;
var CategoryID=document.getElementById("Category").value;
var ArticleID=document.getElementById("articlebind").value;
var Status=document.getElementById("Status").value;
 //alert(ArticleID);
var xmlhttp = new XMLHttpRequest();
xmlhttp.onreadystatechange = function() {
if (xmlhttp.readyState==4 && xmlhttp.status==200)
{
document.getElementById("search_record").innerHTML=xmlhttp.responseText;
$('#example').DataTable({ 
                      "destroy": true, //use for reinitialize datatable
                   });
}
}
xmlhttp.open("GET", "get_action.php?CategoryID=" + CategoryID+"&code="+code+"&ArticleID="+ArticleID+"&Status="+Status, true);
xmlhttp.send();
}

//**************************permission system**************************


function role_search()
{
    var code=31; //69 
var d= document.getElementById("role").value;
// alert(d);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("permissions").innerHTML=xmlhttp.responseText;
      emp_role_all(d);
    }
  }
  xmlhttp.open("GET", "get_action.php?role_id=" + d+"&code="+code, true);
  xmlhttp.send();
}
 
// function emp_role()
// {
//         var code=32; //70
// var user_id= document.getElementById("user_id").value;
// // alert(user_id);
//   var xmlhttp = new XMLHttpRequest();
//   xmlhttp.onreadystatechange = function() {
//     if (xmlhttp.readyState==4 && xmlhttp.status==200)
//     {
//       //document.getElementById("role_assign").innerHTML='dfgdfg';
//       document.getElementById("role_assign").innerHTML=xmlhttp.responseText;
//       emp_permission();
//       emp_role_all(user_id);
      

//     }
//   }
//   xmlhttp.open("GET", "get_action.php?user_id=" + user_id+"&code="+code, true);
//   xmlhttp.send();
// }

function emp_role()
{
   $('#div_diivde').show();
   var code=32; //70
   var user_id= document.getElementById("user_id").value;
   // alert(user_id);
   var xmlhttp = new XMLHttpRequest();
   xmlhttp.onreadystatechange = function() {
     if (xmlhttp.readyState==4 && xmlhttp.status==200)
     {
       //document.getElementById("role_assign").innerHTML='dfgdfg';
       $('#all_permissions').hide();
      document.getElementById("role_assign").innerHTML=xmlhttp.responseText;
      emp_permission();
      emp_role_all(user_id);
      

    }
  }
  xmlhttp.open("GET", "get_action.php?user_id=" + user_id+"&code="+code, true);
  xmlhttp.send();
}
function emp_permission()
{
        var code=33; //71
var user_id= document.getElementById("user_id").value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("permission_assign").innerHTML=xmlhttp.responseText;

    }
  }
  xmlhttp.open("GET", "get_action.php?user_id=" + user_id+"&code="+code, true);
  xmlhttp.send();
}

function role_drop()
{

        var code=34; //72
         var id= document.getElementById("user_id").value;
         if (id!='') {
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("role_drop_dwon").innerHTML=xmlhttp.responseText;
      emp_role();
    }
  }
   xmlhttp.open("GET", "get_action.php?user_id=" + id+"&code="+code, true);
  xmlhttp.send();
}
else
{
    alert('Please Enter Employee ID');
}
}


function del_role(id)
{
    var a=confirm('Are you sure you want to delete Role and special permissions '+id);
//alert(id);
if (a==true) {
var code=111;  //73
$.ajax({
url:"action.php ",
type:"POST",
data:{
emp_id:id,code:code,
},
success:function(response) {
  if(response==1)
  {
    emp_role(); 
    SuccessToast('Successfully Delete');
  }
  else
  {
    ErrorToast('Try Again','bg-danger');
  }
      },
error:function(){
// alert("error");
}
});
}
else
{

}
} 




function submit_role(id)
{
//alert(id);
var code=112; //74
var role_id= document.getElementById("role_new").value;
$.ajax({
url:"action.php ",
type:"POST",
data:{
role_new:role_id,emp_id:id,code:code,
},
success:function(response) {
    // console.log(response);
$('#exampleModal').trigger({
    type:"click"
});
if(response==1)
{
  emp_role(); 
  SuccessToast('Successfully Asssined');
}
else if(response==2)
{
  emp_role(); 
  ErrorToast('already Assigned','bg-warning');
}
else
{
  ErrorToast('Try Again','bg-danger');
}

},
error:function(){
}
});
}   

function submit_special_per(id)
{
    
    setTimeout(function() 
        { 
            emp_role(); 
        }, 500);


}






function emp_role_all(id)
{
        var code=35; //76
        // alert(id);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("role_all").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET", "get_action.php?role_id=" + id+"&code="+code, true);
  xmlhttp.send();
}


  function check(id)
  {
  var clicked = false;

  $(".checkhour"+id).prop("checked", !clicked);
  clicked = !clicked;
  this.innerHTML = clicked ? 'Deselect' : 'Select';
}




  function un_check(id)
  {
    
    $(".un_check"+id).prop("checked", false);
    }

  
  //***********************end permission********************************

  function show_menu_pages(id)
  {
           var code=36; 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("show_all_menu_pages").innerHTML=xmlhttp.responseText;
    } 
  }
  xmlhttp.open("GET", "get_action.php?menu_id=" + id+"&code="+code, true);
  xmlhttp.send();

  }

  function show_text_box_pages(id)
  {
 var submenu = $('.page_submenu'+id).text();


 var link = $('.page_sublink'+id).text();

 var submenu = $('<input id="page_submenu'+id+'" class="form-control" type="text" value="' + submenu + '" />')

 var link = $('<input id="page_sublink'+id+'" class="form-control" type="text" value="' + link + '" />')

 $('#page_crose'+id).show();
  $('#page_check'+id).show();   
  $('#page_edit'+id).hide(); 
    $('#menu_label'+id).hide();
    $('#main_menu'+id).show();
 $('.page_submenu'+id).text('').append(submenu);
  $('.page_sublink'+id).text('').append(link);
  }

 

 function show_text_box_menu(id)
 {
 var text = $('.text-info'+id).text();
 var input = $('<input id="attribute'+id+'" class="form-control" type="text" value="' + text + '" />')
 $('#crose'+id).show();
  $('#check'+id).show();
 $('#times'+id).hide();
 $('.text-info'+id).text('').append(input);
}

function data_submit(id)
{  
   var text = $('#attribute'+id).val();  
// var id = $('#idnumber').val();
// alert(text+id);
           var code=37; 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("error").innerHTML=xmlhttp.responseText;
       $('#attribute'+id).parent().text(text);
   // $('#attribute').remove();
    $('#times'+id).show();
    $('#crose'+id).hide();
  $('#check'+id).hide();
      if (xmlhttp.responseText==0)
       {
         ErrorToast('Error','bg-danger' );
      }
      else
      {
        SuccessToast('Successfully Update');
      }
    }
  }
  xmlhttp.open("GET", "get_action.php?menu_id=" + id+"&menu_name="+text+"&code="+code, true);
  xmlhttp.send();
}
function cencel_text_box(id)
{  
   var text = $('#attribute'+id).val();
    $('#attribute'+id).parent().text(text);
   $('#attribute'+id).remove();
    $('#times'+id).show();
    $('#crose'+id).hide();
  $('#check'+id).hide();
}
function cencel_text_box_page(id)
{  
   var text = $('#page_submenu'+id).val();
   var link = $('#page_sublink'+id).val();
    $('#page_submenu'+id).parent().text(text);
     $('#page_sublink'+id).parent().text(link);
   $('#page_submenu'+id).remove();
    $('#page_edit'+id).show();
    $('#page_crose'+id).hide();
  $('#page_check'+id).hide();
}  


function page_data_submit(id)
{  
   var submenu = $('#page_submenu'+id).val(); 
  var menuid= $('#main_menu_h'+id).val(); 
      var link = $('#page_sublink'+id).val(); 

       var menu = $('#main_menu'+id).val();
       //alert(menu);
 

           var code=38; 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("error").innerHTML=xmlhttp.responseText;

       $('#page_submenu'+id).parent().text(submenu);
       $('#page_sublink'+id).parent().text(link);
   // $('#attribute').remove();
    $('#page_edit'+id).show();
    $('#page_crose'+id).hide();
  $('#page_check'+id).hide();
   $('#main_menu'+id).hide();
   $('#menu_label'+id).show();
        if (xmlhttp.responseText==0)
       {
         ErrorToast('Error','bg-danger' );
      }
      else
      {
        SuccessToast('Successfully Update');

       show_menu_pages(menuid);


      }
    }
  }
  xmlhttp.open("GET", "get_action.php?submenu_id=" + id+"&submenu_name="+submenu+"&sublink="+link+"&menu="+menu+"&code="+code, true);
  xmlhttp.send();
}

function new_page_submit()
{
      var menu = $('#main_menu').val();

      var submenu = $('#submenu').val();
      var sublink = $('#sub_link').val();
   
               var code=39; 
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() 
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      if (xmlhttp.responseText==0)
       {
         ErrorToast('Error','bg-danger' );
      }
      else
      {
        SuccessToast('Successfully Inserted');
      }
      
      
      show_menu_pages(menu);
    }
  }
  xmlhttp.open("GET", "get_action.php?menu_id=" + menu+"&submenu_name="+submenu+"&link="+sublink+"&code="+code, true);
  xmlhttp.send();
}


function country_to_state(country) 
{  
    // alert(country);
var code='137';
$.ajax({
url:'action_g.php',
data:{country:country,code:code},
type:'POST',
success:function(data){
if(data != "")
{
    // console.log(data);
$("#State").html("");
$("#State").html(data);
}
}
});

}

// tab active when page reload
function tab()
{
   $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
 localStorage.setItem('lastTab', $(this).attr('href'));
});
var lastTab = localStorage.getItem('lastTab');

if (lastTab) {
 $('[href="' + lastTab + '"]').tab('show');
}
}


