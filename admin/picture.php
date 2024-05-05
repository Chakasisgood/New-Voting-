<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>



<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>
        <style>
            #button {
                border-radius: 5px;
            }
        </style>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- CSS -->
            <style>
                #my_camera {
                    width: 320px;
                    height: 240px;
                    border: 1px solid black;
                }

                #click {
                    color: white;
                    font-size: 15px;
                    background: #337ab7;
                    border-radius: 10px;
                    border-color: transparent;
                }

                input {
                    width: 100px;
                    height: 40px;
                }
            </style>
            <center>
                <!-- -->
                <br>
                <div id="my_camera"></div>
                <br>
                <input id="click" type=button value="Take Picture" onClick="take_snapshot()">

                <div id="results"></div>

                <!-- Script -->
                <script type="text/javascript" src="webcam.min.js"></script>

                <!-- Code to handle taking the snapshot and displaying it locally -->
                <script language="JavaScript">
                    // Configure a few settings and attach camera
                    Webcam.set({
                        width: 320,
                        height: 240,
                        image_format: 'jpeg',
                        jpeg_quality: 90
                    });
                    Webcam.attach('#my_camera');

                    // preload shutter audio clip
                    var shutter = new Audio();
                    shutter.autoplay = true;
                    shutter.src = navigator.userAgent.match(/Firefox/) ? 'shutter.ogg' : 'shutter.mp3';

                    function take_snapshot() {
                        // play sound effect
                        shutter.play();

                        // take snapshot and get image data
                        Webcam.snap(function(data_uri) {

                            Webcam.upload(data_uri, 'saveimage.php', function(code, text, Name) {
                                document.getElementById('results').innerHTML =
                                    '' +


                                    // display results in page
                                    //document.getElementById('results').innerHTML = 
                                    '<img src="' + data_uri + '"/>';

                            });


                        });
                    }
                </script>

        </div>

        <?php include 'includes/footer.php'; ?>
        <?php include 'includes/voters_modal.php'; ?>
    </div>
    <?php include 'includes/scripts.php'; ?>

</body>

</html>