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


if (isset($_GET['studentid'])) {
    $studentid = $_GET['studentid'];
    $stmt = $conn->prepare("SELECT COUNT(*) FROM users WHERE student_id = ?");
    $stmt->bind_param("s", $studentid);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    $response = array('exists' => $count > 0);
    echo json_encode($response);
}

$conn->close();
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
            <b>ELECTION STUDENT REGISTRATION</b>
            <div id="countdown"></div>
        </div>

        <div class="login-box-body">


            <form class="form-horizontal" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="fullname" class="col-sm-3 control-label" style="color: #e8d52a; letter-spacing: 1.5px;">Fullname</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="course" class="col-sm-3 control-label" style="color: #e8d52a; letter-spacing: 1.5px;">Course</label>

                    <div class="col-sm-9">
                        <input type="text" class="form-control " id="course" name="course" placeholder="Course" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="email" class="col-sm-3 control-label" style="color: #e8d52a; letter-spacing: 1.5px;">EVSU Email</label>

                    <div class="col-sm-9">
                        <input type="email" class="form-control" id="email" name="email" placeholder="EVSU Email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="studentid" class="col-sm-3 control-label" style="color: #e8d52a; letter-spacing: 1.5px;">Student ID</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="studentid" name="studentid" placeholder="Student ID" required>
                        <span id="studentid-error" class="text-danger" style="display:none;">This Student ID already exists.</span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label" style="color: #e8d52a; letter-spacing: 1.5px;">Password</label>

                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button class="btn btn-default btn-flat pull-left"><a href="index.php">Close</a></button>
            <button type="submit" class="btn btn-primary btn-flat" name="add"><i></i> Save</button>
            </form>
        </div>


    </div>

    <?php include 'includes/scripts.php' ?>

    <script>
        document.getElementById('studentid').addEventListener('input', function() {
            var studentId = this.value;
            var errorSpan = document.getElementById('studentid-error');

            if (studentId.length > 0) { // Only check if there's input
                fetch('check_studentid.php?studentid=' + studentId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            errorSpan.style.display = 'block';
                        } else {
                            errorSpan.style.display = 'none';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            } else {
                errorSpan.style.display = 'none';
            }
        });
    </script>

</body>