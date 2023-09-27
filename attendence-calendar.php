<?php 
  include "header.php";   
?>  
    <section class="content">
      <div class="container-fluid">
        <div class="row">
         
          <!-- /.col -->
          <div class="col-md-8">
            <div class="card card-primary">
              <div class="card-body p-0">
                <!-- THE CALENDAR -->
                <div id="calendar">
              
                </div>
              </div>
         
            </div>
    
          </div>

           <div class="col-md-4">
  
     <div class="card-body card">
        <div class="btn-group w-100 mb-2">
                    <a class="btn btn-primary"  id="btn1" style="background-color:; color: white; border: 1px solid;" onclick="pendingLeaves(),bg(this.id);"> Pending </a>
                     <a class="btn btn-primary" id="btn2"style="background-color:; color: white; border: 1px solid;" onclick="approvedLeaves(),bg(this.id);"> Approved </a>
                    <a class="btn btn-primary" id="btn3" style="background-color:; color: white; border: 1px solid;" onclick="rejectLeaves(),bg(this.id);"> Rejected </a>
                
                  </div>

         <div  id="table_load" class="table-responsive" style="height:700px;">
</div>

   
       
                </div>
              </div>
            </div> 
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
    </section>
 
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
</div>


<div class="modal fade" id="ViewLeaveexampleModal" tabindex="-1" role="dialog" aria-labelledby="ViewLeaveexampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ViewLeaveexampleModalLabel">View</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="view_leave_table_load">
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
       
      </div>
    </div>
  </div>
</div>
<?php   include "footer.php";   ;?>
<script>
    $(window).on('load', function() 
          {
         $('#btn1').toggleClass("bg-success"); 
         pendingLeaves();
           })
  function bg(id)
          {
         $('.btn').removeClass("bg-success");
         $('#'+id).toggleClass("bg-success"); 
         }
       function  pendingLeaves()
         {
         var code=217;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
      }


         function approvedLeaves()
         {
          var code=218;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
         }
      function rejectLeaves()
         {
          var code=219;
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code
            },
            success: function(response) 
            {
               spinner.style.display='none';
               document.getElementById("table_load").innerHTML=response;
            }
         });
        }


        function viewLeaveModal(id)
          {

       var code=220;
        
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id
                  },
            success: function(response) 
            {

                // console.log(response);
               spinner.style.display='none';
               document.getElementById("view_leave_table_load").innerHTML=response;
            }
         });

     }
        function deleteLeave(id)
          {

            var a=confirm('Are you sure you want to delete');
  
  if (a==true) {
       var code=221;
        
         var spinner=document.getElementById('ajax-loader');
         spinner.style.display='block';
         $.ajax({
            url:'action_g.php',
            type:'POST',
            data:{
               code:code,id:id
                  },
            success: function(response) 
            {
              if(response==1)
              {
                spinner.style.display='none';
                SuccessToast('SuccessFully Deleted');
                pendingLeaves();
              }
            
            }
         });
        }
        else
        {

        }
     }




















  $(function () {
    function ini_events(ele) {
      
      ele.each(function () {
        var eventObject = {
          title: $.trim($(this).text()) 
        }
        $(this).data('eventObject', eventObject)
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, 
          revertDuration: 0 
        })
      })
    }
 
    ini_events($('#external-events div.external-event'))
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()
    var Calendar = FullCalendar.Calendar;
    var containerEl = document.getElementById('external-events');
    var calendarEl = document.getElementById('calendar');

    
    var calendar = new Calendar(calendarEl, {
      plugins: [ 'bootstrap', 'interaction', 'dayGrid', 'timeGrid' ],
      header    : {
     left : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridDay'
      },
      'themeSystem': 'bootstrap',
      events    : "fetch_Attendance.php", 
      selectable:true,
      selectHelper:true,
    }
    );
    calendar.render();
  });
  
</script>
</body>
</html>
