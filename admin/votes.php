<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Votes
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Votes</li>
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
                <a href="#reset" data-toggle="modal" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-refresh"></i> Reset</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Voter</th>
                    <th>Candidate</th>
                    <th>Position</th>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT *, voters.fullname AS votlast, candidates.fullname AS canlast FROM votes LEFT JOIN positions ON positions.id=votes.position_id LEFT JOIN candidates ON candidates.id=votes.candidate_id LEFT JOIN voters ON voters.id=votes.voters_id ORDER BY positions.priority ASC";
                    $query = $conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>" . $row['votfirst'] . ' ' . $row['votlast'] . "</td>
                          <td>" . $row['canfirst'] . ' ' . $row['canlast'] . "</td>
                          <td>" . $row['description'] . "</td>
                          
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
    <?php include 'includes/votes_modal.php'; ?>
  </div>
  <?php include 'includes/scripts.php'; ?>
</body>

</html>