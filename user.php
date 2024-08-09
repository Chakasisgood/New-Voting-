<?php
session_start();
if (isset($_SESSION['admin'])) {
  header('location: admin/home.php');
}

if (isset($_SESSION['voter'])) {
  header('location: home.php');
}
?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/conn.php'; ?>
<style>
  #countdown {
    font-size: 15px;
    font-weight: bold;
    opacity: 0.7;
  }
</style>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="login-logo">
      <b>ELECTION STUDENT COMMISSION</b>
      <div id="countdown"></div>
    </div>

    <div class="login-box-body">


      <form action="login.php" method="POST">
        <div class="form-group has-feedback">
          <input type=" text" class="form-control" name="voter" placeholder="Student ID" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password" required>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat" name="login" id="voteBtn">
              <i></i> Sign In
            </button>
          </div>
        </div>
      </form>
    </div>

    <?php
    // <!-- Where Countdown is being set -->
    // <!-- Retrieve countdown datetime from database -->
    $sql = "SELECT countdown FROM countdown ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    $countdown = null;
    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $countdown = $row["countdown"];
    }


    if (isset($_SESSION['error'])) {
      echo "
  				<div class='callout callout-danger text-center mt20'>
			  		<p>" . $_SESSION['error'] . "</p> 
			  	</div>
  			";
      unset($_SESSION['error']);
    }
    ?>
  </div>

  <?php include 'includes/scripts.php' ?>
</body>
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

    document.getElementById("countdown").innerHTML = "VOTING ARE NOW OFFICIALY OPEN FOR: " + days + "d " + hours + "h " +
      minutes + "m " + seconds + "s ";

    if (distance < 0) {
      clearInterval(countdownFunction);
      document.getElementById("countdown").innerHTML = "VOTING IS NOW OFFICIALY CLOSED!!";
      document.getElementById("voteBtn").disabled = true;
    }
  }, 1000);
</script>