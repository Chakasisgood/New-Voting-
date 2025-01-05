<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<?php include 'includes/conn.php';
$course = $_SESSION['courses']; ?>


<body class="hold-transition skin-blue layout-top-nav">
	<div class="wrapper">


		<?php include 'includes/navbar.php'; ?>
		<style>
			#countdown {
				font-size: 20px;
				font-weight: bold;
			}
		</style>

		<div class="content-wrapper">
			<div class="container">
				<!-- Where Countdown is being set -->
				<!-- Retrieve countdown datetime from database -->
				<div id="countdown"></div>
				<?php

				$sql = "SELECT countdown FROM countdown ORDER BY id DESC LIMIT 1";
				$result = $conn->query($sql);

				$countdown = null;
				if ($result->num_rows > 0) {
					$time = $result->fetch_assoc();
					$countdown = $time["countdown"];
				}

				?>

				<!-- Main content -->
				<section class="content">


					<!-- EXTRACTING ELETION TITLE -->
					<?php
					$sql = "SELECT titles FROM title ORDER BY id DESC LIMIT 1"; // This gets the latest entry
					$result = $conn->query($sql);

					if ($result->num_rows > 0) {
						// Fetch the title
						$row = $result->fetch_assoc();
						$title = $row['titles'];
					} else {
						echo "<h1>No title found</h1>"; // Fallback if no title is found in the database
					}


					?>
					<h1 class="page-header text-center title"><b><?php echo strtoupper($title); ?></b></h1>
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1">
							<?php
							if (isset($_SESSION['error'])) {
								$errors = '';
								foreach ($_SESSION['error'] as $error) {
									$errors .= '<li>' . $error . '</li>';
								}
								echo "
								<script>
								document.addEventListener('DOMContentLoaded', function() {
									Swal.fire({
										icon: 'error',
										title: 'Error!',
										html: '<ul style=\"text-align: left;\">' + '$errors' + '</ul>',
										showConfirmButton: true
									});
								});
								</script>
								";
								unset($_SESSION['error']);
							}
							if (isset($_SESSION['success'])) {
								echo "
								<script>
								document.addEventListener('DOMContentLoaded', function() {
									Swal.fire({
										icon: 'success',
										title: 'Success!',
										text: '" . $_SESSION['success'] . "',
										showConfirmButton: true
									});
								});
								</script>
								";
								unset($_SESSION['success']);
							}

							?>

							<!-- Erorr message -->
							<div class="alert alert-danger alert-dismissible" id="alert" style="display:none;">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
								<span class="message"></span>
							</div>

							<?php
							$sql = "SELECT * FROM votes WHERE voters_id = '" . $voter['id'] . "'";
							$vquery = $conn->query($sql);
							if ($vquery->num_rows > 0) {
							?>
								<div class="text-center">
									<h3>You have already voted for this election.</h3>
									<h2>THANK YOU &#x1F389; </h2>
									<a href="printcast.php" class="btn btn-success"><span class="glyphicon glyphicon-print"></span> Print</a>
								</div>
							<?php
							} else {
							?>
								<!-- Voting Ballot -->
								<form method="POST" id="ballotForm" action="submit_ballot.php">
									<?php
									include 'includes/slugify.php';

									$candidate = ''; // Initialize variable to store results (if needed)
									$course = $_SESSION['courses']; // The course associated with the logged-in user

									// Define the SQL query based on the logged-in course
									if ($course === 'ALL_STUDENTS') {
										// If logged in as ALL_STUDENTS, fetch all positions available to all students
										$sql = "SELECT * FROM positions WHERE courses_id = 'ALL_STUDENTS' OR courses_id IS NULL ORDER BY priority ASC";
									} else {
										// If logged in as a specific course, fetch positions for that course or ALL_STUDENTS
										$sql = "SELECT * FROM positions 
												WHERE courses_id = '$course' OR courses_id = 'ALL_STUDENTS' 
												ORDER BY priority ASC";
									}

									// Execute the query
									$query = $conn->query($sql);

									// Fetch and store the results
									$positions = []; // Use an array to store results
									if ($query) {
										while ($row = $query->fetch_assoc()) {
											$positions[] = $row; // Add the current row to the results array
										}
									} else {
										// Handle SQL error gracefully
										echo "Error: " . $conn->error;
									}

									// Optionally process the data if needed
									// Example: Output JSON or pass it to the front end
									// echo json_encode($positions);


									$query = $conn->query($sql);
									$query = $conn->query($sql);
									while ($row = $query->fetch_assoc()) {
										$sql = "SELECT * FROM candidates WHERE position_id='	" . $row['id'] . "'";
										$cquery = $conn->query($sql);
										while ($crow = $cquery->fetch_assoc()) {
											$slug = slugify($row['description']);
											$checked = '';
											if (isset($_SESSION['post'][$slug])) {
												$value = $_SESSION['post'][$slug];

												if (is_array($value)) {
													foreach ($value as $val) {
														if ($val == $crow['id']) {
															$checked = 'checked';
														}
													}
												} else {
													if ($value == $crow['id']) {
														$checked = 'checked';
													}
												}
											}
											$input = ($row['max_vote'] > 1) ? '<input type="checkbox" class="flat-red ' . $slug . '" name="' . $slug . "[]" . '" value="' . $crow['id'] . '" ' . $checked . '>' : '<input type="radio" class="flat-red ' . $slug . '" name="' . slugify($row['description']) . '" value="' . $crow['id'] . '" ' . $checked . '>';
											$image = (!empty($crow['photo'])) ? 'images/' . $crow['photo'] : 'images/profile.jpg';
											$candidate .= '
												<li>
													' . $input . '<button type="button" class="btn btn-primary btn-sm btn-flat clist platform" data-platform="' . $crow['platform'] . '" data-fullname="' . $crow['fullname'] . '"><i class="fa fa-search"></i> Platform</button><img src="' . $image . '" height="100px" width="100px" class="clist"><span class="cname clist">' . $crow['fullname'] . '</span>
												</li>
											';
										}

										$instruct = ($row['max_vote'] > 1) ? 'You may select up to ' . $row['max_vote'] . ' candidates' : 'Select only one candidate';

										echo
										'
											<div class="rowq">
												<div class="col-xs-12">
													<div class="box box-solid" id="' . $row['id'] . '">
														<div class="box-header with-border">
															<h3 class="box-title"><b>' . $row['description'] . '</b></h3>
														</div>
														<div class="box-body">
															<p>' . $instruct . '
																<span class="pull-right">
																	<button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="' . slugify($row['description']) . '"><i class="fa fa-refresh"></i> Clear</button>
																</span>
															</p>
															<div id="candidate_list">
																<ul>
																	' . $candidate . '
																</ul>
															</div>
														</div>
													</div>
												</div>
											</div>
										';


										$candidate = '';
									}

									// echo $course = $_SESSION['voter_phone'];

									?>
									<div class="text-center">
										<!-- preview click -->
										<button type="button" class="btn btn-success btn-flat" id="preview"><i class="fa fa-file-text"></i> Preview</button>


									</div>
									<!-- Preview Modal ma pop-up-->
									<div class="modal fade" id="preview_modal">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title">Vote Preview</h4>
												</div>
												<div class="modal-body">
													<div id="preview_body"></div>
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
													<button type="submit" class="btn btn-primary btn-flat" name="vote"><i class="fa fa-check-square-o"></i> Submit</button>
												</div>
											</div>
										</div>
									</div>
								</form>
								<!-- End Voting Ballot -->
							<?php
							}

							?>

						</div>
					</div>
				</section>

			</div>
		</div>

		<?php include 'includes/footer.php'; ?>
		<?php include 'includes/ballot_modal.php'; ?>
	</div>


	<?php include 'includes/scripts.php'; ?>
	<script>
		// Countdown timer
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
				document.getElementById("countdown").innerHTML = window.location.href = 'index.php';
			}
		}, 1000);



		// set if the check box was clicked
		$(function() {
			$('.content').iCheck({
				checkboxClass: 'icheckbox_flat-green',
				radioClass: 'iradio_flat-green'
			});

			$(document).on('click', '.reset', function(e) {
				e.preventDefault();
				var desc = $(this).data('desc');
				$('.' + desc).iCheck('uncheck');
			});

			$(document).on('click', '.platform', function(e) {
				e.preventDefault();
				$('#platform').modal('show');
				var platform = $(this).data('platform');
				var fullname = $(this).data('fullname');
				$('.candidate').html(fullname);
				$('#plat_view').html(platform);
			});


			// when preview is clicked

			$('#preview').click(function(e) {
				e.preventDefault();
				var form = $('#ballotForm').serialize();

				if (form == '') {
					Swal.fire({
						icon: 'warning',
						title: 'Alert',
						text: 'You have not selected any candidates yet. Do you want to proceed?',
						showCancelButton: true,
						confirmButtonText: 'Yes, proceed',
						cancelButtonText: 'No, go back',
					}).then((result) => {
						if (result.isConfirmed) {
							// Proceed with AJAX request
							sendPreviewRequest(form);
						}
					});
				} else {
					// Proceed directly with AJAX request if form is not empty
					sendPreviewRequest(form);
				}
			});

			function sendPreviewRequest(form) {
				$.ajax({
					type: 'POST',
					url: 'preview.php',
					data: form,
					dataType: 'json',
					success: function(response) {
						if (response.error) {
							var errmsg = '';
							var messages = response.message;
							for (i in messages) {
								errmsg += messages[i] + '\n';
							}

							// Use SweetAlert2 to display the error message
							Swal.fire({
								icon: 'error',
								title: 'Error',
								text: errmsg,
								confirmButtonText: 'OK'
							});
						} else {
							$('#preview_modal').modal('show');
							$('#preview_body').html(response.list);
						}
					}
				});
			}


		});
	</script>
</body>

</html>