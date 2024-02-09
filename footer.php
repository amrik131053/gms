      </div><!--/. container-fluid -->
      
  <aside class="control-sidebar control-sidebar-dark">
  </aside>
  <footer class="main-footer">
    <strong>Copyright &copy; 2020-2022 <a href="">Information Technology (IT) GKU</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Technical Helpline</b> 91-78146-79220
    </div>

  </footer>
</div>

<?php include "internet_status.php";?>


<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/fullcalendar/main.min.js"></script>
<script src="plugins/fullcalendar-daygrid/main.min.js"></script>
<script src="plugins/fullcalendar-timegrid/main.min.js"></script>
<script src="plugins/fullcalendar-interaction/main.min.js"></script>
<script src="plugins/fullcalendar-bootstrap/main.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/demo.js"></script>
<script src="plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr --> 
<script src="plugins/toastr/toastr.min.js"></script>
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<script src="plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>

<script src="dist/js/adminlte.js"></script>
<script src="sc.js"></script>

<!--   tool tip -->

<!-- <script src="plugins/popper/popper-utils.min.js"></script>
<script src="plugins/popper/popper.min.js"></script> -->


<!-- internet_status -->



<script src="internet_status.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>

<script>
  $(function () {
    // Summernote
    $('.textarea_quetions').summernote({
  toolbar: [
    // [groupName, [list of button]]
    ['style', ['bold', 'italic', 'underline', 'clear']],
    ['fontsize', ['fontsize']],
    ['color', ['color']],
    ['para', ['ul', 'ol', 'paragraph']],
    ['height', ['height']]
  ]
}) 
  })
</script>
<script type="text/javascript">
   function SuccessToast(text)
   {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    
      Toast.fire({
        icon: 'success',
        title: text
      })
   }

    function ErrorToast(text,bg)
   {
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
    
        $(document).Toasts('create', {
        class: bg, 
        title: 'Caution!',
        body: text
      })
   } 
function seen_notification(n_id) 
{
  var code=28;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code,n_id:n_id},
   
   success:function(data)
   {
     
   }
  });
}
function show_notification(id) 
{
  var code=26;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code,id:id},
   
   success:function(data)
   {
     document.getElementById('show_notification_tab').innerHTML=data;
   }
  });
}
$(document).ready(function(){
 function load_unseen_notification()
 {
  var code=27;
  $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code},
   
   success:function(data)
   {
    if (data==0) {

     document.getElementById('count').innerHTML="";
    }
    else
    {
     document.getElementById('count').innerHTML=data;
    }
   }
  });
 }
 load_unseen_notification();
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 1000);
 
});

setInterval(function(){pushNotify();}, 8000);

        function pushNotify() {
          if (!("Notification" in window)) {
                // checking if the user's browser supports web push Notification
                // alert("Web browser does not support desktop notification");
            }
            if (Notification.permission !== "granted")
                Notification.requestPermission();
            else {
                $.ajax({
                url : "push-notify.php",
                type: "POST",
                success: function(data, textStatus, jqXHR) {
                    // if PHP call returns data process it and show notification
                    // if nothing returns then it means no notification available for now
                  if ($.trim(data)){
                        var data = jQuery.parseJSON(data);
                        // console.log(data);
                        notification = createNotification( data.title,  data.icon,  data.body, data.url,data.id);

                        // closes the web browser notification automatically after 5 secs
                        // setTimeout(function() {

                        // }, 1000);
                    }
                          seen_webnotification(data.id);

                },
                error: function(jqXHR, textStatus, errorThrown) {}
                });
            }
        };

        function createNotification(title, icon, body, url,id) {
            var notification = new Notification(title, {
                icon: icon,
                body: body,
            });
          
            // url that needs to be opened on clicking the notification
            // finally everything boils down to click and visits right
            notification.onclick = function() {
                window.open(url);
                
            };
            return notification;
        }
function seen_webnotification(id) {
   var code=33;
   $.ajax({
   url:"action_g.php",
   method:"POST",
   data:{code:code,n_id:id},
   
   success:function(data)
   {
     
   }
  });
}
</script>

</body>
</html>
