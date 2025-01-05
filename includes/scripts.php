<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- Data Table Initialize -->
<script>
  $(function() {
    $('#example1').DataTable()
    var bookTable = $('#booklist').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': true,
      'ordering': true,
      'info': false,
      'autoWidth': false
    })

    $('#searchBox').on('keyup', function() {
      bookTable.search(this.value).draw();
    });

  })
  document.getElementById('logoutButton').addEventListener('click', function() {
    Swal.fire({
      title: 'Are you sure you want to logout?',
      text: "You will need to log in again to continue.",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, logout',
      cancelButtonText: 'Cancel'
    }).then((result) => {
      if (result.isConfirmed) {
        // Redirect to the logout PHP script if confirmed
        window.location.href = 'logout.php';
      }
    });
  });
</script>