<!-- SweetAlert CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- SweetAlert JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="../bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck 1.0.1 -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<!-- Moment JS -->
<script src="../bower_components/moment/moment.js"></script>
<!-- DataTables -->
<script src="../bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="../bower_components/chart.js/Chart.js"></script>
<!-- ChartJS Horizontal Bar -->
<script src="../bower_components/chart.js/Chart.HorizontalBar.js"></script>
<!-- daterangepicker -->
<script src="../bower_components/moment/min/moment.min.js"></script>
<script src="../bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="../bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- bootstrap time picker -->
<script src="../plugins/timepicker/bootstrap-timepicker.min.js"></script>
<!-- Slimscroll -->
<script src="../bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="../bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>

<!-- Active Script -->
<script>
  $(function() {
    /** add active class and stay opened when selected */
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    $('ul.sidebar-menu a').filter(function() {
      return this.href == url;
    }).parent().addClass('active');

    // for treeview
    $('ul.treeview-menu a').filter(function() {
      return this.href == url;
    }).parentsUntil(".sidebar-menu > .treeview-menu").addClass('active');

  });
</script>
<!-- Data Table Initialize -->
<script>
  $(function() {
    $('#example1').DataTable()
    $('#example2').DataTable({
      'paging': true,
      'lengthChange': false,
      'searching': false,
      'ordering': true,
      'info': true,
      'autoWidth': false
    })
  })
</script>
<!-- Date and Timepicker -->
<script>
  $(function() {
    //Date picker
    $('#datepicker_add').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
    $('#datepicker_edit').datepicker({
      autoclose: true,
      format: 'yyyy-mm-dd'
    })
  });

  $(document).ready(function() {
    // Handle the click event on voter rows
    $('.voter-row').click(function() {
      var voter = $(this).data('voter');
      var candidateRows = $('.candidate-rows[data-voter="' + voter + '"]');

      // Toggle visibility of the candidate rows
      candidateRows.slideToggle();
    });
  });

  // Show password
  document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    var toggleIcon = document.getElementById('togglePassword');

    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleIcon.classList.remove('glyphicon-eye-open');
      toggleIcon.classList.add('glyphicon-eye-close');
    } else {
      passwordField.type = 'password';
      toggleIcon.classList.remove('glyphicon-eye-close');
      toggleIcon.classList.add('glyphicon-eye-open');
    }
  });


  // function limitCheckboxes(checkbox, max) {
  //   console.log('Checking')
  //   const checkboxes = document.querySelectorAll('input[type="checkbox"][name="' + checkbox.name + '"]');
  //   const checkedCount = Array.from(checkboxes).filter(chk => chk.checked).length;

  //   if (checkedCount > max) {
  //     checkbox.checked = false;
  //     alert('You can only select up to ' + max + ' options.');
  //   }
  // }
</script>