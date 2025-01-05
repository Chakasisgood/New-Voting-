<?php
include 'includes/header.php';
include 'includes/srcipts.php';
include 'includes/conn.php';

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
            <form action="signup_modal.php" id="registrationForm" class="form-horizontal" method="POST" enctype="multipart/form-data">
                <!-- Form fields -->
                <div class="form-group">
                    <label for="fullname" class="col-sm-3 control-label" style="color: #e8d52a; letter-spacing: 1.5px;">Fullname</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="course" class="col-sm-3 control-label" style="color: #e8d52a; letter-spacing: 1.5px;">Course</label>
                    <div class="col-sm-9">
                        <select class="form-control" id="course" name="course">
                            <option value="" selected>- Select -</option>
                            <?php
                            $sql = "SELECT * FROM courses";
                            $query = $conn->query($sql);
                            while ($row = $query->fetch_assoc()) {
                                echo "
                                    <option value='" . $row['id'] . "'>" . $row['course'] . "</option>
                                ";
                            }
                            ?>
                        </select>
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
                        <span id="studentid-error" class="text-primary" style="display:none;">This Student ID already exists.</span>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="col-sm-3 control-label" style="color: #e8d52a; letter-spacing: 1.5px;">Password</label>
                    <div class="col-sm-9">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                </div>

                <div class="modal-footer">
                    <a class="btn btn-default btn-flat pull-left" href="index.php">Close</a>
                    <button type="submit" class="btn btn-primary btn-flat" name="add">Save</button>
                </div>
            </form>
        </div>
    </div>

    <?php include 'includes/scripts.php'; ?>

    <script>
        // Fetching Student ID
        document.getElementById('studentid').addEventListener('input', function() {
            var studentId = this.value;
            var errorSpan = document.getElementById('studentid-error');

            if (studentId.length > 0) { // Only check if there's input
                fetch('check_studentid.php?studentid=' + encodeURIComponent(studentId))
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

        document.getElementById('registrationForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent default form submission

            var errorSpan = document.getElementById('studentid-error');
            if (errorSpan.style.display === 'block') {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'You cannot register because the Student ID already exists.',
                    confirmButtonText: 'OK'
                });
            } else {
                // Show loading alert
                Swal.fire({
                    title: 'Submitting...',
                    text: 'Please wait while we process your registration.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                // Collect form data
                var formData = new FormData(this);

                // Submit the form data via AJAX
                fetch('signup_modal.php', {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        // Ensure the loading alert is shown for at least 3 seconds
                        setTimeout(() => {
                            Swal.close(); // Close the loading alert

                            if (data.success) {
                                // Show success alert and redirect
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Success',
                                    text: 'Your registration has been processed successfully.',
                                    confirmButtonText: 'OK'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.location.href = 'index.php'; // Redirect to index.php
                                    }
                                });
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Error',
                                    text: data.message || 'An error occurred while processing your registration.',
                                    confirmButtonText: 'OK'
                                });
                            }
                        }, 3000); // 3000 milliseconds = 3 seconds
                    })
                    .catch(error => {
                        Swal.close(); // Close the loading alert

                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: 'An error occurred while processing your registration.',
                            confirmButtonText: 'OK'
                        });
                    });
            }
        });
        // Filtering the student ID with only 10 characters
        // document.getElementById('studentid').addEventListener('input', function() {
        //     if (this.value.length !== 10) {
        //         this.setCustomValidity('Student ID must be exactly 10 characters long.');
        //     } else {
        //         this.setCustomValidity(''); // Clears the error message
        //     }
        // });

        // document.querySelector('form').addEventListener('submit', function(event) {
        //     const studentId = document.getElementById('studentid').value;
        //     if (studentId.length !== 10) {
        //         event.preventDefault(); // Prevent form submission
        //         Swal.fire({
        //             icon: 'error',
        //             title: 'Invalid Student ID',
        //             text: 'Student ID must be exactly 10 characters long.',
        //             confirmButtonText: 'OK'
        //         });
        //     }
        // });
    </script>
</body>