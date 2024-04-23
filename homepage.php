<!-- Where Countdown is being set -->
<!-- Retrieve countdown datetime from database -->

<?php include 'includes/conn.php';

$sql = "SELECT countdown FROM countdown ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

$countdown = null;
if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $countdown = $row["countdown"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="css/homepage.css" />
  <link rel="icon" href="Images/download.png" />
  <title>BVS - Biometric Voting System</title>
</head>

<body>
  <!-- Where Countdown is being set -->
  <!-- Retrieve countdown datetime from database -->


  <section class="header">
    <nav>
      <tag><a>Eastern Visayas State University</a></tag>
      <div class="links" id="links">
        <i class="bx bx-x" onclick="Hide()"></i>
        <ul>
          <li><a href="admin/index.php">LOG-IN ADMIN</a></li>
          <li id="voteBtn"> <a href="index.php"> LOG-IN VOTER </a>
          </li>
        </ul>
      </div>
      <i class="bx bx-menu" onclick="Show()"></i>
    </nav>
    <div class="text">
      <h1>BIOMETRIC VOTING SYSTEM</h1>
      <p>
        <!-- The Biometric Voting Project is an application where the user
        is recognized as his fingerprint pattern. Since the fingerprint
        pattern of each human being is unique, the voter can be easily authenticated.
        The system reads the voter fingerprint uniquely which permits me to vote.
        Admin has the right to add candidate names and photos of who are running for
        a representative in every election position. Admin will authenticate the user
        by verifying the user’s identity proof, and then Admin will register the voter.
        The number of candidates added to the system by the admin will be
        automatically deleted after the completion of the election.
        Admin must add the date when the election is going to end. Once the user
        has the user ID and password from the admin, they can login and vote for
        the candidate who has been nominated. The system will allow the user to vote
        for only one candidate. The system will allow the user to vote once for a
        particular election. Admins can add any number of candidates when the new
        election is announced. Admins can view the election results by using the
        election ID. Even the user can view the election result. -->
      </p>
      <div id="countdown"></div>
    </div>
  </section>
  <br>

  <div class="full-course">
    <section class="courses" id="courses">
      <h2>Processes to Register as Voter</h2>
      <p>
        Just follow the steps so you can be able to vote
      </p>

      <div class="row">
        <div class="clo">
          <h3>Step 1</h3>
          <p>
            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Repellendus cum esse recusandae! Cupiditate, soluta, iusto tempora
              culpa est repudiandae sed laudantium quam ea saepe
              repellendus.</span>
          </p>
        </div>
        <div class="clo">
          <h3>Step 2</h3>
          <p>
            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Repellendus cum esse recusandae! Cupiditate, soluta, iusto tempora
              culpa est repudiandae sed laudantium quam ea saepe
              repellendus</span>.
          </p>
        </div>
        <div class="clo">
          <h3>Step 3</h3>
          <p>
            <span>Lorem ipsum dolor sit amet consectetur adipisicing elit.
              Repellendus cum esse recusandae! Cupiditate, soluta, iusto tempora
              culpa est repudiandae sed laudantium quam ea saepe
              repellendus</span>.
          </p>
        </div>
      </div>
    </section>
  </div>
  <br>

  <section class="campus">
    <h3>Our Campus</h3>
    <p>
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque,
      eaque.
    </p>
    <img class="first-row" src="Images/EVSUCC1.jpeg" alt="" />

    <div class="row">
      <div class="campus-col">
        <div class="layer"></div>
        <img src="Images/EVSUCC3.jpeg" alt="" />
      </div>

      <div class="campus-col">
        <div class="layer"></div>
        <img src="Images/EVSUCC2.jpeg" alt="" />
      </div>

      <div class="campus-col">
        <div class="layer"></div>
        <img src="Images/EVSUCC6.jpeg" alt="" />
      </div>
  </section>

  <section class="facilites">
    <h3>Our Facilites</h3>
    <p>
      Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est, quod.
    </p>

    <div class="row">
      <div class="fal-col">
        <img src="Images/ComLab.jpeg" alt="" />
        <h4>Computer Laboratory</h4>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita
          ipsam fuga eum iusto repellendus accusantium esse excepturi, minus
          aperiam quis!
        </p>
      </div>

      <div class="fal-col">
        <img src="Images/SpeechLab.jpeg" alt="" />
        <h4>Speech Laboratory</h4>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita
          ipsam fuga eum iusto repellendus accusantium esse excepturi, minus
          aperiam quis!
        </p>
      </div>

      <div class="fal-col">
        <img src="Images/Chemistery.jpg" alt="" />
        <h4>AVR Laboratory</h4>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita
          ipsam fuga eum iusto repellendus accusantium esse excepturi, minus
          aperiam quis!
        </p>
      </div>
    </div>

    <div class="row">
      <div class="fal-col">
        <img src="Images/libaray.jpg" alt="" />
        <h4> Libaray </h4>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita
          ipsam fuga eum iusto repellendus accusantium esse excepturi, minus
          aperiam quis!
        </p>
      </div>

      <div class="fal-col">
        <img src="Images/Gym.jpg" alt="" />
        <h4>Mini Gymnasuim</h4>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita
          ipsam fuga eum iusto repellendus accusantium esse excepturi, minus
          aperiam quis!
        </p>
      </div>

      <div class="fal-col">
        <img src="Images/Cafeteria.jpg" alt="" />
        <h4>Canteen</h4>
        <p>
          Lorem ipsum, dolor sit amet consectetur adipisicing elit. Expedita
          ipsam fuga eum iusto repellendus accusantium esse excepturi, minus
          aperiam quis!
        </p>
      </div>
    </div>
  </section>

  <section class="footer">
    <!-- <p>All Copy &copy; Right Reserved 2024</p>
      <div class="icons"> -->
    <h5>Follow Us On</h5>
    <i class="bx bxl-facebook" href="https://www.facebook.com/evsuccssgofficial" id="facebook"></i>
    <i class="bx bxl-instagram" id="instagram"></i>
    <i class="bx bxl-twitter" id="twitter"></i>
    <i class="bx bxl-linkedin" id="linkein"></i>
    </div>
  </section>

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
        document.getElementById("countdown").innerHTML = "VOTING IS NOW OFFICAILY CLOSED!!";
        var listItem = document.getElementById("voteBtn")
        if (listItem) {
          listItem.setAttribute('disabled', true);
          listItem.style.pointerEvents = 'none';
        }

      }
    }, 1000);


    var Links = document.getElementById("links");

    function Show() {
      Links.style.right = "0";
    }

    function Hide() {
      Links.style.right = "-200px";
    }
  </script>
</body>

</html>