<?php include 'includes/session.php'; ?>
<?php include 'includes/slugify.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/conn.php' ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">

    <?php include 'includes/navbar.php'; ?>
    <?php include 'includes/menubar.php'; ?>
    <style>
      #countdown {
        font-family: 'Arial', sans-serif;
        font-size: 15px;
        color: #333;
        text-align: center;
        padding: 10px;
        border-radius: 8px;

        /* Matches your preferred color */
        width: fit-content;
        margin: 20px auto;
        letter-spacing: 1.5px;
        background: rgba(255, 255, 255, 0.2);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 1);
      }

      #countdown span {
        font-weight: bold;
        color: #e63946;
        margin: 0 5px;
      }

      #countdown-label {
        font-size: 16px;
        text-transform: uppercase;
        color: #555;
      }
    </style>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      <!-- Content Header (Page header) -->
      <section class="content-header">
        <h1>
          Dashboard
        </h1>
        <ol class="breadcrumb">
          <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
          <li class="active">Dashboard</li>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green  ">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM positions";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>No. of Positions</p>
              </div>
              <div class="icon">
                <i class="fa fa-tasks"></i>
              </div>
              <a href="positions.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-orange">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM candidates";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>No. of Candidates</p>
              </div>
              <div class="icon">
                <i class="fa fa-black-tie"></i>
              </div>
              <a href="candidates.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-teal">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM voters";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>Total Voters</p>
              </div>
              <div class="icon">
                <i class="fa fa-users"></i>
              </div>
              <a href="voters.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
              <div class="inner">
                <?php
                $sql = "SELECT * FROM votes GROUP BY voters_id";
                $query = $conn->query($sql);

                echo "<h3>" . $query->num_rows . "</h3>";
                ?>

                <p>Voters Voted</p>
              </div>
              <div class="icon">
                <i class="fa fa-edit"></i>
              </div>
              <a href="votes.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>


        <!-- Countdown Time -->

        <div id="countdown"></div>
        <?php

        $sql = "SELECT countdown FROM countdown ORDER BY id DESC LIMIT 1";
        $result = $conn->query($sql);

        $countdown = null;
        if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $countdown = $row["countdown"];
        }
        ?>
        <!-- end of countdown -->

        <div class="row">
          <div class="col-xs-12">
            <h3>Votes Tally
              <span class="pull-right">
                <a href="print.php" class="btn btn-success btn-sm btn-flat"><span class="glyphicon glyphicon-print"></span> Print</a>
              </span>
            </h3>
          </div>
        </div>

        <?php
        $sql = "SELECT * FROM positions ORDER BY priority ASC";
        $query = $conn->query($sql);
        $inc = 2;
        while ($row = $query->fetch_assoc()) {
          $inc = ($inc == 2) ? 1 : $inc + 1;
          if ($inc == 1) echo "<div class='row'>";
          echo "
            <div class='col-sm-6'>
              <div class='box box-solid'>
                <div class='box-header with-border'>
                  <h4 class='box-title'><b>" . $row['description'] . "</b></h4>
                </div>
                <div class='box-body'>
                  <div class='chart'>
                    <canvas id='" . slugify($row['description']) . "' style='height:200px'></canvas>
                  </div>
                </div>
              </div>
            </div>
          ";
          if ($inc == 2) echo "</div>";
        }
        if ($inc == 1) echo "<div class='col-sm-6'></div></div>";
        ?>

      </section>
      <!-- right col -->
    </div>
    <?php include 'includes/footer.php'; ?>

  </div>
  <!-- ./wrapper -->

  <?php include 'includes/scripts.php'; ?>
  <?php
  $sql = "SELECT * FROM positions ORDER BY priority ASC";
  $query = $conn->query($sql);
  while ($row = $query->fetch_assoc()) {
    $sql = "SELECT * FROM candidates WHERE position_id = '" . $row['id'] . "'";
    $cquery = $conn->query($sql);
    $carray = array();
    $varray = array();
    while ($crow = $cquery->fetch_assoc()) {
      array_push($carray, $crow['fullname']);
      $sql = "SELECT * FROM votes WHERE candidate_id = '" . $crow['id'] . "'";
      $vquery = $conn->query($sql);
      array_push($varray, $vquery->num_rows);
    }
    $carray = json_encode($carray);
    $varray = json_encode($varray);
  ?>
    <script>
      // Set the countdown timer
      var countdownEnd = new Date("<?php echo $countdown; ?>").getTime();

      var countdownFunction = setInterval(function() {
        var now = new Date().getTime();
        var distance = countdownEnd - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        document.getElementById("countdown").innerHTML = "VOTINGS ARE NOW OFFICIALLY OPEN FOR: " + days + "d " + hours + "h " +
          minutes + "m " + seconds + "s ";

        if (distance < 0) {
          clearInterval(countdownFunction);
          document.getElementById("countdown").innerHTML = "VOTING IS NOW OFFICIALY CLOSED!!";
        }
      }, 1000);


      $(function() {
        var rowid = '<?php echo $row['id']; ?>';
        var description = '<?php echo slugify($row['description']); ?>';
        var barChartCanvas = $('#' + description).get(0).getContext('2d')
        var barChart = new Chart(barChartCanvas)
        var barChartData = {
          labels: <?php echo $carray; ?>,
          datasets: [{
            label: 'Votes',
            fillColor: 'rgba(60,141,188,0.5)',
            strokeColor: 'rgba(60,141,188,0.8)',
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: <?php echo $varray; ?>
          }]
        }
        var barChartOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid  lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: 'rgba(0,0,0,.05)',
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 2,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 5,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 1,
          //String - A legend template
          legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        }

        barChartOptions.datasetFill = false
        var myChart = barChart.HorizontalBar(barChartData, barChartOptions)
        //document.getElementById('legend_'+rowid).innerHTML = myChart.generateLegend();
      });
    </script>
  <?php
  }
  ?>
</body>

</html>