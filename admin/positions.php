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
          Positions
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Positions</li>
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
                <a href="#addnew" data-toggle="modal" id="button" class="btn btn-primary btn-sm btn-flat"><i></i>Add New Positions</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th>Position</th>
                    <th>Maximum Votes</th>
                    <th>Action</th>

                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM positions ORDER BY priority ASC";
                    $query = $conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                      echo "  
                        <tr>
                          <td>" . $row['description'] . "</td>
                          <td>" . $row['max_vote'] . "</td>
                          <td>
                          
                            <button id='button' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "' ><i</i> Delete</button>
                          </td>
                        </tr>
                      ";
                    }
                    ?>
                    <!--   <button id='button' class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['id'] . "'><i></i> Edit</button> -->


                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </section>

    </div>


    <?php include 'includes/footer.php'; ?>
    <?php include 'includes/positions_modal.php'; ?>
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
        url: 'positions_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('.id').val(response.id);
          $('#edit_description').val(response.description);
          $('#posselect').val(response.courses_id);
          $('#edit_max_vote').val(response.max_vote);
          $('.description').html(response.description);
        }
      });
    }
  </script>
</body>

</html>