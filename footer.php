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

<script src="dist/js/adminlte.js"></script>
<script src="sc.js"></script>
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

</script>


<!-- <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script> -->
<!-- <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script> -->
<!-- <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script> -->
</body>
</html>
