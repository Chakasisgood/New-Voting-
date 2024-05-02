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

      #countdown {
        font-size: 20px;
        font-weight: bold;
      }

      .settime {
        background: #5391CA;
        height: fit-content;
        color: white;
        font-size: 20px;
        border-style: none;
      }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Candidates List
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Candidates</li>
        </ol>
      </section>
      <!-- Main content -->
      <section class="content">
        <?php
        if (isset($_SESSION['error'])) {
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
          unset($_SESSION['error']);
        }
        if (isset($_SESSION['success'])) {
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
          unset($_SESSION['success']);
        }
        ?>

        <!-- Set Time for Voting -->
        <form action="candidates.php" method="post">
          <label id="countdown" for="countdown">Set Time for Voting</label>
          <input type="datetime-local" id="countdown" name="countdown" required><br>
          <button id="button" class="settime" type="submit">Set Time</button>
        </form>
        <br>



        <!-- Label For the form -->

        <div class="row">
          <div class="col-xs-12">
            <div class="box">
              <div class="box-header with-border">
                <a href="#addnew" data-toggle="modal" id="button" class="btn btn-primary btn-sm btn-flat"><i></i> New</a>
              </div>
              <div class="box-body">
                <table id="example1" class="table table-bordered">
                  <thead>
                    <th class="hidden"></th>
                    <th>Position</th>
                    <th>Photo</th>
                    <th>Fullname</th>
                    <th>Age</th>
                    <th>Platform</th>
                    <th>Action</th>
                  </thead>
                  <tbody>
                    <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                      $countdown = $_POST['countdown'];

                      // Insert countdown datetime into database
                      $sql = "INSERT INTO countdown (countdown) VALUES ('$countdown')";
                      if ($conn->query($sql) === TRUE) {
                        echo "<script>alert('Voting Countdown Save Successfully');</script>";
                      } else {
                        echo "Error: " . $sql . "<br>" . $conn->error;
                      }
                    }

                    // slecting the candidates to paste in table
                    $sql = "SELECT *, candidates.id AS canid FROM candidates LEFT JOIN positions ON positions.id=candidates.position_id ORDER BY positions.priority ASC";
                    $query = $conn->query($sql);
                    while ($row = $query->fetch_assoc()) {
                      $image = (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/profile.jpg';
                      echo "
                        <tr>
                          <td class='hidden'></td>
                          <td>" . $row['description'] . "</td>
                          <td>
                            <img src='" . $image . "' width='30px' height='30px'>
                            <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='" . $row['canid'] . "'><span ></span></a>
                          </td>
                          <td>" . $row['firstname'] . "</td>
                          <td>" . $row['lastname'] . "</td>
                          <td><a href='#platform' data-toggle='modal' class='btn btn-info btn-sm btn-flat platform' data-id='" . $row['canid'] . "'><i class='fa fa-search'></i> View</a></td>
                          <td>
                            <button id='button' class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['canid'] . "'><i ></i> Edit</button>
                            <button id='button' class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['canid'] . "'><i ></i> Delete</button>
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

    <?php include 'includes/candidates_modal.php'; ?>
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

      $(document).on('click', '.photo', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
      });

      $(document).on('click', '.platform', function(e) {
        e.preventDefault();
        var id = $(this).data('id');
        getRow(id);
      });

    });

    function getRow(id) {
      $.ajax({
        type: 'POST',
        url: 'candidates_row.php',
        data: {
          id: id
        },
        dataType: 'json',
        success: function(response) {
          $('.id').val(response.canid);
          $('#edit_firstname').val(response.firstname);
          $('#edit_lastname').val(response.lastname);
          $('#posselect').val(response.position_id).html(response.description);
          $('#edit_platform').val(response.platform);
          $('.fullname').html(response.firstname + ' ' + response.lastname);
          $('#desc').html(response.platform);
        }
      });
    }
  </script>
</body>

</html>