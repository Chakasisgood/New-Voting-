<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/conn.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>
    <style>
      #button {
        border-radius: 5px;
      }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Voters List
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Voters</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
          <script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'error',
                  title: 'Error!',
                  text: '" . $_SESSION['error'] . "',
                  showConfirmButton: true
              });
          });
          </script>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
          <script>
          document.addEventListener('DOMContentLoaded', function() {
              Swal.fire({
                  icon: 'success',
                  title: 'Success!',
                  text: '" . $_SESSION['success'] . "',
                  showConfirmButton: true
              });
          });
          </script>
          ";
          unset($_SESSION['success']);
        }
        ?>
        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <!-- Course Filter Dropdown -->
                <div id="courseFilters" class="btn-group">
                  <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Select Course <span class="caret"></span>
                  </button>
                  <ul class="dropdown-menu">
                    <?php
                    // Retrieve distinct courses from the 'voters' table
                    $sql = "SELECT DISTINCT course FROM voters ORDER BY course ASC";
                    $courseQuery = $conn->query($sql);
                    while ($courseRow = $courseQuery->fetch_assoc()) {
                      echo "<li><a href='#' class='course-button' data-course='" . $courseRow['course'] . "'>" . $courseRow['course'] . "</a></li>";
                    }
                    ?>
                    <li role="separator" class="divider"></li>
                    <li><a href='#' class='course-button' data-course='all'>Show All</a></li>
                  </ul>
                </div>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>Fullname</th>
                    <th>Course</th>
                    <th>Student ID</th>
                    <th>Action</th>
                  </thead>
                  <tbody id="voterTableBody">
                    <?php
                    $sql = "SELECT * FROM voters";
                    $query = $conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                      echo "
                                <tr class='student-row' data-course='" . $row['course'] . "'>
                                    <td>" . $row['fullname'] . "</td>
                                    <td>" . $row['course'] . "</td>
                                    <td>" . $row['studentid'] . "</td>
                                    <td>
                                        <button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['id'] . "'><i></i> Edit</button>
                                        <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "'><i></i> Delete</button>
                                    </td>
                                </tr>
                            ";
                    }
                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

      </section>
    </div>

    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/voters_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
  <script>
    $(function() {
      $(document).on('click', '.edit', function(e) {
        e.preventDefault();
        $('#edit').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

      $(document).on('click', '.delete', function(e) {
        e.preventDefault();
        $('#delete').modal('show');
        var id = $(this).data('id');
        getRow(id);
      });

    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'voters_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('.id').val(response.id);
          $('#edit_fullname').val(response.fullname);
          $('#edit_course').val(response.course);
          $('#edit_email').val(response.email);
          $('#edit_studentid').val(response.studentid);
          $('#edit_password').val(response.password);
          $('.fullname').html(response.fullname + ' , ' + response.studentid);
        }
      });
    }

    // Filtering Course
    document.addEventListener('DOMContentLoaded', function() {
      // Event listener for course button clicks
      document.querySelectorAll('.course-button').forEach(button => {
        button.addEventListener('click', function(event) {
          event.preventDefault();
          const selectedCourse = this.getAttribute('data-course');

          // Show all rows if "Show All" is selected
          if (selectedCourse === 'all') {
            document.querySelectorAll('.student-row').forEach(row => {
              row.style.display = '';
            });
          } else {
            // Hide all rows first
            document.querySelectorAll('.student-row').forEach(row => {
              row.style.display = 'none';
            });

            // Show only the rows with the selected course
            document.querySelectorAll('.student-row[data-course="' + selectedCourse + '"]').forEach(row => {
              row.style.display = '';
            });
          }
        });
      });
    });
  </script>
</body>

</html>