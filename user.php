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
    font-family: 'Arial', sans-serif;
    font-size: 15px;
    color: #fff;
    text-align: center;
    padding: 10px;
    border-radius: 8px;

    /* Matches your preferred color */
    width: fit-content;
    margin: 20px auto;
    letter-spacing: 1.5px;
    background: rgba(255, 255, 255, 0.2);

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

  .form-group {
    position: relative;
  }

  #togglePassword {
    position: absolute;
    top: 50%;
    right: 10px;
    transform: translateY(-50%);
    cursor: pointer;
    color: #666;
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
          <input type="text" class="form-control" name="voter" placeholder="Student ID" required>
          <span class="glyphicon glyphicon-user form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
          <span class="glyphicon glyphicon-eye-open" id="togglePassword"></span>
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

    // Check if there is an error message in the session
    if (isset($_SESSION['error'])) {
      // Pass the error message to JavaScript
      echo "<script>
        window.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: '" . addslashes($_SESSION['error']) . "',
                confirmButtonText: 'OK'
            });
        });
    </script>";
      // Clear the error message from the session
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
</script>