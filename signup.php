<?php

include 'includes/conn.php';
include 'includes/header.php';

if (isset($_POST['add'])) {
    $fullname = $_POST['fullname'];
    $course = $_POST['course'];
    $email = $_POST['email'];
    $studentid = $_POST['studentid'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $sql = "INSERT INTO voters (password, fullname, course, email, studentid) VALUES ('$password', '$fullname', '$course', '$email', '$studentid')";
    if ($conn->query($sql)) {
        $_SESSION['success'] = 'Voter added successfully';
    } else {
        $_SESSION['error'] = $conn->error;
    }
} else {
    $_SESSION['error'] = 'Fill up add form first';
}

?>



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


            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fullname" class="col-sm-3 control-label">Fullname</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="course" class="col-sm-3 control-label">Course</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="course" name="course" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label">Email</label>

                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="studentid" class="col-sm-3 control-label">Student ID</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="studentid" name="studentid" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label">Password</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat pull-left"><a href="homepage.php"></a> Close</button>
            <button type="submit" class="btn btn-primary btn-flat" name="add"><i></i> Save</button>
            </form>
        </div>


    </div>

    <?php include 'includes/scripts.php' ?>
</body>