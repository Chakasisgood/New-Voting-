<!-- Add -->
<div class="modal fade" id="addnew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Add New Position</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="positions_add.php">
          <div class="form-group">
            <label for="description" class="col-sm-3 control-label">Position</label>
            <div class="col-sm-9">
              <input type="text" class="form-control" id="description" name="description" required>
            </div>
          </div>

          <!-- Radio Buttons for All Students or Specific Course -->
          <div class="form-group">
            <label class="col-sm-3 control-label">Applicable For</label>
            <div class="col-sm-9">
              <label>
                <input type="radio" name="applicable_for" value="all" id="all_students" checked> All Students
              </label>
              <label style="margin-left: 20px;">
                <input type="radio" name="applicable_for" value="course" id="specific_course"> Specific Course
              </label>
            </div>
          </div>

          <!-- Dropdown for Specific Courses (Initially Hidden) -->
          <div class="form-group" id="course_dropdown" style="display: none;">
            <label for="course" class="col-sm-3 control-label">Courses</label>
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
            <label for="max_vote" class="col-sm-3 control-label">Maximum Vote</label>
            <div class="col-sm-9">
              <input type="number" class="form-control" id="max_vote" name="max_vote" required>
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i></i> Close</button>
        <button type="submit" class="btn btn-primary btn-flat" name="add"><i></i> Save</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Edit -->
<div class="modal fade" id="edit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Edit Position</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="positions_edit.php">
          <input type="hidden" class="id" name="id">
          <div class="form-group">
            <label for="edit_description" class="col-sm-3 control-label">Description</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_description" name="description">
            </div>
          </div>


          <div class="form-group">
            <label for="course" class="col-sm-3 control-label">Courses</label>

            <div class="col-sm-9">
              <select class="form-control" id="course" name="course" required>
                <option value="" selected id="posselect"></option>
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
            <label for="edit_max_vote" class="col-sm-3 control-label">Maximum Vote</label>

            <div class="col-sm-9">
              <input type="number" class="form-control" id="edit_max_vote" name="max_vote">
            </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i></i> Close</button>
        <button type="submit" class="btn btn-success btn-flat" name="edit"><i></i> Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Deleting...</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="positions_delete.php">
          <input type="hidden" class="id" name="id">
          <div class="text-center">
            <p>DELETE POSITION</p>
            <h2 class="bold description"></h2>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i></i> Close</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete"><i></i> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
include "script.php";
include "conn.php";


if ($_POST['applicable_for'] === 'all') {
  $course = null; // or handle it as "all students" in your logic
} else {
  $course = $_POST['course']; // specific course ID
}

// Proceed with saving $course and other form data

?>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const allStudentsRadio = document.getElementById('all_students');
    const specificCourseRadio = document.getElementById('specific_course');
    const courseDropdown = document.getElementById('course_dropdown');

    // Add event listeners to toggle visibility
    allStudentsRadio.addEventListener('change', function() {
      if (allStudentsRadio.checked) {
        courseDropdown.style.display = 'none';
      }
    });

    specificCourseRadio.addEventListener('change', function() {
      if (specificCourseRadio.checked) {
        courseDropdown.style.display = 'block';
      }
    });
  });
</script>