<?php
include 'includes/session.php';
include 'includes/slugify.php';


$sql = "SELECT * FROM positions";
$pquery = $conn->query($sql);

$output = '';
$candidate = '';

$sql = "SELECT * FROM positions ORDER BY priority ASC";
$query = $conn->query($sql);
$num = 1;
while ($row = $query->fetch_assoc()) {
	// Determine the correct input type based on the value of max_vote
	if ($row['max_vote'] == 1) {
		// Render a radio button when max_vote is 1
		$input = '<input type="radio" class="flat-red ' . slugify($row['description']) . '" name="' . slugify($row['description']) . '">';
	} elseif ($row['max_vote'] == 2) {
		// Render a checkbox when max_vote is 2 with a common class or name for JavaScript to target
		$input = '<input type="checkbox" class="flat-red ' . slugify($row['description']) . '" name="' . slugify($row['description']) . '">';
	} else {
		// Render checkboxes for any max_vote greater than 2
		$input = '<input type="checkbox" class="flat-red ' . slugify($row['description']) . '" name="' . slugify($row['description']) . '[]">';
	}

	$sql = "SELECT * FROM candidates WHERE position_id='" . $row['id'] . "'";
	$cquery = $conn->query($sql);
	while ($crow = $cquery->fetch_assoc()) {
		$image = (!empty($crow['photo'])) ? '../images/' . $crow['photo'] : '../images/profile.jpg';
		$candidate .= '
				<li>
					' . $input . '<img src="' . $image . '" height="110px" width="110px" class="clist"><span class="cname clist">' . $crow['fullname'] . '</span>
				</li>
			';
	}
	// <button class="btn btn-primary btn-sm btn-flat clist"><i class="fa fa-search"></i> Platform</button>

	$instruct = ($row['max_vote'] > 1) ? 'You may select up to ' . $row['max_vote'] . ' candidates' : 'Select only one candidate';

	$updisable = ($row['priority'] == 1) ? 'disabled' : '';
	$downdisable = ($row['priority'] == $pquery->num_rows) ? 'disabled' : '';

	$output .= '
			<div class="row">
				<div class="col-xs-12">
					<div class="box box-solid" id="' . $row['id'] . '">
						<div class="box-header with-border">
							<h3 class="box-title"><b>' . $row['description'] . '</b></h3>
							<div class="pull-right box-tools">
				                <button type="button" class="btn btn-default btn-sm moveup" data-id="' . $row['id'] . '" ' . $updisable . '><i class="fa fa-arrow-up"></i> </button>
				                <button type="button" class="btn btn-default btn-sm movedown" data-id="' . $row['id'] . '" ' . $downdisable . '><i class="fa fa-arrow-down"></i></button>
				            </div>
						</div>
						<div class="box-body">
							<p>' . $instruct . '
								<span class="pull-right">
									<button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="' . slugify($row['description']) . '"><i class="fa fa-refresh"></i> Reset</button>
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

	$sql = "UPDATE positions SET priority = '$num' WHERE id = '" . $row['id'] . "'";
	$conn->query($sql);

	$num++;
	$candidate = '';
}


echo json_encode($output);
