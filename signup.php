<?php

session_start();
include('header.php');

// DB credentials.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'votesystem');

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"));
} catch (PDOException $e) {
    exit("Error: " . $e->getMessage());
}


//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;


//Load Composer's autoloader
// require 'vendor/autoload.php'


include('vendor/autoload.php');


if (isset($_POST['submit'])) {
    $fullname = $_POST['name'];
    $studentid = $_POST['studentid'];
    $email = $_POST['email'];
    $course = $_POST['course'];
    $age = $_POST['age'];
    $code = rand(100000000, 999999999);


    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER; //Enable verbose debug output
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'matthewsolar09@gmail.com'; //SMTP username
    $mail->Password = 'axsk ideb mfbz xbck'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('admin@gmail.com', 'Biometric Voting System');
    $mail->addAddress($email, $fullname); //Add a recipient
    // $mail->addAddress('ellen@example.com'); //Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    //Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz'); //Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); //Optional name

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = 'SECURITY CODE ACCESS';



    $mail->Body =
        "Hello <strong>$fullname </strong>, <br><br>
Congratulations <br><br>
Here is your code: <div style='text-align:center'><br>
    <strong>$code</strong>
</div>
<br>
<br> <br>
";

    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();


    $sql = 'INSERT INTO users (name,studentid,email,course,age,idcode) VALUES(:fname,:studentid,:email,:course,:age,:code)';
    $statement = $dbh->prepare($sql);
    $statement->execute([
        ':fname' => $fullname,
        ':studentid' => $studentid,
        ':email' => $email,
        ':course' => $course,
        ':age' => $age,
        ':code' => $code,
    ]);
    if ($statement) {
        header("refresh:2;url=homepage.php");
        $_SESSION['success'] = 'Your account was successfully registered.';
    } else {
        $_SESSION['error'] = 'Problem registered account';
    }
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Graduate|<?php echo $sitename; ?></title>

    <link rel="icon" type="image/png" sizes="16x16" href="../images/EASTERN-Visayas-State-University-Carigara-Campus-removebg-preview.png">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<body>
    <section class="vh-100" style="background-color: #eee;">
        <div class="container p-2">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-12 col-xl-11">
                    <div class="card text-black" style="border-radius: 25px;">

                        <div class="card-body p-md-5">
                            <a href="index.php?page=users" class="btn btn-dark">Back</a>
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                    <p class="text-center h1 fw-bold mb-4 mx-1 mx-md-4 mt-4">Sign up</p>

                                    <form class="mx-1 mx-md-4" method="POST">

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Full Name</label>
                                                <input type="text" name="name" required id="form3Example1c" class="form-control" />

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example1c">Student ID</label>
                                                <input type="text" name="studentid" required id="form3Example1c" class="form-control" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Evsu Email</label>
                                                <input type="email" name="email" required id="form3Example3c" class="form-control" />

                                            </div>
                                        </div>
                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Course</label>
                                                <input type="text" name="course" required id="form3Example3c" class="form-control" />

                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <label class="form-label" for="form3Example3c">Age</label>
                                                <input type="number" name="age" required id="form3Example3c" class="form-control" />

                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                            <button type="submit" class="btn btn-primary btn-lg" name="submit">Register</button>
                                        </div>

                                    </form>

                                </div>
                                <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="../images/logosingupgraduate.jpg" class="img-fluid" alt="Sample image">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <link rel="stylesheet" href="header.php">
    <?php if (!empty($_SESSION['success'])) {  ?>
        <div class="popup popup--icon -success js_success-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                    <strong>Success</strong>
                    </h1>
                    <p><?php echo $_SESSION['success']; ?></p>
                    <p>
                        <button class="button button--success" data-for="js_success-popup">Close</button>
                    </p>
            </div>
        </div>
    <?php unset($_SESSION["success"]);
    } ?>
    <?php if (!empty($_SESSION['error'])) {  ?>
        <div class="popup popup--icon -error js_error-popup popup--visible">
            <div class="popup__background"></div>
            <div class="popup__content">
                <h3 class="popup__content__title">
                    <strong>Error</strong>
                    </h1>
                    <p><?php echo $_SESSION['error']; ?></p>
                    <p>
                        <button class="button button--error" data-for="js_error-popup">Close</button>
                    </p>
            </div>
        </div>
    <?php unset($_SESSION["error"]);
    } ?>
    <script>
        var addButtonTrigger = function addButtonTrigger(el) {
            el.addEventListener('click', function() {
                var popupEl = document.querySelector('.' + el.dataset.for);
                popupEl.classList.toggle('popup--visible');
            });
        };
        Array.from(document.querySelectorAll('button[data-for]')).forEach(addButtonTrigger);
    </script>

</body>

</html>