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
<style>
  /* Slideshow container */
  .slideshow-container {
    max-width: 1000px;
    position: relative;
    margin: auto;
  }

  .image {
    height: 20rem;
    border-radius: 10px;

  }

  /* Number text (1/3 etc) */
  .numbertext {
    color: #f2f2f2;
    font-size: 12px;
    padding: 8px 12px;
    position: absolute;
    top: 0;
  }

  /* The dots/bullets/indicators */
  .dot {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbb;
    border-radius: 50%;
    display: inline-block;
    transition: background-color 0.6s ease;
  }


  /* Fading animation */
  .fade {
    animation-name: fade;
    animation-duration: 1.5s;
  }

  @keyframes fade {
    from {
      opacity: 0.4;
    }

    to {
      opacity: 1;
    }
  }

  /* On smaller screens, decrease text size */
  @media (max-width: 570px) {
    .image {
      max-width: 20rem;
      height: 15rem;
    }
  }
</style>

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
      <div class="all-header">
        <img src="images/logo.gif">
        <tag>
          <a>EASTERN VISAYAS</a>
          <p>STATE UNIVERSITY</p>
        </tag>
      </div>
      <div class="links" id="links">
        <i class="bx bx-x" onclick="Hide()"></i>
        <ul>
          <li><a href="admin/index.php">LOG-IN ADMIN</a></li>
          <li><a href="signup.php">REGISTER</a></li>
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
      <br>
      <!-- <div class="slideshow-container">

        <div class="mySlides fade">
          <img class="image" src="images/ComLab.jpeg">
        </div>

        <div class="mySlides fade">
          <img class="image" src="images/SpeechLab.jpeg">
        </div>

        <div class="mySlides fade">
          <img class="image" src="images/EVSU.png">
        </div>

      </div> -->
      <br>


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
            <span>First go to the SSG office so you can be able to vote your Fingerprint and Register your Information</span>
          </p>
        </div>
        <div class="clo">
          <h3>Step 2</h3>
          <p>
            <span>After Registration, go to the page of the Biometric Voting System, and Login using your Student ID and Paasword
              you created in rigistration
            </span>.
          </p>
        </div>
        <div class="clo">
          <h3>Step 3</h3>
          <p>
            <span>After you login, you will ba able to vote your favoorite candidate.</span>.
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
        document.getElementById("countdown").innerHTML = "VOTING IS NOW OFFICIALY CLOSED!!";
        // var listItem = document.getElementById("voteBtn")
        if (listItem) {
          // listItem.setAttribute('disabled', false);
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


    // SLIDER
    let slideIndex = 0;
    showSlides();

    function showSlides() {
      let i;
      let slides = document.getElementsByClassName("mySlides");
      // let dots = document.getElementsByClassName("dot");
      for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
      }
      slideIndex++;
      if (slideIndex > slides.length) {
        slideIndex = 1
      }
      for (i = 0; i < slides.length; i++) {
        slides[i].className = slides[i].className.replace(" active", "");
      }
      slides[slideIndex - 1].style.display = "block";
      slides[slideIndex - 1].className += " active";
      setTimeout(showSlides, 3000); // Change image every 2 seconds
    }
  </script>
</body>

</html>