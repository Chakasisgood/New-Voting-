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
                <table id="voterTable" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Voter</th>
                    <th>Candidate</th>
                    <th>Position</th>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT voters.fullname AS votlast, candidates.fullname AS canlast, positions.description AS position_desc 
                    FROM votes 
                    LEFT JOIN positions ON positions.id=votes.position_id 
                    LEFT JOIN candidates ON candidates.id=votes.candidate_id 
                    LEFT JOIN voters ON voters.id=votes.voters_id 
                    ORDER BY voters.fullname, positions.priority ASC";
                    $query = $conn->query($sql);
                    $current_voter = null;
                    $first = true;
                    while ($row = $query->fetch_assoc()) {
                      if ($row['votlast'] != $current_voter) {
                        if (!$first) {
                          echo "</tbody>"; // Close the previous voter's candidate rows
                        }
                        $current_voter = $row['votlast'];
                        $first = false;
                        echo "
                        <tr class='voter-row' data-voter='" . $row['votlast'] . "'>
                            <td class='hidden'></td>
                            <td colspan='3'><strong>" . $row['votlast'] . "</strong></td>
                        </tr>
                        <tbody class='candidate-rows' data-voter='" . $row['votlast'] . "' style='display:none;'>
                    ";
                      }
                      echo "
                    <tr>
                        <td class='hidden'></td>
                        <td></td> <!-- Empty cell under voter name -->
                        <td>" . $row['canlast'] . "</td>
                        <td>" . $row['position_desc'] . "</td>
                    </tr>
                ";
                    }
                    echo "</tbody>"; // Close the last voter's candidate rows
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